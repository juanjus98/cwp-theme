<?php
// Forzar recarga de estilos y scripts (Activar en desarrollo de CSS y JS)
function always_refresh_styles_scripts( $src ) {
    return add_query_arg( 'ver', time(), $src );
}
add_filter( 'style_loader_src', 'always_refresh_styles_scripts', 10, 1 );
add_filter( 'script_loader_src', 'always_refresh_styles_scripts', 10, 1 );

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
function themename_customize_register( $wp_customize ) {
    // Añadir el control para subir el logotipo móvil en la sección "title_tagline"
    $wp_customize->add_setting( 'mobile_logo', array(
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mobile_logo', array(
        'label'    => __( 'Logotipo Móvil', 'themename' ),
        'section'  => 'title_tagline', // Esta es la sección "Identidad del sitio"
        'settings' => 'mobile_logo',
        'priority' => 9, // Esto colocará el control justo después del logotipo principal
    ) ) );
}
add_action( 'customize_register', 'themename_customize_register' );

// Función para obtener el logotipo móvil
function get_mobile_logo() {
    $mobile_logo = get_theme_mod( 'mobile_logo' );
    if ( $mobile_logo ) {
        return '<img src="' . esc_url( $mobile_logo ) . '" alt="' . get_bloginfo( 'name' ) . '" class="mobile-logo">';
    }
    return '';
}

// Add CTA menu
function add_custom_classes_to_cta_menu($classes, $item, $args) {
    // Verifica si este es el menú CTA
    if($args->theme_location == 'cta-menu') {
        $classes[] = 'nav-item'; // Clase para el elemento li
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_custom_classes_to_cta_menu', 10, 3);

function add_custom_classes_to_cta_menu_links($atts, $item, $args) {
    // Verifica si este es el menú CTA
    if($args->theme_location == 'cta-menu') {
        $atts['class'] = (!empty($atts['class']) ? $atts['class'] . ' ' : '') . 'btn btn-cta';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_custom_classes_to_cta_menu_links', 10, 3);

// Agregar clase al menu-item
function add_menu_item_class($classes, $item, $args) {
    if($args->theme_location == 'menu-2' || $args->theme_location == 'menu-1') {
        $classes[] = 'nav-item';
    }
    return $classes;
 }
 add_filter('nav_menu_css_class', 'add_menu_item_class', 10, 3);
 
 // Agregar clase al link  
 function add_menu_link_class($atts, $item, $args) {
    if($args->theme_location == 'menu-2' || $args->theme_location == 'menu-1') {
        $atts['class'] = 'nav-link'; // Agrega la clase que necesites
    }
    return $atts;
 }
 add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 3);

/*  function add_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'add_font_awesome'); */