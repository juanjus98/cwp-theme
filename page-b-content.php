<?php

/**
 * Template Name: Page B-Content
 * 
 * @package BasherTheme
 */
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();

// Hero
get_template_part('parts/content', 'hero-home');

// Section logos
get_template_part('parts/content', 'page-logos');

// Page cards
get_template_part('parts/content', 'page-cards');

// Page clients
get_template_part('parts/content', 'page-clientes');

// Page Jumbotron
get_template_part('parts/content', 'page-jumbotron');

// Footer
get_footer(); ?>