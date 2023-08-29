<?php

while ( have_posts() ) : the_post();

    // get the post media layout
    if( 'default' == $media_layout = auxin_get_post_meta( $post, '_media_layout', 'default' ) ){
    	$media_layout = auxin_get_option( 'hubpost_single_media_layout' );
    }

    auxhp_get_template_part( 'theme-parts/entry/single', 'hubpost');

endwhile; // end of the loop.
