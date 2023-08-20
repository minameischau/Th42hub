<?php

if (!function_exists('phlox_child_enqueue_styles')) {
    function phlox_child_enqueue_styles()
    {
        $theme = wp_get_theme();
        wp_enqueue_style('phlox-style', get_parent_theme_file_uri('style.css'), array(), $theme->parent()->get('Version'));
    }
}
add_action('wp_enqueue_scripts', 'phlox_child_enqueue_styles', 9);


if (!function_exists('phlox_child_enqueue_styles2')) {
    function phlox_child_enqueue_styles2()
    {
        $theme = wp_get_theme();
        wp_enqueue_style('phlox-child-style', get_stylesheet_directory_uri() . '/style.css', array('phlox-style'), $theme->get('Version'));
    }
}
add_action('wp_enqueue_scripts', 'phlox_child_enqueue_styles2', 11);

if (!defined('PHLOX_CHILD_DIR')) {
    define('PHLOX_CHILD_DIR', get_stylesheet_directory());
}

// Add google font
require_once PHLOX_CHILD_DIR . '/classes/class-add-google-font.php';
new Add_Google_Fonts();

// Add bootstrap
require_once PHLOX_CHILD_DIR . '/classes/class-add-bootstrap.php';
new Add_Bootstrap();
