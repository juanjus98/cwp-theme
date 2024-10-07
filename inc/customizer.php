<?php
/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
    require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

/**
 * Bootstrap 5 nav walker implementation
 */
function wp_theme_antuca_bootstrap_menu() {
    wp_nav_menu( array(
        'theme_location'  => 'menu-1',
        'depth'           => 2,
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse',
        'container_id'    => 'navbarSupportedContent',
        'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0',
        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
        'walker'          => new WP_Bootstrap_Navwalker(),
    ) );
}
