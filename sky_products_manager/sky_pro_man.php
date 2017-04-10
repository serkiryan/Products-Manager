<?php
/*
Plugin Name: Products Manager
Plugin URI: https://github.com/serkiryan/Products-Manager
Description: Products manager
Version: 1.0
Author: serkiryan
Author URI: https://github.com/serkiryan
*/

require_once(__DIR__.'/sky_functions.php');
require_once(__DIR__.'/sky_fields.php');
require_once(__DIR__.'/sky_widgets.php');

add_action('wp_enqueue_scripts', 'sky_pro_man_scripts');
add_action('init', 'sky_custom_post_type');
