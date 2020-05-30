<?php defined('ABSPATH' ) || exit;?>

<?php do_action('woocommerce_before_main_content'); ?>
<div class="online-strip">
    <div class="col-md-4 follow-us">
        <h3>follow us : <a class="twitter" href="#"></a><a class="facebook" href="#"></a></h3>
    </div>
    <div class="col-md-4 shipping-grid">
        <div class="shipping">
            <img src="<?php echo ASSETS_PATH . 'images' ?>/shipping.png" alt="" />
        </div>
        <div class="shipping-text">
            <h3>Free Shipping</h3>
            <p>on orders over $ 199</p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-md-4 online-order">
        <p>Order online</p>
        <h3>Tel:999 4567 8902</h3>
    </div>
    <div class="clearfix"></div>
</div>


<?php
$args = [
    'post_type' => 'products',
    'post_per_page' => '9'
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

        <?php wc_get_template_part(); ?>

    <?php
    endwhile;
    ?>

    <?php woocommerce_product_loop_end(); ?>
<?php endif; ?>


<?php do_action(woocommerce_after_main_content); ?>