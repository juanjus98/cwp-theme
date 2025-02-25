<?php

/**
 * Template part page services
 *
 * @package BasherTheme
 */
// Consulta servicios en el idioma actual
$args = array(
    'post_type' => 'service',
    'posts_per_page' => -1,
    'orderby' => array(
        'menu_order' => 'ASC',
        'date' => 'DESC'
    )
);

if (function_exists('pll_current_language')) {
    $args['lang'] = pll_current_language();
}

$services_query = new WP_Query($args);
?>
<section class="sec-services-page">
    <div class="container">
        <?php if ($services_query->have_posts()) : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="swiper-container">
                        <div class="swiper swiper-services-page">
                            <div class="swiper-wrapper">
                                <?php while ($services_query->have_posts()) : $services_query->the_post(); ?>
                                    <div class="swiper-slide">
                                        <a href="<?php the_permalink(); ?>" class="card custom-card-1">
                                            <img src="<?php echo esc_url(wp_get_attachment_image_url(carbon_get_post_meta(get_the_ID(), 'service_card_image'), 'full')); ?>" class="card-img" alt="<?php echo esc_attr(carbon_get_post_meta(get_the_ID(), 'service_card_title')); ?>">
                                            <div class="card-body">
                                                <p class="card-text text-white text-center"><?php echo esc_html(carbon_get_post_meta(get_the_ID(), 'service_card_title')); ?></p>
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <!-- navigation buttons -->
                        <div class="swiper-button-prev swiper-button-prev-services-page"></div>
                        <div class="swiper-button-next swiper-button-next-services-page"></div>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="row">
                <div class="col-12">
                    <p class="text-white">
                        <?php
                        echo function_exists('pll_current_language') && pll_current_language() === 'es'
                            ? 'No se encontraron servicios.'
                            : 'No services found.';
                        ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>