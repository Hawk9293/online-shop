<?php defined('ABSPATH') || exit;

get_header();
get_template_part('templates/main','menu');

//вывод хлебных крошек
do_action('woocommerce_before_main_content');

get_template_part('templates/subscribe');
get_footer();
