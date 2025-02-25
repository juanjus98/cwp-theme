<?php

/**
 * Template part page header
 *
 * @package BasherTheme
 */

$content = get_the_content();
?>
<section class="sec-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <?php
                if (!has_h1_in_content($content)) : ?>
                    <?php the_title('<h1 class="header-1 text-white title-motion text-center">', '</h1>'); ?>
                <?php endif; ?>
                <?php if ($content) : ?>
                    <div class="content-description mx-auto">
                        <?php echo apply_filters('the_content', $content); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>