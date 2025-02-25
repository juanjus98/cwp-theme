<?php
/**
 * Template part for displaying client logos
 *
 * @package BasherTheme
 * @version 1.0.0
 */

$featured_clients = get_featured_clients(16);

if (!empty($featured_clients)) : ?>
    <section 
        class="sec-clients-logos section-motion" 
        aria-label="<?php echo esc_attr__('Featured Clients', 'BasherTheme'); ?>"
    >
        <div class="slider">
            <div class="slide_track">
                <?php foreach ($featured_clients as $index => $client) : ?>
                    <img 
                        src="<?php echo esc_url($client['image']); ?>" 
                        alt="<?php echo esc_attr(sprintf(__('%s logo', 'BasherTheme'), $client['title'])); ?>"
                        class="client-logo"
                        loading="<?php echo $index < 4 ? 'eager' : 'lazy'; ?>"
                    />
                <?php endforeach; ?>
            </div>
            <div class="slide_track">
                <?php foreach ($featured_clients as $index => $client) : ?>
                    <img 
                        src="<?php echo esc_url($client['image']); ?>" 
                        alt="<?php echo esc_attr(sprintf(__('%s logo', 'BasherTheme'), $client['title'])); ?>"
                        class="client-logo"
                        loading="lazy"
                    />
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>