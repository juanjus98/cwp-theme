<?php

/**
 * Template Name: Page Contact Us
 * 
 * @package BasherTheme
 */
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();

// Page header
get_template_part('parts/content', 'page-header');

/* Formulario */
get_template_part('parts/content', 'form-page');

// Footer
get_footer(); ?>