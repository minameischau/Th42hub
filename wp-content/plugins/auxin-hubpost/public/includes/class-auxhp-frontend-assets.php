<?php
/**
 * Load frontend scripts and styles
 *
 * 
 * @package    Auxin
 * @license    LICENSE.txt
 * @author     averta
 * @link       http://averta.net/phlox/
 * @copyright  (c) 2010-2023 averta
 */

/**
* Constructor
*/
class AUXHP_Frontend_Assets {


	/**
	 * Construct
	 */
	public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_styles' ), 16 );
        add_action( 'wp_enqueue_scripts', array( $this, 'localize_scripts' ) );
    }

    public function localize_scripts() {
        wp_localize_script( AUXHP_SLUG .'-hubpost', 'auxhp', array(
                'ajax_url'          => admin_url( 'admin-ajax.php' ),
                'invalid_required'  => __( 'This is a required field', 'auxin-hubpost' ),
                'invalid_postcode'  => __( 'Zipcode must be digits', 'auxin-hubpost' ),
                'invalid_phonenum'  => __( 'Enter a valid phone number', 'auxin-hubpost' ),
                'invalid_emailadd'  => __( 'Enter a valid email address', 'auxin-hubpost' )
            )
        );
    }

    /**
     * Styles for admin
     *
     * @return void
     */
    public function load_styles() {
        if( current_theme_supports( 'auxin-hubpost' ) ){
            wp_enqueue_style( 'auxin-hubpost' , get_template_directory_uri() . '/css/hubpost.css', array('auxin-main'), AUXHP_VERSION );
        }
        //wp_enqueue_style( AUXHP_SLUG .'-main',   AUXHP_PUB_URL . '/assets/css/main.css',  array(), AUXHP_VERSION );
    }

    /**
     * Scripts for admin
     *
     * @return void
     */
    public function load_scripts() {
        wp_enqueue_script( AUXHP_SLUG .'-hubpost', AUXHP_PUB_URL . '/assets/js/hubpost.js', array('jquery'), AUXHP_VERSION, true );
    }

}
return new AUXHP_Frontend_Assets();
