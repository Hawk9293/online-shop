<?php defined('ABSPATH' ) || exit;?>

<div class="banner-top">
    <div class="container">
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="logo">
                    <h1><a href="index.php"><span>E</span> -Shop</a></h1>
                </div>
            </div>
            <!--/.navbar-header-->
            <?php
            wp_nav_menu([
                'theme_location'  => 'header_menu',
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse',
                'container_id' => 'bs-example-navbar-collapse-1',
                'menu_class' => 'nav navbar-nav',
                'walker' => new Walker_Naw_Menu,
            ]);
            ?>
        </nav>
        <!--/.navbar-->
    </div>
</div>