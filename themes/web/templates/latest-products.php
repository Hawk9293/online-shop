<?php defined('ABSPATH' ) || exit;?>

<?php do_action('woocommerce_before_main_content'); ?>

<?php
$args = [
    'post_type' => 'product',
    'posts_per_page' => '9'
];

global $wp_query;
$wp_query = new WP_Query($args);
?>

<?php
if ($wp_query->have_posts()):
?>
    <?php woocommerce_product_loop_start(); ?>

    <?php
    while ($wp_query->have_posts()):
        $wp_query->the_post();
    ?>

        <?php wc_get_template_part( 'content','product' ); ?>

    <?php
    endwhile;
    ?>

    <?php woocommerce_product_loop_end(); ?>
<?php endif; ?>

<?php do_action('woocommerce_after_main_content'); ?>