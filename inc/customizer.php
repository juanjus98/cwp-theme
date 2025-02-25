<?php

/**
 * Activar debug mode
 */
function activate_debug_mode()
{
    if (!defined('WP_DEBUG')) {
        define('WP_DEBUG', true);
    }
    if (!defined('WP_DEBUG_LOG')) {
        define('WP_DEBUG_LOG', true);
    }
    if (!defined('WP_DEBUG_DISPLAY')) {
        define('WP_DEBUG_DISPLAY', true);
    }
    if (!defined('SCRIPT_DEBUG')) {
        define('SCRIPT_DEBUG', true);
    }
    @ini_set('display_errors', 1);
}
add_action('init', 'activate_debug_mode');

/**
 * Mostrar errores en el frontend
 */
function show_all_errors()
{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
add_action('init', 'show_all_errors');

// Forzar recarga de estilos y scripts (Activar en desarrollo de CSS y JS)
function always_refresh_styles_scripts($src)
{
    return add_query_arg('ver', time(), $src);
}
add_filter('style_loader_src', 'always_refresh_styles_scripts', 10, 1);
add_filter('script_loader_src', 'always_refresh_styles_scripts', 10, 1);

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
    require_once get_template_directory() . '/inc/class-bootstrap-nav-walker.php';
}
add_action('after_setup_theme', 'register_navwalker');

/**
 * Bootstrap 5 nav walker implementation
 */
function cwp_theme_menu()
{
    wp_nav_menu(array(
        'theme_location' => 'menu-1',
        'container' => false,
        'menu_class' => 'navbar-nav navbar-menu ms-auto',
        'fallback_cb' => '__return_false',
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth' => 2,
        'walker' => new Bootstrap_Nav_Walker()
    ));
}

/* function register_cta_menu() {
    register_nav_menu('cta-menu', __('Menú CTA'));
}
add_action('after_setup_theme', 'register_cta_menu'); */

/* Custom logo mobile */
function themename_customize_register($wp_customize)
{
    // Añadir el control para subir el logotipo móvil en la sección "title_tagline"
    $wp_customize->add_setting('mobile_logo', array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'mobile_logo', array(
        'label'    => __('Logotipo Móvil', 'themename'),
        'section'  => 'title_tagline', // Esta es la sección "Identidad del sitio"
        'settings' => 'mobile_logo',
        'priority' => 9, // Esto colocará el control justo después del logotipo principal
    )));
}
add_action('customize_register', 'themename_customize_register');

// Función para obtener el logotipo móvil
function get_mobile_logo()
{
    $mobile_logo = get_theme_mod('mobile_logo');
    if ($mobile_logo) {
        return '<img src="' . esc_url($mobile_logo) . '" alt="' . get_bloginfo('name') . '" class="mobile-logo">';
    }
    return '';
}

// Add CTA menu
function add_custom_classes_to_cta_menu($classes, $item, $args)
{
    // Verifica si este es el menú CTA
    if ($args->theme_location == 'cta-menu') {
        $classes[] = 'nav-item'; // Clase para el elemento li
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_custom_classes_to_cta_menu', 10, 3);

function add_custom_classes_to_cta_menu_links($atts, $item, $args)
{
    // Verifica si este es el menú CTA
    if ($args->theme_location == 'cta-menu') {
        $atts['class'] = (!empty($atts['class']) ? $atts['class'] . ' ' : '') . 'btn btn-cta';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_custom_classes_to_cta_menu_links', 10, 3);

// Agregar clase al menu-item
function add_menu_item_class($classes, $item, $args)
{
    if ($args->theme_location == 'menu-2' || $args->theme_location == 'menu-1') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_item_class', 10, 3);

// Agregar clase al link  
function add_menu_link_class($atts, $item, $args)
{
    if ($args->theme_location == 'menu-2' || $args->theme_location == 'menu-1') {
        $atts['class'] = 'nav-link'; // Agrega la clase que necesites
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 3);

/*  function add_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'add_font_awesome'); */

//Images
function get_theme_image_url($image)
{
    return esc_url(get_template_directory_uri() . '/assets/images/' . $image);
}

// Menu header idioma
function get_language_switcher()
{
    if (function_exists('pll_current_language')) {
        $current_lang = pll_current_language();
        $alternate_lang = ($current_lang == 'es') ? 'en' : 'es';
        $languages = pll_the_languages(array('raw' => 1));

        if (isset($languages[$alternate_lang])) {
            $alternate_url = $languages[$alternate_lang]['url'];
            $flag_url = $languages[$alternate_lang]['flag'];

            return '<a href="' . $alternate_url . '" class="lang-switch">
                      <img src="' . $flag_url . '" alt="' . strtoupper($alternate_lang) . '"> 
                      ' . strtoupper($alternate_lang) . '
                   </a>';
        }
        return '';
    }
    return '';
}

//Quitar p contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');

// Featured clients
function get_featured_clients($limit = -1)
{
    $args = array(
        'post_type' => 'client',
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => '_client_card_featured',
                'value' => 'yes'
            )
        ),
        'meta_key' => '_client_card_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
    );

    $clients = array();
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $clients[] = array(
                'title' => carbon_get_post_meta(get_the_ID(), 'client_card_title'),
                'description' => carbon_get_post_meta(get_the_ID(), 'client_card_description'),
                'image' => wp_get_attachment_image_url(carbon_get_post_meta(get_the_ID(), 'client_card_image'), 'full'),
                'url' => get_permalink()
            );
        }
    }
    wp_reset_postdata();

    return $clients;
}

// Featured services
function get_featured_services($limit = -1)
{
    $args = array(
        'post_type' => 'service',
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => '_service_card_featured',
                'value' => 'yes'
            )
        ),
        'meta_key' => '_service_card_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
    );

    $services = array();
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $services[] = array(
                'title' => carbon_get_post_meta(get_the_ID(), 'service_card_title'),
                'description' => carbon_get_post_meta(get_the_ID(), 'service_card_description'),
                'image' => wp_get_attachment_image_url(carbon_get_post_meta(get_the_ID(), 'service_card_image'), 'full'),
                'url' => get_permalink()
            );
        }
    }
    wp_reset_postdata();

    return $services;
}

// Featured talents
function get_featured_talents($limit = -1)
{
    $args = array(
        'post_type' => 'talent',
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => '_talent_card_featured',
                'value' => 'yes'
            )
        ),
        'meta_key' => '_talent_card_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
    );

    $talents = array();
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $talents[] = array(
                'title' => carbon_get_post_meta(get_the_ID(), 'talent_card_title'),
                'description' => carbon_get_post_meta(get_the_ID(), 'talent_card_description'),
                'image' => wp_get_attachment_image_url(carbon_get_post_meta(get_the_ID(), 'talent_card_image'), 'full'),
                'url' => get_permalink()
            );
        }
    }
    wp_reset_postdata();

    return $talents;
}

// Featured sliders whit category
function get_featured_sliders($category = '', $limit = -1)
{
    $args = array(
        'post_type' => 'slider',
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => '_slider_card_featured',
                'value' => 'yes'
            )
        ),
        'meta_key' => '_slider_card_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
    );

    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'slider_category',
                'field' => 'slug',
                'terms' => $category
            )
        );
    }

    $sliders = array();
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $sliders[] = array(
                'type' => carbon_get_post_meta(get_the_ID(), 'slider_card_type'),
                'title' => carbon_get_post_meta(get_the_ID(), 'slider_card_title'),
                'description' => carbon_get_post_meta(get_the_ID(), 'slider_card_description'),
                'image' => wp_get_attachment_image_url(carbon_get_post_meta(get_the_ID(), 'slider_card_image'), 'full'),
                'logo' => wp_get_attachment_image_url(carbon_get_post_meta(get_the_ID(), 'slider_card_logo'), 'full'),
                'url' => get_permalink()
            );
        }
    }
    wp_reset_postdata();

    return $sliders;
}

// Show category column
function add_slider_category_column($columns)
{
    $new_columns = array();
    foreach ($columns as $key => $title) {
        if ($key === 'date') {
            $new_columns['slider_category'] = 'Categoría';
        }
        $new_columns[$key] = $title;
    }
    return $new_columns;
}
add_filter('manage_slider_posts_columns', 'add_slider_category_column');

function display_slider_category_column($column, $post_id)
{
    if ($column === 'slider_category') {
        $terms = get_the_terms($post_id, 'slider_category');
        if ($terms) {
            echo esc_html(join(', ', wp_list_pluck($terms, 'name')));
        }
    }
}
add_action('manage_slider_posts_custom_column', 'display_slider_category_column', 10, 2);

// Sections config
function get_services_section_config()
{
    return array(
        'active' => carbon_get_post_meta(get_option('page_on_front'), 'services_section_active'),
        'title' => carbon_get_post_meta(get_option('page_on_front'), 'services_section_title'),
        'subtitle' => carbon_get_post_meta(get_option('page_on_front'), 'services_section_subtitle'),
        'description' => carbon_get_post_meta(get_option('page_on_front'), 'services_section_description')
    );
}

function get_talents_section_config()
{
    return array(
        'active' => carbon_get_post_meta(get_option('page_on_front'), 'talents_section_active'),
        'title' => carbon_get_post_meta(get_option('page_on_front'), 'talents_section_title'),
        'subtitle' => carbon_get_post_meta(get_option('page_on_front'), 'talents_section_subtitle'),
        'description' => carbon_get_post_meta(get_option('page_on_front'), 'talents_section_description')
    );
}

function get_slider1_section_config()
{
    return array(
        'active' => carbon_get_post_meta(get_option('page_on_front'), 'slider1_section_active'),
        'title' => carbon_get_post_meta(get_option('page_on_front'), 'slider1_section_title'),
        'subtitle' => carbon_get_post_meta(get_option('page_on_front'), 'slider1_section_subtitle'),
        'description' => carbon_get_post_meta(get_option('page_on_front'), 'slider1_section_description')
    );
}

function get_slider2_section_config()
{
    return array(
        'active' => carbon_get_post_meta(get_option('page_on_front'), 'slider2_section_active'),
        'title' => carbon_get_post_meta(get_option('page_on_front'), 'slider2_section_title'),
        'subtitle' => carbon_get_post_meta(get_option('page_on_front'), 'slider2_section_subtitle'),
        'description' => carbon_get_post_meta(get_option('page_on_front'), 'slider2_section_description')
    );
}

// Section config
function get_section_config($section_name)
{
    $config = array(
        'services' => get_services_section_config(),
        'talents' => get_talents_section_config(),
        'slider1' => get_slider1_section_config(),
        'slider2' => get_slider2_section_config()
    );

    return isset($config[$section_name]) ? $config[$section_name] : null;
}

// Services cards data
function get_services_cards_data($post_id = null)
{
    if (is_null($post_id)) {
        $post_id = get_the_ID();
    }

    // Obtener datos de la sección información
    $section_data = array(
        'title' => carbon_get_post_meta($post_id, 'services_title'),
        'description' => carbon_get_post_meta($post_id, 'services_description'),
        'cards' => array()
    );

    // Obtener todos los cards
    $cards = carbon_get_post_meta($post_id, 'services_cards');

    // Si hay cards, procesar cada uno
    if (!empty($cards) && is_array($cards)) {
        foreach ($cards as $card) {
            $card_data = array(
                'title' => $card['card_title'],
                'description' => $card['card_description'],
                'image' => array(
                    'id' => $card['card_image'],
                    'url' => wp_get_attachment_url($card['card_image']),
                    'alt' => get_post_meta($card['card_image'], '_wp_attachment_image_alt', true)
                )
            );

            $section_data['cards'][] = $card_data;
        }
    }

    return $section_data;
}

// FQs section data
function get_faqs_section_data($post_id = null)
{
    if (is_null($post_id)) {
        $post_id = get_the_ID();
    }

    // Obtener datos de la sección información
    $section_data = array(
        'title' => carbon_get_post_meta($post_id, 'faqs_title'),
        'description' => carbon_get_post_meta($post_id, 'faqs_description'),
        'faqs' => array()
    );

    // Obtener todas las preguntas frecuentes
    $faqs = carbon_get_post_meta($post_id, 'faqs_items');

    // Si hay preguntas frecuentes, procesar cada una
    if (!empty($faqs) && is_array($faqs)) {
        foreach ($faqs as $faq) {
            $section_data['faqs'][] = array(
                'question' => $faq['faq_question'],
                'answer' => $faq['faq_answer']
            );
        }
    }

    return $section_data;
}

//Section logos
function get_logos_data($post_id = null)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $logos_data = array(
        'title' => carbon_get_post_meta($post_id, 'logos_title'),
        'description' => carbon_get_post_meta($post_id, 'logos_description'),
        'logos' => array()
    );

    // Obtener los logos
    $logos = carbon_get_post_meta($post_id, 'logos_items');

    if (!empty($logos)) {
        foreach ($logos as $logo) {
            $logos_data['logos'][] = array(
                'name' => isset($logo['logo_name']) ? $logo['logo_name'] : '',
                'image' => array(
                    'url' => wp_get_attachment_image_url($logo['logo_image'], 'full'),
                    'alt' => isset($logo['logo_name']) ? $logo['logo_name'] : get_post_meta($logo['logo_image'], '_wp_attachment_image_alt', true)
                ),
                'url' => isset($logo['logo_url']) ? $logo['logo_url'] : ''
            );
        }
    }

    return $logos_data;
}

// Get jumbotron data
function get_jumbotron_data()
{
    $jumbotron_data = array(
        'title'    => carbon_get_post_meta(get_the_ID(), 'jumbotron_title'),
        'subtitle' => carbon_get_post_meta(get_the_ID(), 'jumbotron_subtitle'),
        'cta'      => array(
            'text'   => carbon_get_post_meta(get_the_ID(), 'jumbotron_cta_text'),
            'url'    => carbon_get_post_meta(get_the_ID(), 'jumbotron_cta_url'),
            'target' => carbon_get_post_meta(get_the_ID(), 'jumbotron_cta_target')
        )
    );

    return $jumbotron_data;
}

// Page title H1
function has_h1_in_content($content = null)
{
    if ($content === null) {
        $content = get_the_content();
    }

    return preg_match('/<h1[^>]*>.*?<\/h1>/i', $content);
}

function get_h1_from_content($content = null)
{
    if ($content === null) {
        $content = get_the_content();
    }

    preg_match('/<h1[^>]*>(.*?)<\/h1>/i', $content, $matches);
    return isset($matches[1]) ? strip_tags($matches[1]) : '';
}

// Icons section data
function get_icons_section_data()
{
    $post_id = get_the_ID();

    // Obtener datos de la pestaña Información
    $info = array(
        'title' => carbon_get_post_meta($post_id, 'icons_title'),
        'description' => carbon_get_post_meta($post_id, 'icons_description'),
        'image' => array(
            'id' => carbon_get_post_meta($post_id, 'icons_image'),
            'url' => wp_get_attachment_image_url(carbon_get_post_meta($post_id, 'icons_image'), 'full')
        )
    );

    // Obtener datos de los Iconos
    $icons = array();
    $icons_data = carbon_get_post_meta($post_id, 'icons_items');

    if (!empty($icons_data)) {
        foreach ($icons_data as $icon) {
            $icons[] = array(
                'title' => $icon['icon_title'],
                'description' => $icon['icon_description'],
                'image' => array(
                    'id' => $icon['icon_image'],
                    'url' => wp_get_attachment_image_url($icon['icon_image'], 'full')
                )
            );
        }
    }

    // Obtener datos del Botón
    $button = array(
        'section_title' => carbon_get_post_meta($post_id, 'icons_button_title'),
        'section_description' => carbon_get_post_meta($post_id, 'icons_button_description'),
        'cta' => array(
            'text' => carbon_get_post_meta($post_id, 'icons_cta_text'),
            'url' => carbon_get_post_meta($post_id, 'icons_cta_url'),
            'target' => carbon_get_post_meta($post_id, 'icons_cta_target')
        )
    );

    // Estructura final de datos
    return array(
        'info' => $info,
        'icons' => $icons,
        'button' => $button,
        'has_button' => !empty($button['cta']['text']) && !empty($button['cta']['url'])
    );
}

// Get forms list
function get_contact_form7_list() {
    $contact_forms = array(
        '' => 'Seleccionar formulario' // Opción por defecto
    );
    
    // Verificar si Contact Form 7 está activo
    if (class_exists('WPCF7_ContactForm')) {
        $args = array(
            'post_type' => 'wpcf7_contact_form',
            'posts_per_page' => -1,
        );
        
        $forms = get_posts($args);
        
        if (!empty($forms)) {
            foreach ($forms as $form) {
                $contact_forms[$form->ID] = $form->post_title;
            }
        }
    }
    
    return $contact_forms;
}


// Remover versión de WordPress del head
remove_action('wp_head', 'wp_generator');

// Remover enlaces RSD
remove_action('wp_head', 'rsd_link');

// Remover enlaces wlwmanifest
remove_action('wp_head', 'wlwmanifest_link');