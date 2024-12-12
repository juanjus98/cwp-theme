<?php
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();

$desktop_image = get_field('hero_background_desktop'); // Ajusta el nombre del campo según lo hayas definido
$mobile_image = get_field('hero_background_mobile');
?>
<style>
    :root {
        --desktop-bg: url('<?php echo esc_url($desktop_image); ?>');
        --mobile-bg: url('<?php echo esc_url($mobile_image); ?>');
    }
</style>
<section class="hero bg-1">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="cont-hero">
                    <h1 class="header-1 text-white"><?php the_field('hero_title'); ?></h1>
                    <p><?php the_field('hero_description'); ?></p>
                    <?php
                    $cta_text = get_field('hero_cta_text');
                    $cta_url = get_field('hero_cta_url');
                    if ($cta_text && $cta_url) :
                    ?>
                        <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-primary-cta"><?php echo esc_html($cta_text); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
/* Clientes carousel */
get_template_part('parts/content', 'clientes-carousel');
?>
<!-- <section class="sec-clients-logos">
    <div class="slider">
        <div class="slide_track">
            <img src="https://basher.agency/wp-content/uploads/2024/01/1xbet.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/2bet.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/BetWinner.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Company-logo.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Betboom.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Betway.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Bitel.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Dafabet.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Ggbet.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/HyperX.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Mobile-Legends.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Pari-Match.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Pinnacle.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Rivalry.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Stake.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Tencent-Games.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Trovo.png" alt="" width="120" height="40">
        </div>
        <div class="slide_track">
            <img src="https://basher.agency/wp-content/uploads/2024/01/1xbet.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/2bet.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/BetWinner.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Company-logo.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Betboom.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Betway.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Bitel.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Dafabet.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Ggbet.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/HyperX.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Mobile-Legends.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Pari-Match.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Pinnacle.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Rivalry.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Stake.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Tencent-Games.png" alt="" width="120" height="40">
            <img src="https://basher.agency/wp-content/uploads/2024/01/Trovo.png" alt="" width="120" height="40">
        </div>
    </div>
</section> -->

<div id="site-main-content-<?php echo CST_PAGE_ID; ?>" class="site-main-content">
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