<?php
/**
* Template Name: Archive Service
* 
* @package BasherTheme
*/
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();

// Consulta servicios en el idioma actual
$args = array(
   'post_type' => 'service',
   'posts_per_page' => -1,
   'orderby' => array(
       'menu_order' => 'ASC',
       'date' => 'DESC'
   )
);

if(function_exists('pll_current_language')) {
   $args['lang'] = pll_current_language();
}

$services_query = new WP_Query($args);
?>

<main class="main-content">
   <section class="services-archive section-motion">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="cont-desc">
                       <h1 class="header-1 text-white title-motion">
                           <?php echo is_admin() ? 'Servicios' : 'Services'; ?>
                       </h1>
                   </div>
               </div>
           </div>

           <?php if ($services_query->have_posts()) : ?>
               <div class="row services-grid">
                   <?php while ($services_query->have_posts()) : $services_query->the_post(); ?>
                       <div class="col-md-6 col-lg-4">
                           <article class="service-card">
                               <a href="<?php the_permalink(); ?>" class="card custom-card-1">
                                   <?php if (carbon_get_post_meta(get_the_ID(), 'service_card_image')) : ?>
                                       <img 
                                           src="<?php echo esc_url(wp_get_attachment_image_url(carbon_get_post_meta(get_the_ID(), 'service_card_image'), 'full')); ?>" 
                                           alt="<?php echo esc_attr(carbon_get_post_meta(get_the_ID(), 'service_card_title')); ?>"
                                           class="card-img"
                                       >
                                   <?php endif; ?>
                                   <div class="card-body">
                                       <p class="card-text text-white text-center">
                                           <?php echo esc_html(carbon_get_post_meta(get_the_ID(), 'service_card_title')); ?>
                                       </p>
                                   </div>
                               </a>
                           </article>
                       </div>
                   <?php endwhile; ?>
               </div>

               <?php wp_reset_postdata(); ?>

           <?php else : ?>
               <div class="row">
                   <div class="col-12">
                       <p class="text-white">
                           <?php echo is_admin() ? 'No se encontraron servicios.' : 'No services found.'; ?>
                       </p>
                   </div>
               </div>
           <?php endif; ?>
       </div>
   </section>
</main>

<?php get_footer(); ?>