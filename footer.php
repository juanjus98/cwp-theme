<footer>
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
        <?php wp_nav_menu( array( 'theme_location' => 'footer_menu' ) ); ?>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>