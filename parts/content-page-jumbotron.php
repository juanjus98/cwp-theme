<?php
/**
 * Template part Jumbotron
 *
 * @package BasherTheme
 */

// Get jumbotron data
$jumbotron = get_jumbotron_data();

// Si no hay título, no mostramos nada
if (empty($jumbotron['title'])) {
    return;
}
?>
<section class="sec-jumbotron-page bg-white section-motion">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="header-2 text-black title-motion"><?php echo esc_html($jumbotron['title']); ?></h2>
                
                <?php if (!empty($jumbotron['subtitle'])) : ?>
                    <p class="parraf text-black"><?php echo esc_html($jumbotron['subtitle']); ?></p>
                <?php endif; ?>

                <?php if (!empty($jumbotron['cta']['text']) && !empty($jumbotron['cta']['url'])) : ?>
                    <a href="<?php echo esc_url($jumbotron['cta']['url']); ?>" 
                       class="btn btn-whatsapp"
                       <?php echo $jumbotron['cta']['target'] === '_blank' ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                        <?php echo esc_html($jumbotron['cta']['text']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- <section class="sec-jumbotron-page bg-white section-motion">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="header-2 text-black title-motion">Contáctanos</h2>
                <p class="parraf text-black">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.</p>
                <a href="#" class="btn btn-whatsapp">Contáctanos</a>
            </div>
        </div>
    </div>
</section> -->
