<?php

class sky_pro_man_widget extends WP_Widget{
    function __construct() {
        parent::__construct(
            'sky_pro_man_widget',
            __('Products Manager Widget', 'sky_pro_man_widget_domain'),
            array('Description' => __('Widget for Products Manager plugin', 'sky_pro_man_widget_domain'))
        );
    }
    
    
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        if (!empty($title)){
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $query = new WP_Query(array(
            'post_type' => 'sky_products',
            'post_status' => 'publish'
        ));

        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $sky_stored_meta = get_post_meta($post_id);
            $sky_stored_meta['product-title'] = get_the_title($post_id);
            $sky_stored_meta['product-description'] = get_the_content($post_id);
            $sky_stored_meta['product-thumbnail'] = get_the_post_thumbnail($post_id);
            echo'<h5> '.$sky_stored_meta['product-title'].'</h5>'.
                $sky_stored_meta['product-thumbnail'].
                '<p> '.$sky_stored_meta['product-description'].'</p>'.
                '<table class="sky_widget_table">'.
                    '<tr>'.
                        '<td>Price: '.$sky_stored_meta['product-price'][0].' $</td>'.
                        '<td>Color: '.$sky_stored_meta['product-color'][0].'</td>'.
                    '</tr>'.
                    '<tr>'.
                        '<td>Length: '.$sky_stored_meta['product-length'][0].' mm</td>'.
                        '<td>Width: '.$sky_stored_meta['product-width'][0].' mm</td>'.
                    '</tr>'.
                    '<tr>'.
                        '<td>Height: '.$sky_stored_meta['product-height'][0].' mm</td>'.
                        '<td>Weight: '.$sky_stored_meta['product-weight'][0].' gm</td>'.
                    '</tr>'.
                '</table>';
 
        }
        wp_reset_query();
        echo $args['after_widget'];
    }

    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Products', 'sky_pro_man_widget_domain');
        }
        ?>
            <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}

function sky_load_widget() {
	register_widget( 'sky_pro_man_widget' );
}
add_action( 'widgets_init', 'sky_load_widget' );

