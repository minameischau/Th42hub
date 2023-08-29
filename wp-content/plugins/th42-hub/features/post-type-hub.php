<?php

class Post_Type_Hub
{
    public function __construct()
    {
        // Register Post type
        add_action('init', [$this, 'register_post_type_hub']);

        // Change title
        add_filter('enter_title_here', [$this, 'wpb_change_title_text']);

        // Add bootstrap to admin page 
        add_action('admin_enqueue_scripts', [$this, 'enqueue_bootstrap_admin']);

        //Add meta box
        require_once(TH42_HUB_PLUGIN_PATH . 'features/meta-box-hub.php');
    }

    function enqueue_bootstrap_admin()
    {
        global $post_type;

        if ($post_type === 'hub') {
            wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css');
            wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', array('jquery'), '', true);
        }
    }

    function wpb_change_title_text($title)
    {
        $screen = get_current_screen();

        if ('hub' == $screen->post_type) {
            $title = 'Enter Subject *';
        }
        return $title;
    }
    function register_post_type_hub()
    {
        $labels = array(
            'name'                  => __('Hub Posts'),
            'singular_name'         => __('Member'),
            'menu_name'             => __('Hub Posts'),
            'add_new'               => __('Add New Member'),
            'add_new_item'          => __('New Post'),
            'edit'                  => __('Edit Post'),
            'edit_item'             => __('Edit Post'),
            'search_items'          => __('Search Post'),
            'not_found'             => __('Not found Post'),

        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'hubs'),
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
