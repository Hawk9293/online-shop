<?php
//////////////////////////// Переменные ////////////////////////////
define( 'ASSETS_PATH', get_template_directory_uri() . '/assets/' );
//////////////////////////// Вкл поддержку woocommerce в нашей теме ////////////////////////////
add_theme_support('woocommerce');
//////////////////////////// Отключаем стили woocommerce ////////////////////////////
add_filter('woocommerce_enqueue_styles', '__return_empty_array');
//////////////////////////// Создаём настройки сайта ////////////////////////////
add_action('admin_menu','my_options');
function my_options(){
    add_settings_field('slider_url','Ссылка слайдера','display_url','general');
    register_setting('general','slider_url');

    add_settings_field('slider_button','Текст кнопки слайдера','display_button','general');
    register_setting('general','slider_button');

    function display_url(){
        echo '<input type="text", class="regular-text", name="slider_url", value="' . esc_attr( get_option('slider_url') ) . '">';
    };
    function display_button(){
        echo '<input type="text", class="regular-text", name="slider_button", value="' . esc_attr( get_option('slider_button') ) . '">';
    };
}
//////////////////////////// Создаём кастомные типы записи ////////////////////////////
add_action('init', 'hero_index');
function hero_index(){
    register_post_type('slider', array(
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_position' => 1,
        'menu_icon' => 'dashicons-format-gallery',
        'labels' => array(
            'name' => 'Слайдер',
            'all_item' => 'Все слайды',
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Новый слайд'
        )
    ));
};
//////////////////////////// Подключаем скрипты и стили ////////////////////////////
add_action( 'wp_enqueue_scripts', 'add_styles' );
function add_styles(){
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'bootstrap', ASSETS_PATH . 'css/bootstrap.css', array( 'style' ), '1.0' );
    wp_enqueue_style( 'component', ASSETS_PATH . 'css/component.css', array( 'style' ), '1.0' );
    wp_enqueue_style( 'flexslider', ASSETS_PATH . 'css/flexslider.css', array( 'style' ), '1.0' );
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
