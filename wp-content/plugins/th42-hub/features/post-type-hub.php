<?php

class Post_Type_Hub
{
    public function __construct()
    {
        // Register Post type
        add_action('init', [$this, 'register_post_type_hub']);

        // Change title
        add_filter('enter_title_here', [$this, 'wpb_change_title_text']);
    }

    function wpb_change_title_text($title)
    {
        $screen = get_current_screen();

        if ('hub' == $screen->post_type) {
            $title = 'Enter Subject';
        }
        return $title;
    }
    function register_post_type_hub()
    {
        $labels = array(
            'name'                  => __('Hubs'),
            'singular_name'         => __('Member'),
            'menu_name'             => __('Hubs'),
            'add_new'               => __('Add New Menber'),
            'add_new_item'          => __('New Menber'),
            'edit'                  => __('Edit Menber'),
            'edit_item'             => __('Edit Menber'),
            'search_items'          => __('Search Menber'),
            'not_found'             => __('Not found Menber'),

        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'service'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-buddicons-buddypress-logo',
            'supports'           => array('title', 'editor', 'thumbnail')
        );

        register_post_type('hub', $args);
    }
}

new Post_Type_Hub;
