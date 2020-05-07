<?php
define( 'ASSETS_PATH', get_template_directory_uri() . '/assets/' );

//////////////////////////// подключаем скрипты и стили ////////////////////////////
add_action( 'wp_enqueue_scripts', 'add_styles' );
function add_styles(){
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'bootstrap', ASSETS_PATH . 'css/bootstrap.css', array( 'style' ), '1.0', true );
    wp_enqueue_style( 'component', ASSETS_PATH . 'css/component.css', array( 'style' ), '1.0', true );
    wp_enqueue_style( 'flexslider', ASSETS_PATH . 'css/flexslider.css', array( 'style' ), '1.0', true );
    wp_enqueue_style( 'glyphicons-halflings-regular', ASSETS_PATH . 'fonts/glyphicons-halflings-regular.ttf', array( 'style' ), '1.0', true );
    wp_enqueue_style( 'Lato-Regular', ASSETS_PATH . 'fonts/Lato-Regular.ttf' );
    wp_enqueue_style( 'PlayfairDisplay-Regular', ASSETS_PATH . 'fonts/PlayfairDisplay-Regular.ttf' );
};

add_action( 'wp_enqueue_scripts', 'add_scripts' );
function add_scripts(){
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'main', ASSETS_PATH . 'js/main.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'bootstrap-3.1.1.min', ASSETS_PATH . 'js/bootstrap-3.1.1.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'cbpViewModeSwitch', ASSETS_PATH . 'js/cbpViewModeSwitch.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'classie', ASSETS_PATH . 'js/classie.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'imagezoom', ASSETS_PATH . 'js/imagezoom.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'jquery.flexisel', ASSETS_PATH . 'js/jquery.flexisel.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'jquery.flexslider', ASSETS_PATH . 'js/jquery.flexslider.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'responsiveslides.min', ASSETS_PATH . 'js/responsiveslides.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'responsive-tabs.min', ASSETS_PATH . 'js/responsive-tabs.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'simpleCart.min.min', ASSETS_PATH . 'js/simpleCart.min.js', array( 'jquery' ), '1.0', true );
};

//////////////////////////// my functions ////////////////////////////

function my_print( $value, $color = 'white', $end = 0 ) {
    echo "<pre style='background:" . $color. "';>";
    print_r($value);
    echo "</pre>";
    if ( $end ) die();
}
