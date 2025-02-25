<?php
// Post type services
function register_service_post_type()
{
    $is_admin = is_admin();
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'en';

    // Labels según idioma
    $labels = array(
        'en' => array(
            'name' => 'Services',
            'singular_name' => 'Service',
            'add_new' => 'Add Service',
            'add_new_item' => 'Add New Service',
            'edit_item' => 'Edit Service',
            'new_item' => 'New Service',
            'view_item' => 'View Service',
            'search_items' => 'Search Services',
            'not_found' => 'No services found',
            'not_found_in_trash' => 'No services found in trash'
        ),
        'es' => array(
            'name' => 'Servicios',
            'singular_name' => 'Servicio',
            'add_new' => 'Agregar servicio',
            'add_new_item' => 'Agregar nuevo servicio',
            'edit_item' => 'Editar servicio',
            'new_item' => 'Nuevo servicio',
            'view_item' => 'Ver servicio',
            'search_items' => 'Buscar servicios',
            'not_found' => 'No se encontraron servicios',
            'not_found_in_trash' => 'No hay servicios en la papelera'
        )
    );

    $lang_labels = $is_admin ? $labels['es'] : $labels[$current_lang];

    register_post_type('service', array(
        'labels' => $lang_labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'duplicate'),
        'show_in_rest' => true,
        'hierarchical' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-hammer',
        'rewrite' => array(
            'slug' => ($current_lang === 'es') ? 'es/servicios' : 'services',
            'with_front' => false
        )
    ));

    if (function_exists('pll_register_post_type')) {
        pll_register_post_type('service');
    }
}
add_action('init', 'register_service_post_type');

// Agregar reglas de reescritura personalizadas
function add_service_rewrite_rules()
{
    add_rewrite_rule(
        '^services/([^/]+)/?$',
        'index.php?service=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^es/servicios/([^/]+)/?$',
        'index.php?service=$matches[1]&lang=es',
        'top'
    );
}
add_action('init', 'add_service_rewrite_rules');

// Forzar actualización de reglas al activar
function flush_service_rules()
{
    add_service_rewrite_rules();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'flush_service_rules');

// Modificar URLs de posts
function modify_service_permalink($post_link, $post)
{
    if ($post->post_type === 'service' && function_exists('pll_get_post_language')) {
        $lang = pll_get_post_language($post->ID);
        $slug = $post->post_name;

        if ($lang === 'es') {
            return home_url("/es/servicios/{$slug}/");
        } else {
            return home_url("/services/{$slug}/");
        }
    }
    return $post_link;
}
add_filter('post_type_link', 'modify_service_permalink', 10, 2);
