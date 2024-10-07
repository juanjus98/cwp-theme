<?php
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();
?>

<div id="content-<?php echo CST_PAGE_ID; ?>" class="content-area">
    <main id="main" class="site-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            <?php endwhile;
        else : ?>
            <p><?php esc_html_e('No se encontraron publicaciones.', 'tu-tema'); ?></p>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>