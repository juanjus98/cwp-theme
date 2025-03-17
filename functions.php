<?php
/**
 * BasherTheme functions and definitions
 * @package BasherTheme
 */

// Prevenir acceso directo al archivo
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

/**
 * Definir el entorno
 * Cambia esto según tu entorno actual:
 * 'development' - Desarrollo local
 * 'staging' - Entorno de pruebas
 * '' - Entorno de producción
 */
if (!defined('WP_ENVIRONMENT_TYPE')) {
    define('WP_ENVIRONMENT_TYPE', 'production');
}

// Definir constantes del tema
define('THEME_VERSION', '1.0.0');
define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_ASSETS', THEME_URL . '/assets');

// Configuración basada en el entorno
if (WP_ENVIRONMENT_TYPE === 'production') {
    // Configuración de producción
    if (!defined('DISALLOW_FILE_EDIT')) {
        define('DISALLOW_FILE_EDIT', true);      // Deshabilitar editor de archivos
    }
    if (!defined('DISALLOW_FILE_MODS')) {
        define('DISALLOW_FILE_MODS', true);      // Deshabilitar instalación de plugins
    }
    if (!defined('WP_DEBUG')) {
        define('WP_DEBUG', false);               // Deshabilitar debugging
    }
    if (!defined('SCRIPT_DEBUG')) {
        define('SCRIPT_DEBUG', false);           // Deshabilitar debug de scripts
    }
    if (!defined('FORCE_SSL_ADMIN')) {
        define('FORCE_SSL_ADMIN', true);         // Forzar SSL en admin
    }
} else {
    // Configuración de desarrollo
    if (!defined('DISALLOW_FILE_EDIT')) {
        define('DISALLOW_FILE_EDIT', false);     // Permitir editor de archivos
    }
    if (!defined('DISALLOW_FILE_MODS')) {
        define('DISALLOW_FILE_MODS', false);     // Permitir instalación de plugins
    }
    if (!defined('WP_DEBUG')) {
        define('WP_DEBUG', true);                // Habilitar debugging
    }
    if (!defined('WP_DEBUG_LOG')) {
        define('WP_DEBUG_LOG', true);            // Habilitar log de errores
    }
    if (!defined('WP_DEBUG_DISPLAY')) {
        define('WP_DEBUG_DISPLAY', true);        // Mostrar errores en pantalla
    }
    if (!defined('SCRIPT_DEBUG')) {
        define('SCRIPT_DEBUG', true);            // Habilitar debug de scripts
    }
    if (!defined('SAVEQUERIES')) {
        define('SAVEQUERIES', true);             // Guardar queries para debugging
    }
}

/**
 * Configuración principal del tema
 */
class BasherTheme_Setup {
    /**
     * Constructor
     */
    public function __construct() {
        // Inicializar funciones principales
        add_action('after_setup_theme', [$this, 'theme_setup']);
        add_action('after_setup_theme', [$this, 'content_width'], 0);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        
        // Limpieza y seguridad solo en producción
        if (WP_ENVIRONMENT_TYPE === 'production') {
            add_filter('style_loader_src', [$this, 'remove_version_strings']);
            add_filter('script_loader_src', [$this, 'remove_version_strings']);
            add_action('init', [$this, 'security_headers']);
            add_filter('xmlrpc_enabled', '__return_false');
            remove_action('wp_head', 'wp_generator');
        }
        
        // Cargar dependencias
        $this->load_dependencies();
    }

    /**
     * Configuración del tema
     */
    public function theme_setup() {
        load_theme_textdomain('BasherTheme', THEME_PATH . '/languages');
        
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script'
        ]);

        // Registro de menús con sanitización
        register_nav_menus([
            'menu-1' => esc_html__('Menú principal izquierda', 'BasherTheme'),
            'menu-2' => esc_html__('Menú principal derecha', 'BasherTheme'),
            'menu-3' => esc_html__('Menú footer', 'BasherTheme')
        ]);

        // Configuración del logo personalizado
        add_theme_support('custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ]);
    }

    /**
     * Establecer ancho del contenido
     */
    public function content_width() {
        $GLOBALS['content_width'] = apply_filters('BasherTheme_content_width', 640);
    }

    /**
     * Encolar assets con versión dinámica para cache busting
     */
    public function enqueue_assets() {
        if (WP_ENVIRONMENT_TYPE === 'production') {
            // En producción, usar versiones minificadas y cache busting
            $css_version = filemtime(THEME_PATH . '/assets/css/style.min.css') ?: THEME_VERSION;
            $js_version = filemtime(THEME_PATH . '/assets/js/main.min.js') ?: THEME_VERSION;
            
            wp_enqueue_style('BasherTheme-style', THEME_ASSETS . '/css/style.min.css', [], $css_version);
            wp_enqueue_script('BasherTheme-script', THEME_ASSETS . '/js/main.min.js', [], $js_version, true);
        } else {
            // En desarrollo, usar archivos sin minificar
            wp_enqueue_style('BasherTheme-style', THEME_ASSETS . '/css/style.css', [], THEME_VERSION);
            wp_enqueue_script('BasherTheme-script', THEME_ASSETS . '/js/main.js', [], THEME_VERSION, true);
        }

        // Nonce para CSP
        $nonce = wp_create_nonce('theme_script_nonce');
        wp_add_inline_script('BasherTheme-script', 'const themeNonce = "' . esc_js($nonce) . '";');
    }

    /**
     * Remover cadenas de versión de assets para seguridad
     */
    public function remove_version_strings($src) {
        if (strpos($src, 'ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }

    /**
     * Agregar headers de seguridad
     */
    public function security_headers() {
        if (!is_admin() && WP_ENVIRONMENT_TYPE === 'production') {
            header('X-Content-Type-Options: nosniff');
            header('X-Frame-Options: SAMEORIGIN');
            header('X-XSS-Protection: 1; mode=block');
            header('Referrer-Policy: strict-origin-when-cross-origin');
            header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
            
            // CSP más estricto en producción
            header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https:; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' data: https://fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self' https:; media-src 'self'; object-src 'none'; frame-src 'self' https:;");
        }
    }

    /**
     * Cargar dependencias necesarias
     */
    private function load_dependencies() {
        $files = [
            '/inc/class-theme-social-customizer.php',
            '/inc/post-types.php',
            '/vendor/autoload.php',
            '/inc/carbon-fields.php',
            '/inc/customizer.php'
        ];

        foreach ($files as $file) {
            if (file_exists(THEME_PATH . $file)) {
                require_once THEME_PATH . $file;
            }
        }
    }
}

// Inicializar la clase principal
new BasherTheme_Setup();

/**
 * Función personalizada para mostrar el logo con link
 */
function get_custom_logo_with_link() {
    $custom_logo_id = get_theme_mod('custom_logo');
    $html = '';

    if ($custom_logo_id) {
        $custom_logo_attr = [
            'class'    => 'custom-logo',
            'loading'  => 'lazy',
        ];

        // Si estamos en la página de inicio, agregar clase adicional
        if (is_front_page() || is_home()) {
            $custom_logo_attr['class'] .= ' custom-logo-home';
        }

        // Obtener la imagen del logo con atributos personalizados
        $image = wp_get_attachment_image($custom_logo_id, 'full', false, $custom_logo_attr);

        // Crear el HTML con el enlace
        $html = sprintf(
            '<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
            esc_url(home_url('/')),
            $image
        );
    }

    return $html;
}

/**
 * Funciones adicionales de seguridad solo en producción
 */
if (WP_ENVIRONMENT_TYPE === 'production') {
    // Limitar intentos de login fallidos
    function limit_login_attempts($user, $username, $password) {
        if (!session_id()) {
            session_start();
        }
        
        $failed_login_limit = 5;
        $lockout_duration = 15 * MINUTE_IN_SECONDS;
        $failed_login_count = isset($_SESSION['failed_login_count']) ? $_SESSION['failed_login_count'] : 0;
        
        if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) {
            return new WP_Error('locked_out', 'Demasiados intentos fallidos. Por favor, intente más tarde.');
        }
        
        if (!$user instanceof WP_User) {
            $_SESSION['failed_login_count'] = $failed_login_count + 1;
            
            if ($_SESSION['failed_login_count'] >= $failed_login_limit) {
                $_SESSION['lockout_time'] = time() + $lockout_duration;
                $_SESSION['failed_login_count'] = 0;
                return new WP_Error('locked_out', 'Demasiados intentos fallidos. Por favor, intente más tarde.');
            }
        } else {
            $_SESSION['failed_login_count'] = 0;
        }
        
        return $user;
    }
    add_filter('authenticate', 'limit_login_attempts', 30, 3);
}

/**
 * Funciones de ayuda para desarrollo
 */
if (WP_ENVIRONMENT_TYPE !== 'production') {
    // Función para depuración
    function debug_to_console($data) {
        if (is_array($data) || is_object($data)) {
            echo "<script>console.log('Debug: " . json_encode($data) . "');</script>";
        } else {
            echo "<script>console.log('Debug: " . $data . "');</script>";
        }
    }
}

// Sanitización de datos (siempre activa)
function theme_sanitize_data($data) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = theme_sanitize_data($value);
        }
    } else {
        $data = sanitize_text_field($data);
    }
    return $data;
}