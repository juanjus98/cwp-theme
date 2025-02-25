<?php

/**
 * Template part Benefits
 *
 * @package BasherTheme
 */

// Get icons data
$icons_section = get_icons_section_data();

// Verificar si hay título
if (empty($icons_section['info']['title'])) {
    return;
}

// Extraer datos con comprobación segura
$title = $icons_section['info']['title'] ?? '';
$description = $icons_section['info']['description'] ?? '';
$icons = $icons_section['icons'] ?? [];

$button = $icons_section['button'];
$description = $button['section_description'];
$has_button = isset($button['cta']) ? $button['cta'] : false;

// Procesar imagen
$image_url = '';
if (isset($icons_section['info']['image'])) {
    if (is_string($icons_section['info']['image'])) {
        $image_url = $icons_section['info']['image'];
    } elseif (is_array($icons_section['info']['image'])) {
        $image_url = $icons_section['info']['image']['url'] ?? '';
    }
}
?>

<section class="sec-benefits-page">
    <div class="container">
        <div class="row">
            <!-- Imagen a la izquierda -->
            <div class="col-lg-6">
                <?php if (!empty($image_url)) : ?>
                    <img src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($icons_section['info']['image_alt'] ?? 'Equipo Basher'); ?>"
                        class="img-fluid rounded">
                <?php endif; ?>
            </div>

            <!-- Contenido a la derecha -->
            <div class="col-lg-6">
                <?php if (!empty($title)) : ?>
                    <h2 class="header-2 text-white"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <!-- Beneficios -->
                <?php if (!empty($icons) && is_array($icons)) : ?>
                    <div class="row">
                        <div class="col-12">
                            <?php foreach ($icons as $icon) : ?>
                                <div class="benefit-card">
                                    <div class="d-flex align-items-start">
                                        <?php if (!empty($icon['image'])) : ?>
                                            <div class="benefit-icon">
                                                <?php
                                                if (is_string($icon['image'])) {
                                                    echo wp_kses_post($icon['image']);
                                                } elseif (is_array($icon['image'])) {
                                                    echo wp_get_attachment_image(
                                                        $icon['image']['id'] ?? '',
                                                        'full',
                                                        false,
                                                        ['class' => 'icon-image']
                                                    );
                                                }
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <?php if (!empty($icon['title'])) : ?>
                                                <h3 class="header-3"><?php echo esc_html($icon['title']); ?></h3>
                                            <?php endif; ?>
                                            <?php if (!empty($icon['description'])) : ?>
                                                <p class="parraf text-white"><?php echo wp_kses_post($icon['description']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sección inferior -->
        <?php if (!empty($description) || !empty($button)) : ?>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="container-cta text-center">
                        <?php
                        /* echo '<pre>';
                        print_r($button);
                        echo '</pre>'; */
                        ?>
                        <?php if (!empty($description)) : ?>
                            <p class="parraf text-white"><?php echo wp_kses_post($description); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($button)) : ?>
                            <a href="<?php echo esc_url($button['cta']['url'] ?? '#'); ?>"
                                class="btn btn-primary-cta bg-white"
                                <?php echo !empty($button['cta']['target']) ? 'target="' . esc_attr($button['cta']['target']) . '"' : ''; ?>>
                                <?php echo esc_html($button['cta']['text'] ?? 'Postula aquí'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>