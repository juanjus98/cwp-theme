</main>
</div>
<footer class="footer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 order-2 order-sm-0 col-5 text-md-start text-end">
                <?php the_custom_logo(); ?>
            </div>
            <div class="col-lg-4 order-3 order-sm-0 col-sm-12">
                <?php Theme_Social_Customizer::render_social_icons(); ?>
                <p class="text-center text-white">Powered by <?php bloginfo('name'); ?> <?php echo date('Y'); ?></p>
            </div>
            <div class="col-lg-2 offset-lg-2 order-1 order-sm-0 col-7">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-3',
                    'container_class' => 'me-auto my-auto',
                    'menu_class' => 'navbar-nav navbar-menu navbar-menu-footer'
                ));
                ?>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>