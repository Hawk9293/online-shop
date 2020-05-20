<?php
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'slider'
);
$slider = new WP_Query( $args );
?>

<?php if( $slider->have_posts() ): ?>
<div class="banner">
    <div class="container">
        <div class="banner-bottom">
            <div class="banner-bottom-left">
                <h2>B<br>U<br>Y</h2>
            </div>
            <div class="banner-bottom-right">
                <div  class="callbacks_container">
                    <ul class="rslides" id="slider4">
                        <?php while ( $slider->have_posts() ): $slider->the_post();?>
                        <li>
                            <div class="banner-info">
                                <h3><?php the_title(); ?></h3>
                                <p><?php the_content(); ?></p>
                            </div>
                        </li>
                        <?php endwhile; wp_reset_postdata();?>
                    </ul>
                </div>
                <!--banner-->
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="shop">
            <a href="<?= esc_attr( get_option('slider_url') )  ?>"><?= esc_attr( get_option('slider_button') )  ?></a>
        </div>
    </div>
</div>
<?php endif; ?>