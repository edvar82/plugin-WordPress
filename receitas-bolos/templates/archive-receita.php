<?php get_header(); ?>

<h1><?php _e('Receitas de Bolos', 'cadastro-receitas-bolos'); ?></h1>

<?php 
$categories = get_terms(array('taxonomy' => 'categoria_receita', 'hide_empty' => false)); 
if ($categories && !is_wp_error($categories)) : 
?>
    <form method="GET" action="<?php echo esc_url(get_post_type_archive_link('receita')); ?>">
        <select name="categoria_receita">
            <option value=""><?php _e('Todas as Categorias', 'cadastro-receitas-bolos'); ?></option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo esc_attr($category->slug); ?>" <?php selected(get_query_var('categoria_receita'), $category->slug); ?>>
                    <?php echo esc_html($category->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit"><?php _e('Filtrar', 'cadastro-receitas-bolos'); ?></button>
    </form>
<?php endif; ?>

<?php if (have_posts()) : ?>
    <div class="receitas-list">
        <?php while (have_posts()) : the_post(); ?>
            <div class="receita-item">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(); ?>
                    <?php endif; ?>
                    <h2><?php the_title(); ?></h2>
                    <p><?php _e('Tempo de Preparo: ', 'cadastro-receitas-bolos'); the_field('tempo_preparo'); ?></p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="pagination">
        <?php the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __('&laquo; Anterior', 'cadastro-receitas-bolos'),
            'next_text' => __('Próximo &raquo;', 'cadastro-receitas-bolos'),
        )); ?>
    </div>

<?php else : ?>
    <p><?php _e('Nenhuma receita encontrada.', 'cadastro-receitas-bolos'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
