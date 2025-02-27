<?php
/**
 * wp-theme-antuca functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp-theme-antuca
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function wp_theme_antuca_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('wp-theme-antuca', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Menú principal izquierda', 'wp-theme-antuca'),
            'menu-2' => esc_html__('Menú principal derecha', 'wp-theme-antuca'),
            'menu-3' => esc_html__('Menú footer', 'wp-theme-antuca'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'wp_theme_antuca_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'wp_theme_antuca_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_theme_antuca_content_width()
{
    $GLOBALS['content_width'] = apply_filters('wp_theme_antuca_content_width', 640);
}
add_action('after_setup_theme', 'wp_theme_antuca_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function wp_theme_antuca_scripts()
{
    wp_enqueue_style('wp-theme-antuca-style', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION);
    wp_enqueue_script('wp-theme-antuca-script', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wp_theme_antuca_scripts');

/**
 * Custom template tags for this theme.
 */
// require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/class-theme-social-customizer.php';
//require get_template_directory() . '/inc/customizer.php';

/**
 * Incluir Custom Post Types
 */
require_once get_template_directory() . '/inc/post-types.php';

/**
 * Carbon fields
 */
require_once get_template_directory() . '/vendor/autoload.php';
require_once get_template_directory() . '/inc/carbon-fields.php';

require_once get_template_directory() . '/inc/customizer.php';