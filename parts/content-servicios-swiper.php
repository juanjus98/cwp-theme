<?php
/**
 * Template part para servicios swiper
 *
 * @package BasherTheme
 * @version 1.0.0
 */

$services_config = get_section_config('services');
if ($services_config['active'] === 'active') {
    // Preparar el contenido de manera segura
    $section_title = sprintf(
        '<h2 class="header-2 text-white title-motion"><span class="text-line-1">%s</span><span class="clearfix"></span> %s</h2>',
        wp_kses($services_config['title'], ['br' => [], 'strong' => [], 'em' => []]),
        wp_kses($services_config['subtitle'], ['br' => [], 'strong' => [], 'em' => []])
    );
    
    $section_desc = !empty($services_config['description']) 
        ? sprintf('<p class="text-white">%s</p>', wp_kses($services_config['description'], ['br' => [], 'strong' => [], 'em' => []]))
        : '';

    $featured_services = get_featured_services(9);
?>
    <section 
        class="sec-services section-motion" 
        aria-label="<?php echo esc_attr__('Our Services', 'BasherTheme'); ?>"
    >
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="cont-desc">
                        <?php 
                        echo $section_title;
                        echo $section_desc; 
                        ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php if (!empty($featured_services)) : ?>
                        <div class="swiper-container" 
                             role="region" 
                             aria-label="<?php echo esc_attr__('Services Carousel', 'BasherTheme'); ?>"
                        >
                            <div class="swiper swiper-services">
                                <div class="swiper-wrapper">
                                    <?php foreach ($featured_services as $index => $service) : ?>
                                        <div class="swiper-slide">
                                            <a href="<?php echo esc_url($service['url']); ?>" 
                                               class="card custom-card-1"
                                               aria-label="<?php echo esc_attr(sprintf(__('Learn more about %s', 'BasherTheme'), $service['title'])); ?>"
                                            >
                                                <img src="<?php echo esc_url($service['image']); ?>" 
                                                     class="card-img" 
                                                     alt="<?php echo esc_attr(sprintf(__('%s service illustration', 'BasherTheme'), $service['title'])); ?>"
                                                     loading="<?php echo $index < 3 ? 'eager' : 'lazy'; ?>"
                                                />
                                                <div class="card-body">
                                                    <p class="card-text text-white text-center">
                                                        <?php echo esc_html($service['title']); ?>
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <button class="swiper-button-prev swiper-button-prev-services" 
                                    aria-label="<?php esc_attr_e('Previous slide', 'BasherTheme'); ?>">
                            </button>
                            <button class="swiper-button-next swiper-button-next-services" 
                                    aria-label="<?php esc_attr_e('Next slide', 'BasherTheme'); ?>">
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>