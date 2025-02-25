<?php

/**
 * Custom Post Types
 * 
 * @package TuTema
 */

if (!defined('ABSPATH')) {
    exit;
}
// Post type client
// En functions.php o inc/post-types.php
function register_client_post_type()
{
    register_post_type('client', array(
        'labels' => array(
            'name' => __('Clientes'),
            'singular_name' => __('Cliente'),
            'add_new' => __('Agregar cliente'),
            'add_new_item' => __('Agregar nuevo cliente'),
            'edit_item' => __('Editar cliente'),
            'new_item' => __('Nuevo cliente'),
            'view_item' => __('Ver cliente'),
            'search_items' => __('Buscar clientes'),
            'not_found' => __('No se encontraron clientes'),
            'not_found_in_trash' => __('No hay clientes en la papelera')
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'duplicate'),
        'show_in_rest' => true,
        'hierarchical' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-groups',
        'rewrite' => array('slug' => 'clientes')
    ));
}
add_action('init', 'register_client_post_type');

/* // Post type services
function register_service_post_type()
{
    $is_admin = is_admin();
    $labels = array(
        'name' => $is_admin ? 'Servicios' : 'Services',
        'singular_name' => $is_admin ? 'Servicio' : 'Service',
        'add_new' => $is_admin ? 'Agregar servicio' : 'Add Service',
        'add_new_item' => $is_admin ? 'Agregar nuevo servicio' : 'Add New Service',
        'edit_item' => $is_admin ? 'Editar servicio' : 'Edit Service',
        'new_item' => $is_admin ? 'Nuevo servicio' : 'New Service',
        'view_item' => $is_admin ? 'Ver servicio' : 'View Service',
        'search_items' => $is_admin ? 'Buscar servicios' : 'Search Services',
        'not_found' => $is_admin ? 'No se encontraron servicios' : 'No services found',
        'not_found_in_trash' => $is_admin ? 'No hay servicios en la papelera' : 'No services found in trash'
    );

    register_post_type('service', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'duplicate'),
        'show_in_rest' => true,
        'hierarchical' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-hammer',
        'rewrite' => array(
            'slug' => 'services',
            'with_front' => true
        )
    ));

    if(function_exists('pll_register_post_type')) {
        pll_register_post_type('service');
    }
}
add_action('init', 'register_service_post_type'); */

// Post type talent
register_post_type('talent', array(
    'labels' => array(
        'name' => __('Talentos'),
        'singular_name' => __('Talento'),
        'add_new' => __('Agregar talento'),
        'add_new_item' => __('Agregar nuevo talento'),
        'edit_item' => __('Editar talento'),
        'new_item' => __('Nuevo talento'),
        'view_item' => __('Ver talento'),
        'search_items' => __('Buscar talentos'),
        'not_found' => __('No se encontraron talentos'),
        'not_found_in_trash' => __('No hay talentos en la papelera')
    ),
    'public' => true,
    'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'duplicate'),
    'show_in_rest' => true,
    'hierarchical' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-admin-users',
    'rewrite' => array('slug' => 'talentos')
 ));

 // Post type slider with Categories
function register_slider_post_type() {
    register_taxonomy('slider_category', 'slider', array(
        'labels' => array(
            'name' => 'Categorías',
            'singular_name' => 'Categoría'
        ),
        'hierarchical' => true,
        'show_in_rest' => true
    ));
 
    register_post_type('slider', array(
        'labels' => array(
            'name' => 'Sliders',
            'singular_name' => 'Slider',
            'add_new' => 'Agregar slider',
            'add_new_item' => 'Agregar nuevo slider'
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'duplicate'),
        'taxonomies' => array('slider_category'),
        'menu_icon' => 'dashicons-images-alt2',
        'rewrite' => array('slug' => 'sliders')
    ));
 }
 add_action('init', 'register_slider_post_type');

 require_once get_template_directory() . '/inc/post-type-service.php';