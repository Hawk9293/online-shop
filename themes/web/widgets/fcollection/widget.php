<?php defined('ABSPATH') || exit;

add_action('widgets_init','f_collection');
function f_collection() {
    register_widget('F_Collection');
}

class F_Collection extends WP_Widget {
    // конструктор
    function F_Collection(){
        $widget_options = [
            'className' => 'webShop',
            'description' => 'Описание'
        ];
        $control_options = [
            'width' => '300',
            'height' => '350'
        ];
        $this->WP_Widget('fcollection', 'Featured Collection', $widget_options, $control_options);
    }
    // вывод виджета в вёрстку
    public function widget($args, $instance){
        $title = apply_filters('widget_title', $instance['title']);
        $pcount = $instance['pcount'];

        include 'w-templ.php';
    }

    // обновление данных в виджите
    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['pcount'] = strip_tags($new_instance['pcount']);
        return $instance;
    }

    // настройка виджета
    function form($instance) {
        $defaults = [
            'title' => 'Featured Collection',
            'pcount' => 5
        ];
        $instance = wp_parse_args( (array)$instance, $defaults );
?>
        <p>
            <label for="<?=$this->get_field_id('title'); ?>">Заголовок</label>
            <input
                id="<?=$this->get_field_id('title'); ?>"
                name="<?=$this->get_field_name('title'); ?>"
                value="<?=$instance['title']; ?>"
                style="width: 100%"
                type="text">
        </p>
        <p>
            <label for="<?=$this->get_field_id('pcount'); ?>">Количество слайдов</label>
            <input
                id="<?=$this->get_field_id('pcount'); ?>"
                name="<?=$this->get_field_name('pcount'); ?>"
                value="<?=$instance['pcount']; ?>"
                style="width: 100%"
                type="number">
        </p>
<?php
    }
}

