<?php

class Add_Google_Fonts
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'add_google_fonts']);
    }

    function add_google_fonts()
    {
        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap');
    }
}
