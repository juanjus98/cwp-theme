<?php

/**
 * Template Name: Page Work us
 * 
 * @package BasherTheme
 */
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();

// Page header
get_template_part('parts/content', 'page-header');

// Page cards
get_template_part('parts/content', 'page-cards-icons');

// Page Benefits
get_template_part('parts/content', 'page-benefits');

// Footer
get_footer(); ?>