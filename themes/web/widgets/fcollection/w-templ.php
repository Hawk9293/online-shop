<h3 class="like text-center"><?=$title; ?></h3>
<?php
$args = [
        'type_post' => 'product',
        'posts_per_page' => $pcount,

        'tax_query' => array(
                array(
                        'taxonomy' => 'product_visibility',
                        'field' => 'name',
                        'terms' => 'featured'
                )
        ),
        'orderby' => ['ID', 'DESC']

];
$featured_query = new WP_Query($args);
?>

<?php if($featured_query->have_posts()): ?>

    <ul id="flexiselDemo3">

    <?php
    while($featured_query->have_posts()):
        $featured_query->the_post();

        $id = get_the_ID();
        $link = get_the_permalink();
        $title = get_the_title();

        $img_attrs = [
                'class' => 'img-responsive',
                'alt' => trim(strip_tags($title)),
                'title' => trim(strip_tags($title))
        ];
        $img = get_the_post_thumbnail($id, 'shop_catalog', $img_attrs);

        global $product;
        $price_html = $product->get_price_html();
        $product_id = $product->id;
        $product_sku = $product->get_sku();
        $product_url = esc_url($product->add_to_cart_url());

//        $class = implode(' ',
//            array_filter())
    ?>

        <li>
            <a href="<?=$link;?>">
                <?=$img;?>
            </a>
            <div class="product liked-product simpleCart_shelfItem">
                <a class="like_name" href="<?=$link;?>"><?=$title;?></a>
                <p>
                    <a class="item_add"
                       data-quantity="1"
                       data-product-id="<?=$product_id; ?>"
                       data-product-sku="<?=$product_sku; ?>"
                       href="#">
                        <i></i> <span class=" item_price"><?=$price_html;?></span>
                    </a>
                </p>
            </div>
        </li>

    <?php
    endwhile;
    ?>

    </ul>
<?php endif; ?>

