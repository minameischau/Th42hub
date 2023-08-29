<?php

// no direct access allowed
if ( ! defined('ABSPATH') ) {
    die();
}

//die( "MJ" );

// theme name
if( ! defined( 'THEME_NAME' ) ){
    $theme_data = wp_get_theme();
    define( 'THEME_NAME', $theme_data->Name );
}



define( 'AUXHP_VERSION'        , '2.3.1' );

define( 'AUXHP_SLUG'           , 'auxin-hubpost' );


define( 'AUXHP_DIR'            , dirname( plugin_dir_path( __FILE__ ) ) );
define( 'AUXHP_URL'            , plugins_url( '', plugin_dir_path( __FILE__ ) ) );
define( 'AUXHP_BASE_NAME'      , plugin_basename( AUXHP_DIR ) . '/auxin-hubpost.php' ); // auxin-hubpost/auxin-hubpost.php


define( 'AUXHP_ADMIN_DIR'      , AUXHP_DIR . '/admin' );
define( 'AUXHP_ADMIN_URL'      , AUXHP_URL . '/admin' );

define( 'AUXHP_INC_DIR'        , AUXHP_DIR . '/includes' );
define( 'AUXHP_INC_URL'        , AUXHP_URL . '/includes' );

define( 'AUXHP_PUB_DIR'        , AUXHP_DIR . '/public' );
define( 'AUXHP_PUB_URL'        , AUXHP_URL . '/public' );
