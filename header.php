<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="page-<?php echo CST_PAGE_ID; ?>">
    <header class="header <?php echo "header-" . CST_PAGE_ID; ?>">
        <nav class="navbar navbar-expand-lg fixed-top navbar-fixed-top">
            <div class="container">
                <div class="site-branding ms-auto">
                    <?php the_custom_logo(); ?>
                    <?php echo get_mobile_logo(); ?>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu1" aria-controls="navbarMenu1" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMenu1">
                    <?php
                        if (function_exists('cwp_theme_menu')) {
                            cwp_theme_menu();
                        }
                    ?>
                    <?php
                        wp_nav_menu(array(
                        'theme_location' => 'cta-menu',
                        'container' => false,
                        'menu_class' => 'navbar-nav navbar-cta-menu ms-lg-4'
                        ));
                    ?>
                </div>
            </div>
        </nav>
    </header>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">