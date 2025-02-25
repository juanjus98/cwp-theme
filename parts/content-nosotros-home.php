<?php

/**
 * Template part para nosotros home
 *
 * @package BasherTheme
 */

$slider1_config = get_section_config('slider1');
if ($slider1_config['active'] === 'active') {
    $section_title = '<h2 class="header-2 text-white title-motion"><span class="text-line-1">' . $slider1_config['title'] . '</span><span class=" clearfix"></span> ' . $slider1_config['subtitle'] . '</h2>';
    $section_desc = (!empty($slider1_config['description'])) ? '<p class="parraf-1 text-white">' . $slider1_config['description'] . '</p>' : '';
    $featured_sliders = get_featured_sliders('slider-nosotros', 9);
?>
    <section class="sec-aboutus section-motion">
        <div class="container">
            <div class="row">
                <div class=" col-lg-12">
                    <div class="cont-desc">
                        <!-- <h2 class="header-2 text-white title-motion"><span class="text-line-1">Sobre</span><span class="clearfix"></span> Nosotros</h2>
                    <p class="parraf-1 text-white">Somos tu socio estratégico en el universo del gaming, igaming, esports & sports.</p> -->
                        <?php echo $section_title; ?>
                        <?php echo $section_desc; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($featured_sliders)) : ?>
            <div class="swiper-container">
                <div class="swiper swiper-aboutus">
                    <div class="swiper-wrapper">
                        <?php foreach ($featured_sliders as $slider) : ?>
                            <div class="swiper-slide">
                                <?php if ($slider['type'] === 'text') : ?>
                                    <div class="custom-box is-text">
                                        <p class="text-white text-parraf">
                                            <?php echo esc_html($slider['description']); ?>
                                        </p>
                                    </div>
                                <?php else : ?>
                                    <div class="custom-box is-image">
                                        <?php if ($slider['image']) : ?>
                                            <img src="<?php echo esc_url($slider['image']); ?>" class="image" alt="<?php echo esc_attr($slider['title']); ?>">
                                        <?php endif; ?>
                                        <p class="text-white text-caption">
                                            <?php echo esc_html($slider['title']); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-button-prev swiper-button-prev-aboutus"></div>
                <div class="swiper-button-next swiper-button-next-aboutus"></div>
            </div>
        <?php endif; ?>
    </section>
<?php } ?>