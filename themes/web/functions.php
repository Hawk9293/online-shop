<?php defined('ABSPATH') || exit;

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
//////////////////////////// Создаём класс для меню ////////////////////////////
class Walker_Naw_Menu extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $html = '';

        // Ссылки 0 уровня
        if ( $depth == 0 ){
            $html .= '<li';
            if ( $args -> walker -> has_children ){
                $html .= ' class="dropdown"';
            }
            $html .= '><a ';
            if ( $args -> walker -> has_children ){
                $html .= ' class="dropdown-toggle" data-toggle="dropdown"';
            }
            $html .= ' href="%s">%s';
            if ( $args -> walker -> has_children ){
                $html .= '<b class="caret"></b>';
            }
            $html .= '</a>';
            $output .= sprintf( $html, $item -> url, $item -> title );
        }

        // Ссылки 1 уровня
        if ( $depth == 1 ){
            $output .= '<div class="col-sm-4"><ul class="multi-column-dropdown"><h6>' . mb_strtoupper($item -> title . '</h6>');
        }

        // Ссылки 2 уровня
        if ( $depth == 2 ){
            $output .='<li><a href="' . $item -> url . '">' . $item -> title . '</a></li>';
        }
    }
    public function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if ( $depth == 0 ){
            $output .= '</li>';
        }
        if ( $depth == 1 ){
            $output .= '</ul></div>';
        }
    }
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( $depth == 0 ){
            $output .= '<ul class="dropdown-menu multi-column columns-3"><div class="row">';
        }
    }
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( $depth == 0 ){
            $output .= '</div></ul>';
        }
    }
}
//////////////////////////// Создаём кастомные типы записи ////////////////////////////
add_action('init', 'hero_index');
function hero_index(){
    register_post_type('slider', array(
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_position' => 1,
        'menu_icon' => 'dashicons-format-gallery',
        'taxonomy' => 'slider_cat',
        'labels' => array(
            'name' => 'Слайдер',
            'all_item' => 'Все слайды',
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Новый слайд'
        )
    ));
};
// хук для регистрации
add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){
    // список параметров: wp-kama.ru/function/get_taxonomy_labels
    register_taxonomy( 'slider_cat', [ 'slider' ], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => [
            'name'              => 'Категории',
            'singular_name'     => 'Категория',
            'search_items'      => 'Поиск категории',
            'all_items'         => 'Все категории',
            'view_item '        => 'Просмотр категорий',
            'parent_item'       => 'Родительская категория',
            'parent_item_colon' => 'Родительская категория:',
            'edit_item'         => 'Редактировать категорию',
            'update_item'       => 'Update Genre',
            'add_new_item'      => 'Add New Genre',
            'new_item_name'     => 'New Genre Name',
            'menu_name'         => 'Категории',
        ],
        'description'           => '', // описание таксономии
        'public'                => true,
        'hierarchical'          => true,
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
        'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
        'show_in_rest'          => null, // добавить в REST API
        'rest_base'             => null, // $taxonomy
    ] );
}
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

register_nav_menus([
    'header_menu' => 'Меню в шапке',
    'footer_menu' => 'Меню в подвале'
]);

//////////////////////////// Изменяем вывод заголовка магазина ////////////////////////////
//add_filter('woocommerce_page_title', 'change_page_title');
//function change_page_title( $page_title ){
//    return '< $page_title >';
//}
//////////////////////////// Вывод миниатюры товара ////////////////////////////
function woocommerce_template_loop_product_thumbnail(){
    echo woocommerce_get_product_thumbnail();
    echo '</a><div class="mask"><a href="' . get_the_permalink() . '">Quick View</a></div>';
}
//////////////////////////// Вывод заголовка товара ////////////////////////////
function woocommerce_template_loop_product_title(){
    echo '<a class="product_name" href="' . get_the_permalink() . '">'. wp_trim_words(get_the_title(),5) .'</a>';
}

//////////////////////////// Вывод плашки "Скидка" ////////////////////////////
function change_sale_flash(){
    $html =
        '<div class="offer my-sale-block">
            <p>40%</p>
            <small>Sale</small>
        </div>';
    return $html;
}
add_filter('woocommerce_sale_flash', 'change_sale_flash');

//////////////////////////// my functions ////////////////////////////
function my_print( $value, $color = 'white', $end = 0 ) {
    echo "<pre style='background:" . $color. "';>";
    print_r($value);
    echo "</pre>";
    if ( $end ) die();
}
