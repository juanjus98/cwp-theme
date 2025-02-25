<?php

/**
 * Template for single service posts
 *
 * @package BasherTheme
 */

//Page ID
define("CST_PAGE_ID", get_the_ID());
get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <article class="single-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="content-main">
                        <?php
                        // Verificar si hay contenido
                        $content = get_the_content();
                        if (!empty($content)) {
                            the_content();
                        } else {
                            // Mostrar título y mensaje si no hay contenido
                            echo '<h1>' . get_the_title() . '</h1>';
                            echo '<p>No se ha encontrado contenido.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>