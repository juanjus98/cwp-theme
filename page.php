<?php
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php while (have_posts()) : the_post(); ?>

            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>

        <?php endwhile; // End of the loop. 
        ?>

    </main>
</div>
<?php get_footer(); ?>