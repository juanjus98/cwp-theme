<?php

/**
 * Template Name: Page Services
 * 
 * @package BasherTheme
 */
//Page ID
define("CST_PAGE_ID", get_the_ID());

get_header();

// Page header
get_template_part('parts/content', 'page-header');

// Page services
get_template_part('parts/content', 'page-services');

// Page cards
get_template_part('parts/content', 'page-cards');

// Page FAQs
get_template_part('parts/content', 'page-faqs');

// Form
get_template_part('parts/content', 'form');

// Footer
get_footer(); ?>