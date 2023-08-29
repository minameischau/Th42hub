<?php
/**
 * Admin specific hooks
 */

/**
 * Triggers an action after plugin was updated to new version.
 *
 * @return void
 */
function auxhp_after_plugin_update(){

    if( AUXHP_VERSION !== get_transient( 'auxin_' . AUXHP_SLUG . '_version' ) ){
        set_transient( 'auxin_' . AUXHP_SLUG . '_version', AUXHP_VERSION, MONTH_IN_SECONDS );

        do_action( 'auxin_plugin_updated', true, AUXHP_SLUG, AUXHP_VERSION, AUXHP_BASE_NAME );
    }
}
add_action( "admin_init", "auxhp_after_plugin_update");


/**
 * Set the uncategorized category for newest hubposts
 * 
 * @return void
 */
add_action( 'save_post_hubpost' , 'auxin_set_uncategorized_term' , 10, 2 );
