<?php


function sky_pro_man_scripts(){
    wp_enqueue_script('sky_pro_man_script', plugins_url('/js/sky_pro_man_script.js', __FILE__), array('jquery', 'jquery-ui-datepicker'), null, true);
    wp_enqueue_style('sky_pro_man_style', plugins_url('/css/sky_pro_man_style.css', __FILE__));
}

function sky_custom_post_type()
{
    $plural = 'Products';
    $singular = 'Product';
    
    $labels = array(
        'name'          => $plural,
        'singular_name' => $singular,
        'add_name'      => 'Add new',
        'add_new_item'  => 'Add new '.$singular
    );
    
    $args = array(
        'labels'        => $labels,
        'supports'      => array( 'title', 'editor', 'thumbnail'),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-products'
    );
    register_post_type('sky_products', $args);
    remove_action( 'media_buttons', 'media_buttons' );
}




