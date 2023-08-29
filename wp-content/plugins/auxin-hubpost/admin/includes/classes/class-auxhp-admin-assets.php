<?php
/**
 * Admin Scripts Class.
 *
 * @
*/

// no direct access allowed
if ( ! defined('ABSPATH') ) {
    die();
}

/**
 *  Class to load and print master slider panel scripts
 */
class AUXHP_Admin_Assets {


  /**
   * __construct
   */
  function __construct() {
        // general assets
        $this->load_styles();
        $this->load_scripts();
  }


  /**
   * Styles for admin
   *
   * @return void
   */
  public function load_styles() {
    // wp_enqueue_style( AUXHP_SLUG .'-admin-styles',   AUXHP_ADMIN_URL . '/assets/css/msp-general.css',  array(), AUXHP_VERSION );
  }

    /**
     * Scripts for admin
     *
     * @return void
     */
  public function load_scripts() {
    //wp_enqueue_script( AUXHP_SLUG .'-admin-scripts', AUXHP_ADMIN_URL . '/assets/js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-dialog'), AUXHP_VERSION, true );
  }

}
