<?php
/**
 * Custom Post Types
 * 
 * @package TuTema
 */

if (!defined('ABSPATH')) {
    exit;
}

class Custom_Post_Types {
    
    public function __construct() {
        add_action('init', array($this, 'registrar_cpt_cliente'));
        add_action('add_meta_boxes', array($this, 'agregar_meta_boxes_cliente'));
        add_action('save_post', array($this, 'guardar_meta_cliente'));
    }

    public function registrar_cpt_cliente() {
        $labels = array(
            'name'                  => 'Clientes',
            'singular_name'         => 'Cliente',
            'menu_name'            => 'Clientes',
            'add_new'              => 'Añadir nuevo',
            'add_new_item'         => 'Añadir nuevo Cliente',
            'edit_item'            => 'Editar Cliente',
            'new_item'             => 'Nuevo Cliente',
            'view_item'            => 'Ver Cliente',
            'search_items'         => 'Buscar Clientes',
            'not_found'            => 'No se encontraron Clientes',
            'not_found_in_trash'   => 'No hay Clientes en la papelera'
        );

        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'query_var'           => true,
            'rewrite'             => array('slug' => 'cliente'),
            'capability_type'     => 'post',
            'has_archive'         => true,
            'hierarchical'        => false,
            'menu_position'       => null,
            'supports'            => array('title'),  // Quitamos 'thumbnail' porque usaremos un campo personalizado para el logo
            'menu_icon'           => 'dashicons-businessperson'
        );

        register_post_type('cliente', $args);
    }

    public function agregar_meta_boxes_cliente() {
        // Meta box para URL y resumen
        add_meta_box(
            'cliente_detalles',
            'Detalles del Cliente',
            array($this, 'cliente_detalles_callback'),
            'cliente',
            'normal',
            'high'
        );

        // Meta box para logo
        add_meta_box(
            'cliente_logo',
            'Logo del Cliente',
            array($this, 'cliente_logo_callback'),
            'cliente',
            'side',
            'high'
        );
    }

    public function cliente_detalles_callback($post) {
        wp_nonce_field('cliente_detalles_nonce', 'cliente_detalles_nonce');
        
        $url = get_post_meta($post->ID, '_cliente_url', true);
        $resumen = get_post_meta($post->ID, '_cliente_resumen', true);
        ?>
        <div class="cliente-campos">
            <p>
                <label for="cliente_url"><strong>URL del sitio web:</strong></label><br>
                <input type="url" id="cliente_url" name="cliente_url" value="<?php echo esc_url($url); ?>" class="widefat" />
            </p>
            
            <p>
                <label for="cliente_resumen"><strong>Resumen:</strong></label><br>
                <textarea id="cliente_resumen" name="cliente_resumen" rows="5" class="widefat"><?php echo esc_textarea($resumen); ?></textarea>
            </p>
        </div>
        <?php
    }

    public function cliente_logo_callback($post) {
        wp_nonce_field('cliente_logo_nonce', 'cliente_logo_nonce');
        
        $logo_id = get_post_meta($post->ID, '_cliente_logo_id', true);
        $logo_url = wp_get_attachment_image_url($logo_id, 'medium');
        ?>
        <div class="cliente-logo-upload">
            <div id="cliente-logo-preview" class="logo-preview">
                <?php if ($logo_url) : ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="Logo preview" style="max-width: 100%; height: auto;" />
                <?php endif; ?>
            </div>
            <input type="hidden" name="cliente_logo_id" id="cliente_logo_id" value="<?php echo esc_attr($logo_id); ?>" />
            <p>
                <button type="button" class="button" id="upload_logo_button">
                    <?php echo $logo_id ? 'Cambiar logo' : 'Subir logo'; ?>
                </button>
                <?php if ($logo_id) : ?>
                    <button type="button" class="button" id="remove_logo_button">Eliminar logo</button>
                <?php endif; ?>
            </p>
        </div>

        <script>
        jQuery(document).ready(function($) {
            let frame;
            
            $('#upload_logo_button').on('click', function(e) {
                e.preventDefault();

                if (frame) {
                    frame.open();
                    return;
                }

                frame = wp.media({
                    title: 'Seleccionar o subir logo',
                    button: {
                        text: 'Usar este logo'
                    },
                    multiple: false
                });

                frame.on('select', function() {
                    const attachment = frame.state().get('selection').first().toJSON();
                    $('#cliente_logo_id').val(attachment.id);
                    $('#cliente-logo-preview').html('<img src="' + attachment.url + '" alt="Logo preview" style="max-width: 100%; height: auto;" />');
                    $('#upload_logo_button').text('Cambiar logo');
                    if (!$('#remove_logo_button').length) {
                        $('#upload_logo_button').after('<button type="button" class="button" id="remove_logo_button">Eliminar logo</button>');
                    }
                });

                frame.open();
            });

            $(document).on('click', '#remove_logo_button', function(e) {
                e.preventDefault();
                $('#cliente_logo_id').val('');
                $('#cliente-logo-preview').empty();
                $('#upload_logo_button').text('Subir logo');
                $(this).remove();
            });
        });
        </script>
        <?php
    }

    public function guardar_meta_cliente($post_id) {
        // Verificar nonce para detalles
        if (isset($_POST['cliente_detalles_nonce']) && wp_verify_nonce($_POST['cliente_detalles_nonce'], 'cliente_detalles_nonce')) {
            if (isset($_POST['cliente_url'])) {
                update_post_meta($post_id, '_cliente_url', sanitize_url($_POST['cliente_url']));
            }
            if (isset($_POST['cliente_resumen'])) {
                update_post_meta($post_id, '_cliente_resumen', sanitize_textarea_field($_POST['cliente_resumen']));
            }
        }

        // Verificar nonce para logo
        if (isset($_POST['cliente_logo_nonce']) && wp_verify_nonce($_POST['cliente_logo_nonce'], 'cliente_logo_nonce')) {
            if (isset($_POST['cliente_logo_id'])) {
                update_post_meta($post_id, '_cliente_logo_id', absint($_POST['cliente_logo_id']));
            }
        }
    }

    public static function mostrar_clientes() {
        $args = array(
            'post_type' => 'cliente',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        );
        
        $clientes = new WP_Query($args);
        
        if ($clientes->have_posts()) : ?>
            <div class="clientes-grid">
                <?php while ($clientes->have_posts()) : $clientes->the_post(); 
                    $logo_id = get_post_meta(get_the_ID(), '_cliente_logo_id', true);
                    $url = get_post_meta(get_the_ID(), '_cliente_url', true);
                    $resumen = get_post_meta(get_the_ID(), '_cliente_resumen', true);
                    ?>
                    <div class="cliente-item">
                        <?php if ($logo_id) : ?>
                            <div class="cliente-logo">
                                <?php if ($url) : ?>
                                    <a href="<?php echo esc_url($url); ?>" target="_blank">
                                        <?php echo wp_get_attachment_image($logo_id, 'medium'); ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo wp_get_attachment_image($logo_id, 'medium'); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($resumen) : ?>
                            <div class="cliente-resumen">
                                <?php echo wp_kses_post($resumen); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata();
        endif;
    }

    public static function obtener_array_clientes() {
        $args = array(
            'post_type' => 'cliente',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        );
        
        $query = new WP_Query($args);
        $clientes = array();
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $logo_id = get_post_meta(get_the_ID(), '_cliente_logo_id', true);
                
                $clientes[] = array(
                    'id' => get_the_ID(),
                    'nombre' => get_the_title(),
                    'logo_url' => $logo_id ? wp_get_attachment_image_url($logo_id, 'medium') : '',
                    'logo_id' => $logo_id,
                    'url' => get_post_meta(get_the_ID(), '_cliente_url', true),
                    'resumen' => get_post_meta(get_the_ID(), '_cliente_resumen', true)
                );
            }
            wp_reset_postdata();
        }
        
        return $clientes;
    }
}

new Custom_Post_Types();