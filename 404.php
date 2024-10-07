<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'tu-tema'); ?></h1>
            </header>
            <div class="page-content">
                <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tu-tema'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </section>
    </main>
</div><?php get_footer(); ?>