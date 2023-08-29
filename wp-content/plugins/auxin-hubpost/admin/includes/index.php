<?php // load admin related classes & functions

// load admin related functions
include_once( 'admin-the-functions.php' );

// load admin related classes
include_once( 'classes/class-auxhp-admin-assets.php'  );

do_action( 'auxhp_admin_classes_loaded' );

include_once( 'metaboxes/metabox-fields-hubpost.php' );

// load admin related functions
include_once( 'admin-hooks.php' );
