<?php
/**
 * Customizer Settings para Redes Sociales
 * 
 * @package TuTema
 */

if (!defined('ABSPATH')) {
    exit;
}

class Theme_Social_Customizer {
    
    public function __construct() {
        add_action('customize_register', array($this, 'register_social_customizer'));
    }

    public function register_social_customizer($wp_customize) {
        // Agregar nueva sección
        $wp_customize->add_section('social_links', array(
            'title'    => __('Redes Sociales', 'tu-tema'),
            'priority' => 30,
        ));

        // Array de redes sociales
        $social_networks = array(
            'instagram' => array(
                'label' => 'Instagram',
                'default' => '',
            ),
            'linkedin' => array(
                'label' => 'LinkedIn',
                'default' => '',
            ),
            'discord' => array(
                'label' => 'Discord',
                'default' => '',
            ),
            'youtube' => array(
                'label' => 'YouTube',
                'default' => '',
            ),
            'facebook' => array(
                'label' => 'Facebook',
                'default' => '',
            ),
            'tiktok' => array(
                'label' => 'TikTok',
                'default' => '',
            ),
        );

        // Registrar settings y controls para cada red social
        foreach ($social_networks as $network => $data) {
            // Agregar setting
            $wp_customize->add_setting("social_${network}", array(
                'default'           => $data['default'],
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'refresh',
            ));

            // Agregar control
            $wp_customize->add_control("social_${network}_control", array(
                'label'    => $data['label'],
                'section'  => 'social_links',
                'settings' => "social_${network}",
                'type'     => 'url',
            ));
        }
    }

    /**
     * Obtener URLs de redes sociales
     */
    public static function get_social_links() {
        return array(
            'instagram' => get_theme_mod('social_instagram', ''),
            'linkedin'  => get_theme_mod('social_linkedin', ''),
            'discord'   => get_theme_mod('social_discord', ''),
            'youtube'   => get_theme_mod('social_youtube', ''),
            'facebook'  => get_theme_mod('social_facebook', ''),
            'tiktok'    => get_theme_mod('social_tiktok', ''),
        );
    }

    /**
     * Renderizar íconos de redes sociales
     */
    public static function render_social_icons() {
        $social_links = self::get_social_links();
        
        if (!array_filter($social_links)) return; // Si no hay links, no mostrar nada
        
        $icons = array(
            'instagram' => 'soc-icon icon-instagram',
            'linkedin'  => 'soc-icon icon-linkedin',
            'discord'   => 'soc-icon icon-discord',
            'youtube'   => 'soc-icon icon-youtube',
            'facebook'  => 'soc-icon icon-facebook',
            'tiktok'    => 'soc-icon icon-tiktok',
        );
        
        echo '<div class="social-icons">';
        foreach ($social_links as $network => $url) {
            if (!empty($url)) {
                printf(
                    '<a href="%s" target="_blank" rel="noopener noreferrer" class="social-icon %s" aria-label="%s"></a>',
                    esc_url($url),
                    esc_attr($network),
                    esc_attr(ucfirst($network))
                );
            }
        }
        echo '</div>';
    }
}

// Inicializar la clase
new Theme_Social_Customizer();