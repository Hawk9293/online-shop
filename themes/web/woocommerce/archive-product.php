<?php defined('ABSPATH') || exit;

get_header();
get_template_part('templates/hero','block');
get_template_part('templates/main','menu');
get_template_part('templates/latest','products');
get_template_part('templates/shop', 'widgets');
get_sidebar('content-bottom');
get_footer();
