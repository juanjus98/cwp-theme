<?php

/**
 * Template part para eligieron swiper
 *
 * @package BasherTheme
 */
$slider2_config = get_section_config('slider2');
if ($slider2_config['active'] === 'active') {
    $section_title = '<h2 class="header-2 text-white title-motion"><span class="text-line-1">' . $slider2_config['title'] . '</span><span class=" clearfix"></span> ' . $slider2_config['subtitle'] . '</h2>';
    $section_desc = (!empty($slider2_config['description'])) ? '<p class="text-white">' . $slider2_config['description'] . '</p>' : '';

    $featured_sliders = get_featured_sliders('slider-eligieron', 9);
?>
    <section class="sec-eligieron section-motion">
        <div class="container">
            <div class="row">
                <div class=" col-lg-12">
                    <div class="cont-desc">
                        <!-- <h2 class="header-2 text-white title-motion"><span class="text-line-1">Eligieron</span><span class="clearfix"></span> Basher</h2> -->
                        <?php echo $section_title; ?>
                        <?php echo $section_desc; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($featured_sliders)) : ?>
            <div class="swiper-container">
                <div class="swiper swiper-eligieron">
                    <div class="swiper-wrapper">
                        <?php foreach ($featured_sliders as $slider) : ?>
                            <div class="swiper-slide">
                                <div class="slide-content">
                                    <div class="slide-text">
                                        <p class="parraf-2 text-white">
                                            <?php echo esc_html($slider['description']); ?>
                                        </p>
                                    </div>
                                    <?php if ($slider['logo']) : ?>
                                        <div class="cont-logo">
                                            <img src="<?php echo esc_url($slider['logo']); ?>" alt="<?php echo esc_attr($slider['title']); ?>" title="<?php echo esc_attr($slider['title']); ?>" class="img-logo">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="swiper-button-prev swiper-button-prev-eligieron"></div>
                <div class="swiper-button-next swiper-button-next-eligieron"></div>
            </div>
        <?php endif; ?>
    </section>
<?php } ?>