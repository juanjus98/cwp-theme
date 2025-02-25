<?php

/**
 * Template part form
 *
 * @package BasherTheme
 */
?>
<section class="sec-form bg-image">
    <div class="container">
        <div class="row">
            <div class=" col-lg-12">
                <div class="cont-desc">
                    <h2 class="header-2 text-white title-motion">Contáctanos</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="entry-content">
                <?php
                // Obtener el ID del formulario seleccionado
                $form_id = carbon_get_the_post_meta('crb_contact_form');
                
                // Si hay un formulario seleccionado, mostrarlo
                if (!empty($form_id)) {
                    echo do_shortcode('[contact-form-7 id="' . esc_attr($form_id) . '"]');
                }
                ?>
            </div>
            <div class=" col-lg-12">
                <?php echo do_shortcode('[contact-form-7 id="9e3d04a" title="Formulario general"]'); ?>
            </div>
        </div>
    </div>
</section>