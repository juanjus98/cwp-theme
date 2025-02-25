<?php

/**
 * Template part client logos
 *
 * @package BasherTheme
 */

$featured_clients = get_featured_clients(16);

// Get icons section data
$icons_data = get_icons_section_data();
$sec_title = (!empty($icons_data['info']['title'])) ? $icons_data['info']['title'] : 'Configure title';
$sec_description = (!empty($icons_data['info']['description'])) ? $icons_data['info']['description'] : '';

if (!empty($featured_clients)) : ?>
    <section class="sec-clients-page section-motion">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-description text-center">
                        <h2 class="header-2 text-white title-motion">
                            <?php echo esc_html($sec_title); ?>
                        </h2>
                        <?php if (!empty($sec_description)) : ?>
                            <p class="parraf text-white">
                                <?php echo esc_html($sec_description); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="content-clients">
                        <?php foreach ($featured_clients as $client) : ?>
                            <div class="logo-client">
                                <img class="logo-img" src="<?php echo esc_url($client['image']); ?>" alt="<?php echo esc_attr($client['title']); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>