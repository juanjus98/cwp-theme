<?php

/**
 * Template part form page
 *
 * @package BasherTheme
 */
?>
<section class="sec-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 entry-content">
                <?php
                // Obtener el ID del formulario seleccionado
                $form_id = carbon_get_the_post_meta('crb_contact_form');

                // Si hay un formulario seleccionado, mostrarlo
                if (!empty($form_id)) {
                    echo do_shortcode('[contact-form-7 id="' . esc_attr($form_id) . '"]');
                }
                ?>
            </div>
        </div>
    </div>
</section>