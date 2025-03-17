<?php

/**
 * Template part page services
 *
 * @package BasherTheme
 */
//Logos data
$logos_data = get_logos_data();
/* echo '<pre>';
print_r($logos_data);
echo '</pre>'; */

?>
<?php if (!empty($logos_data['logos'])) : ?>
    <!-- Logos section -->
    <section class="sec-logos-page">
        <div class="container">
            <?php if (!empty($logos_data['title'])) : ?>
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="content-description text-center">
                            <h2 class="header-3 text-white title-motion">
                                <?php echo esc_html($logos_data['title']); ?>
                            </h2>
                            <?php if (!empty($logos_data['description'])) : ?>
                                <p class="parraf text-white">
                                    <?php echo esc_html($logos_data['description']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12">
                    <?php if (!empty($logos_data['logos'])) : ?>
                        <div class="d-flex justify-content-center flex-wrap content-logos">
                            <!-- <div class="swiper swiper-cards-page">
                                <div class="swiper-wrapper"> -->
                                    <?php foreach ($logos_data['logos'] as $logos) : ?>
                                        <!-- <div class="swiper-slide"> -->
                                            <div class="custom-logo">
                                                <?php if (!empty($logos['image']['url'])) : ?>
                                                    <img
                                                        src="<?php echo esc_url($logos['image']['url']); ?>"
                                                        class="logo-img"
                                                        alt="<?php echo esc_attr($logos['image']['alt']); ?>">
                                                <?php endif; ?>
                                            </div>
                                        <!-- </div> -->
                                    <?php endforeach; ?>
                                <!-- </div>
                            </div> -->
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>
<?php endif; ?>