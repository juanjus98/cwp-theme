<?php
/**
 * Template part para Hero home
 *
 * @package BasherTheme
 * @version 1.0.0
 */

// Obtener datos de manera organizada
$desktop_image = wp_get_attachment_image_url(carbon_get_post_meta(get_the_ID(), 'hero_image_des'), 'full');
$mobile_image = wp_get_attachment_image_url(carbon_get_post_meta(get_the_ID(), 'hero_image_rsp'), 'full');
$hero_title = carbon_get_post_meta(get_the_ID(), 'hero_title');
$hero_subtitle = carbon_get_post_meta(get_the_ID(), 'hero_subtitle');
$cta_text = carbon_get_post_meta(get_the_ID(), 'hero_cta_text');
$cta_url = carbon_get_post_meta(get_the_ID(), 'hero_cta_url');
$cta_target = carbon_get_post_meta(get_the_ID(), 'hero_cta_target');
?>
<style>
    :root {
        --desktop-bg: url('<?php echo esc_url($desktop_image); ?>');
        --mobile-bg: url('<?php echo esc_url($mobile_image); ?>');
    }
</style>
<section 
    class="hero bg-1" 
    role="banner" 
    aria-label="<?php echo esc_attr__('Main Hero Section', 'BasherTheme'); ?>"
>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="cont-hero">
                    <h1 class="header-1 text-white title-motion">
                        <?php echo wp_kses($hero_title, ['br' => [], 'strong' => [], 'em' => []]); ?>
                    </h1>
                    
                    <?php if (!empty(trim($hero_subtitle))): ?>
                        <p class="hero-subtitle">
                            <?php echo wp_kses($hero_subtitle, ['br' => [], 'strong' => [], 'em' => []]); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if ($cta_text && $cta_url) : ?>
                        <a href="<?php echo esc_url($cta_url); ?>"
                            class="btn btn-primary-cta"
                            target="<?php echo esc_attr($cta_target); ?>"
                            <?php echo $cta_target === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>
                            aria-label="<?php echo esc_attr(sprintf(__('%s - Call to Action', 'BasherTheme'), $cta_text)); ?>"
                        >
                            <?php echo esc_html($cta_text); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>