<?php

class Add_Bootstrap
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', 'enqueue_bootstrap_css');
        add_action('wp_enqueue_scripts', 'enqueue_bootstrap_js');
    }

    function enqueue_bootstrap_css()
    {
        wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css');
    }

    function enqueue_bootstrap_js()
    {
        wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', array('jquery'), '', true);
    }
}
