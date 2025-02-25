<?php
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();

// Hero
get_template_part('parts/content', 'hero-home');

/* Logos clientes carousel */
get_template_part('parts/content', 'clientes-carousel');

/* Servicios swiper */
get_template_part('parts/content', 'servicios-swiper');

/* Talentos */
get_template_part('parts/content', 'talentos-home');

/* Sobre Nosotros */
get_template_part('parts/content', 'nosotros-home');

/* Eligieron */
get_template_part('parts/content', 'eligieron-swiper');

/* Formulario */
get_template_part('parts/content', 'form');

//Footer
get_footer();
