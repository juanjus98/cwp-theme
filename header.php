<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if (is_singular() && pings_open(get_queried_object())): ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>

    <!-- Preload font for better performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php wp_head(); ?>

    <!-- Metadata SEO por defecto -->
    <?php if (is_home() || is_front_page()): ?>
        <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php endif; ?>

    <!-- Open Graph -->
    <meta property="og:locale" content="<?php echo get_locale(); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">

    <?php if (has_post_thumbnail()): ?>
        <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>">
    <?php endif; ?>
</head>

<body <?php body_class(); ?> id="page-<?php echo esc_attr(CST_PAGE_ID); ?>">
    <?php wp_body_open(); ?>

    <!-- Skip to content link for accessibility -->
    <a class="skip-link screen-reader-text" href="#main">
        <?php esc_html_e('Skip to content', 'BasherTheme'); ?>
    </a>

    <header class="header <?php echo esc_attr("header-" . CST_PAGE_ID); ?>" role="banner">
        <nav class="navbar navbar-expand-lg fixed-top navbar-fixed-top" id="navbarPrimary" aria-label="<?php esc_attr_e('Main Navigation', 'BasherTheme'); ?>">
            <div class="container">
                <!-- Mobile Navigation -->
                <div class="navbar-mb d-flex justify-content-between align-items-center d-block d-md-none">
                    <!-- Language Switcher -->
                    <?php if (function_exists('get_language_switcher')): ?>
                            <div class="my-auto language-selector" role="navigation" aria-label="<?php esc_attr_e('Language Switcher', 'BasherTheme'); ?>">
                                <?php echo get_language_switcher(); ?>
                            </div>
                        <?php endif; ?>

                    <?php echo get_custom_logo_with_link(); ?>

                    <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarMenu1"
                        aria-controls="navbarMenu1"
                        aria-expanded="false"
                        aria-label="<?php esc_attr_e('Toggle Navigation', 'BasherTheme'); ?>">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <!-- Main Navigation Menu -->
                <div class="collapse navbar-collapse" id="navbarMenu1">
                    <div class="d-flex justify-content-center flex-column flex-md-row w-100">
                        <!-- Left Menu -->
                        <?php
                        $menu_args_l = array(
                            'theme_location'  => 'menu-1',
                            'container_class' => 'me-0 me-md-auto my-auto',
                            'menu_class'      => 'navbar-nav navbar-menu',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
                            'fallback_cb'     => false,
                            'lang'            => function_exists('pll_current_language') ? pll_current_language() : null
                        );
                        wp_nav_menu($menu_args_l);
                        ?>

                        <!-- Logo for Desktop -->
                        <div class="site-branding mx-auto d-none d-md-block">
                            <?php echo get_custom_logo_with_link(); ?>
                        </div>

                        <!-- Right Menu -->
                        <?php
                        $menu_args_r = array(
                            'theme_location'  => 'menu-2',
                            'container_class' => 'my-auto',
                            'menu_class'      => 'navbar-nav navbar-menu',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
                            'fallback_cb'     => false,
                            'lang'            => function_exists('pll_current_language') ? pll_current_language() : null
                        );
                        wp_nav_menu($menu_args_r);
                        ?>

                        <!-- Language Switcher -->
                        <?php if (function_exists('get_language_switcher')): ?>
                            <div class="my-auto language-selector d-none d-md-block" role="navigation" aria-label="<?php esc_attr_e('Language Switcher', 'BasherTheme'); ?>">
                                <?php echo get_language_switcher(); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Social Icons for Mobile -->
                        <div class="d-block d-md-none">
                            <div role="complementary" aria-label="<?php esc_attr_e('Social Media Links', 'BasherTheme'); ?>">
                                <?php Theme_Social_Customizer::render_social_icons(); ?>
                            </div>
                            <p class="text-center text-white">
                                <?php
                                printf(
                                    esc_html__('Powered by %1$s %2$s', 'BasherTheme'),
                                    esc_html(get_bloginfo('name')),
                                    esc_html(date('Y'))
                                );
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div id="primary" class="content-area" role="main">
        <main id="main" class="site-main">