<?php
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();
?>
<section class="hero bg-1">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="cont-hero text-center">
                    <h1 class="header-1 text-white"><?php the_field('hero_title'); ?></h1>
                    <p><?php the_field('hero_description'); ?></p>
                    <?php
                    $cta_text = get_field('hero_cta_text');
                    $cta_url = get_field('hero_cta_url');
                    if ($cta_text && $cta_url) :
                    ?>
                        <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-cta"><?php echo esc_html($cta_text); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="container-<?php echo CST_PAGE_ID; ?>" class="container">
    Página home
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>
        <?php endwhile;
    else : ?>
        <p><?php esc_html_e('No se encontraron publicaciones.', 'tu-tema'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>