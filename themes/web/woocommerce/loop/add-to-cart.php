<?php defined('ABSPATH' ) || exit;?>
<?php
global $product;

if ( $price_html = $product->get_price_html() ) {
    $price_template =
        '<p>
            <a
                href="%s"
                data-quantity="%s"
                data-product_id="%s"
                data-product_sku="%s"
                class="item_add %s"
            >
                <i></i>
                <span class="item_price">%s</span>
            </a>
        </p>';

    echo apply_filters(
        'woocommerce_loop_add_to_cart_link',
        sprintf(
            $price_template,
            esc_url($product->add_to_cart_url()),
            esc_attr(isset($quantity) ? $quantity : 1),
            esc_attr($product->id),
            esc_attr($product->get_sku()),
            esc_attr(isset($class) ? $class : 'button'),
            $price_html
        )
    );
}
?>
