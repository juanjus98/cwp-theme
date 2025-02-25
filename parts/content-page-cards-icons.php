<?php

/**
 * Template part card icons
 *
 * @package BasherTheme
 */
//Services data
$services_data = get_services_cards_data();
?>
<?php if (!empty($services_data['cards'])) : ?>
    <!-- Cards section -->
    <section class="sec-cards sec-cards-icons">
        <div class="container">
            <?php if (!empty($services_data['title'])) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="content-description text-center">
                            <h2 class="header-2 text-white title-motion">
                                <?php echo esc_html($services_data['title']); ?>
                            </h2>
                            <?php if (!empty($services_data['description'])) : ?>
                                <p class="parraf text-white">
                                    <?php echo esc_html($services_data['description']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12">
                    <?php if (!empty($services_data['cards'])) : ?>
                        <div class="swiper-container">
                            <div class="swiper swiper-cards-page">
                                <div class="swiper-wrapper">
                                    <?php foreach ($services_data['cards'] as $card) : ?>
                                        <div class="swiper-slide">
                                            <div class="card custom-card-1">
                                                <?php if (!empty($card['image']['url'])) : ?>
                                                    <img
                                                        src="<?php echo esc_url($card['image']['url']); ?>"
                                                        class="card-img"
                                                        alt="<?php echo esc_attr($card['image']['alt']); ?>">
                                                <?php endif; ?>
                                                <div class="card-body">
                                                    <h3 class="card-text text-white text-center">
                                                        <?php echo esc_html($card['title']); ?>
                                                    </h3>
                                                    <?php if (!empty($card['description'])) : ?>
                                                        <p class="parraf text-white text-center">
                                                            <?php echo esc_html($card['description']); ?>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="swiper-button-prev swiper-button-prev-cards-page"></div>
                            <div class="swiper-button-next swiper-button-next-cards-page"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>
<?php endif; ?>