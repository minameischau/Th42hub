<?php

/**
 * Plugin Name: Th42 Hub - Plugin Main
 * Description: This is main plugin of this system. 
 * Version: 1.0 
 * Author: Administrator
 * Author URI: http://fb.com/phamle21 
 * License: GPLv2 
 */

if (!defined('TH42_HUB_PLUGIN_PATH')) {
    define('TH42_HUB_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

if (!defined('TH42_HUB_PLUGIN_URL')) {
    define('TH42_HUB_PLUGIN_URL', plugin_dir_url(__FILE__));
}

require_once TH42_HUB_PLUGIN_PATH . 'features/custom-post-type-portfolio.php';
