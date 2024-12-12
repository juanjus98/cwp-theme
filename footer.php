</main>
</div>
<footer class="footer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <?php the_custom_logo(); ?>
            </div>
            <div class="col-lg-4">
                <?php Theme_Social_Customizer::render_social_icons(); ?>
                <p class="text-center text-white">Powered by <?php bloginfo('name'); ?> <?php echo date('Y'); ?></p>
            </div>
            <div class="col-lg-2 offset-lg-2">
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