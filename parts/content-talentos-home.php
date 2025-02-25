<?php

/**
 * Template part para talentos home
 *
 * @package BasherTheme
 */
$talents_config = get_section_config('talents');
if ($talents_config['active'] === 'active') {
    $section_title = '<h2 class="header-2 text-white title-motion"><span class="text-line-1">' . $talents_config['title'] . '</span><span class=" clearfix"></span> ' . $talents_config['subtitle'] . '</h2>';
    $section_desc = (!empty($talents_config['description'])) ? '<p class="text-white">' . $talents_config['description'] . '</p>' : '';
    $featured_talents = get_featured_talents(8);
?>
    <section class="sec-talents section-motion">
        <div class="container">
            <div class="row">
                <div class=" col-lg-12">
                    <div class="cont-desc">
                         <?php echo $section_title; ?>
                        <?php echo $section_desc; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php if (!empty($featured_talents)) : ?>
                        <div class="swiper-container">
                            <div class="swiper swiper-talentos">
                                <div class="swiper-wrapper">
                                    <?php foreach ($featured_talents as $talent) : ?>
                                        <div class="swiper-slide">
                                            <a href="<?php echo esc_url($talent['url']); ?>" class="card custom-card-1">
                                                <img src="<?php echo esc_url($talent['image']); ?>" class="card-img" alt="<?php echo esc_attr($talent['title']); ?>">
                                                <div class="card-body">
                                                    <h3 class="card-text text-white text-center"><?php echo esc_html($talent['title']); ?></h3>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="swiper-button-prev swiper-button-prev-talentos"></div>
                            <div class="swiper-button-next swiper-button-next-talentos"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>