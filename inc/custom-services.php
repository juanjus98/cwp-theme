<?php

/**
 * Plugin Name: Custom Services Post Type
 * Description: Agrega un tipo de contenido personalizado para Servicios
 * Version: 1.0
 * Author: Your Name
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Registrar Custom Post Type Servicios
function register_services_post_type()
{
    $labels = array(
        'name'                  => _x('Servicios', 'Post Type General Name', 'text-domain'),
        'singular_name'         => _x('Servicio', 'Post Type Singular Name', 'text-domain'),
        'menu_name'            => __('Servicios', 'text-domain'),
        'add_new'              => __('Añadir Nuevo', 'text-domain'),
        'add_new_item'         => __('Añadir Nuevo Servicio', 'text-domain'),
        'edit_item'            => __('Editar Servicio', 'text-domain'),
        'new_item'             => __('Nuevo Servicio', 'text-domain'),
        'view_item'            => __('Ver Servicio', 'text-domain'),
        'search_items'         => __('Buscar Servicios', 'text-domain'),
        'not_found'            => __('No se encontraron servicios', 'text-domain'),
        'not_found_in_trash'   => __('No hay servicios en la papelera', 'text-domain'),
    );

    $args = array(
        'label'               => __('Servicios', 'text-domain'),
        'description'         => __('Servicios de la empresa', 'text-domain'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-grid-view',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true, // Habilita Gutenberg
        'rewrite'            => array('slug' => 'servicios')
    );

    register_post_type('servicios', $args);
}
add_action('init', 'register_services_post_type');

// Agregar campos personalizados con ACF
function services_acf_fields()
{
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_services',
            'title' => 'Detalles del Servicio',
            'fields' => array(
                array(
                    'key' => 'field_service_icon',
                    'label' => 'Icono del Servicio',
                    'name' => 'service_icon',
                    'type' => 'image',
                    'instructions' => 'Sube un icono para este servicio',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                array(
                    'key' => 'field_service_short_description',
                    'label' => 'Descripción Corta',
                    'name' => 'service_short_description',
                    'type' => 'textarea',
                    'instructions' => 'Añade una breve descripción del servicio',
                    'required' => 0,
                    'rows' => 3,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'servicios',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf_init', 'services_acf_fields');

// Agregar shortcode para mostrar servicios
function display_services_shortcode($atts)
{
    $args = shortcode_atts(array(
        'cantidad' => -1,
        'columnas' => 3
    ), $atts);

    $services = get_posts(array(
        'post_type' => 'servicios',
        'posts_per_page' => $args['cantidad'],
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    if (empty($services)) {
        return '<p>No hay servicios disponibles.</p>';
    }

    $output = '<div class="servicios-grid columnas-' . esc_attr($args['columnas']) . '">';

    foreach ($services as $service) {
        $thumbnail = get_the_post_thumbnail_url($service->ID, 'large');
        $short_description = get_field('service_short_description', $service->ID);

        $output .= '<div class="servicio-card">';
        if ($thumbnail) {
            $output .= '<div class="servicio-imagen">';
            $output .= '<img src="' . esc_url($thumbnail) . '" alt="' . esc_attr($service->post_title) . '">';
            $output .= '</div>';
        }
        $output .= '<div class="servicio-contenido">';
        $output .= '<h3>' . esc_html($service->post_title) . '</h3>';
        if ($short_description) {
            $output .= '<p>' . esc_html($short_description) . '</p>';
        }
        $output .= '</div>';
        $output .= '</div>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('servicios', 'display_services_shortcode');

// Agregar estilos CSS
function add_services_styles()
{
    $css = '
        .servicios-grid {
            display: grid;
            gap: 2rem;
            padding: 2rem 0;
        }
        
        .columnas-1 { grid-template-columns: 1fr; }
        .columnas-2 { grid-template-columns: repeat(2, 1fr); }
        .columnas-3 { grid-template-columns: repeat(3, 1fr); }
        
        @media (max-width: 768px) {
            .servicios-grid {
                grid-template-columns: 1fr !important;
            }
        }
        
        .servicio-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .servicio-card:hover {
            transform: translateY(-5px);
        }
        
        .servicio-imagen img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .servicio-contenido {
            padding: 1.5rem;
        }
        
        .servicio-contenido h3 {
            margin: 0 0 1rem;
            font-size: 1.25rem;
            color: #333;
        }
        
        .servicio-contenido p {
            margin: 0;
            color: #666;
            line-height: 1.5;
        }
    ';

    wp_add_inline_style('theme-style', $css);
}
add_action('wp_enqueue_scripts', 'add_services_styles');