<?php
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>

<?php endwhile; // End of the loop. 
?>

<?php get_footer(); ?>