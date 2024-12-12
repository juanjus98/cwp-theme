<?php

/**
 * Template part para mostrar lista de clientes
 *
 * @package TuTema
 */

$clientes = Custom_Post_Types::obtener_array_clientes();

if (!empty($clientes)) : ?>
    <section class="sec-clients-logos">
        <div class="slider">
            <div class="slide_track">
                <?php foreach ($clientes as $cliente) : ?>
                    <?php if ($cliente['logo_url']) : ?>
                        <img src="<?php echo esc_url($cliente['logo_url']); ?>" alt="<?php echo esc_attr($cliente['nombre']); ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="slide_track">
                <?php foreach ($clientes as $cliente) : ?>
                    <?php if ($cliente['logo_url']) : ?>
                        <img src="<?php echo esc_url($cliente['logo_url']); ?>" alt="<?php echo esc_attr($cliente['nombre']); ?>">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>