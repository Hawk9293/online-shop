<?php defined('ABSPATH' ) || exit;?>

<div class="footer">
    <div class="container">
        <div class="footer_top">
            <div class="span_of_4">
                <?php dynamic_sidebar('footer_menu'); ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="cards text-center">
            <img src="<?php echo ASSETS_PATH . 'images' ?>/cards.jpg" alt="" />
        </div>
        <div class="copyright text-center">
            <p>© 2015 Eshop. All Rights Reserved | Design by   <a href="http://w3layouts.com">  W3layouts</a></p>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>