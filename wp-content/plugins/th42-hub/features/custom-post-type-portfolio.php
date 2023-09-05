<?php

class Custom_Post_Type_Portfolio
{
    protected $post_type = 'portfolio';
    public function __construct()
    {
        // Change title
        add_filter('enter_title_here', [$this, 'wpb_change_title_text']);

        // Add bootstrap to admin page 
        add_action('admin_enqueue_scripts', [$this, 'enqueue_bootstrap_admin']);

        //Add meta box
        require_once(TH42_HUB_PLUGIN_PATH . 'features/meta-box-portfolio.php');
    }

    function enqueue_bootstrap_admin()
    {
        global $post_type;

        if ($post_type === $this->post_type) {
            wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css');
            wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js', array('jquery'), '', true);
        }
    }

    function wpb_change_title_text($title)
    {
        $screen = get_current_screen();

        if ($this->post_type == $screen->post_type) {
            $title = 'Enter Subject *';
        }
        return $title;
    }
}

new Custom_Post_Type_Portfolio;
