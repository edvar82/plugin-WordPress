<?php get_header(); ?>

<div class="receita-detalhes">
    <h1><?php the_title(); ?></h1>
    
    <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('large'); ?>
    <?php endif; ?>
    
    <p><?php the_content(); ?></p>
    
    <p><?php _e('Tempo de Preparo: ', 'cadastro-receitas-bolos'); the_field('tempo_preparo'); ?></p>
    <p><?php _e('Ingredientes: ', 'cadastro-receitas-bolos'); the_field('ingredientes'); ?></p>
</div>

<h3><?php _e('Veja Mais Receitas', 'cadastro-receitas-bolos'); ?></h3>
<div class="veja-mais">
<?php
    $receitas_bolos_plugin = new CadastroReceitasBolos();
    $related = $receitas_bolos_plugin->rb_get_related_recipes(get_the_ID());

    if ($related->have_posts()) :
        while ($related->have_posts()) : $related->the_post();
    ?>
            <div class="related-receita">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('thumbnail'); ?>
                    <?php endif; ?>
                    <h4><?php the_title(); ?></h4>
                </a>
            </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>

<?php get_footer(); ?>
