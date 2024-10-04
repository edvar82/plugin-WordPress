<?php
/**
 * Plugin Name: Cadastro de Receitas de Bolos
 * Description: Plugin para cadastro de receitas de bolos com categorias e filtros.
 * Version: 1.0
 * Author: Edvar Monteiro
 * Text Domain: cadastro-receitas-bolos
 */

 class CadastroReceitasBolos {
    public function __construct() {
        add_action('init', [$this, 'register_post_type']);
        add_action('init', [$this, 'register_taxonomy']);
        add_filter('archive_template', [$this, 'archive_template']);
        add_filter('single_template', [$this, 'single_template']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('acf/init', [$this, 'register_acf_fields']);
        register_activation_hook(__FILE__, [$this, 'flush_rewrite_rules']);
        register_deactivation_hook(__FILE__, [$this, 'flush_rewrite_rules']);
    }

    public function flush_rewrite_rules() {
        $this->register_post_type();
        $this->register_taxonomy();
        flush_rewrite_rules();
    }

    public function register_post_type() {
        $labels = array(
            'name' => __('Receitas', 'cadastro-receitas-bolos'),
            'singular_name' => __('Receita', 'cadastro-receitas-bolos'),
            'menu_name' => __('Receitas de Bolos', 'cadastro-receitas-bolos'),
            'all_items' => __('Todas as Receitas', 'cadastro-receitas-bolos'),
            'add_new_item' => __('Adicionar Nova Receita', 'cadastro-receitas-bolos'),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'has_archive' => true,
            'rewrite' => array('slug' => 'receitas'),
            'show_in_rest' => true,
        );

        register_post_type('receita', $args);
    }

    public function register_taxonomy() {
        $labels = array(
            'name' => __('Categorias', 'cadastro-receitas-bolos'),
            'singular_name' => __('Categoria', 'cadastro-receitas-bolos'),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => 'categorias-receitas'),
            'show_in_rest' => true,
        );

        register_taxonomy('categoria_receita', 'receita', $args);
    }

    public function archive_template($archive_template) {
        if (is_post_type_archive('receita')) {
            $archive_template = plugin_dir_path(__FILE__) . 'templates/archive-receita.php';
        }
        return $archive_template;
    }

    public function single_template($single_template) {
        if (is_singular('receita')) {
            $single_template = plugin_dir_path(__FILE__) . 'templates/single-receita.php';
        }
        return $single_template;
    }

    public function enqueue_styles() {
        wp_enqueue_style('receitas-styles', plugin_dir_url(__FILE__) . 'assets/css/receitas.css');
    }

    public function register_acf_fields() {
        if( function_exists('acf_add_local_field_group') ) {
            acf_add_local_field_group(array(
                'key' => 'group_1',
                'title' => 'Detalhes da Receita',
                'fields' => array(
                    array(
                        'key' => 'field_1',
                        'label' => 'Tempo de Preparo',
                        'name' => 'tempo_preparo',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_2',
                        'label' => 'Ingredientes',
                        'name' => 'ingredientes',
                        'type' => 'textarea',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'receita',
                        ),
                    ),
                ),
            ));
        }
    }

    public function rb_get_related_recipes($current_post_id) {
        $args = array(
            'post_type' => 'receita',
            'posts_per_page' => 3,
            'post__not_in' => array($current_post_id),
            'orderby' => 'rand',
        );
        
        $related_recipes = new WP_Query($args);
        
        return $related_recipes;
    }
}

new CadastroReceitasBolos();

