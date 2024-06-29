<?php

function citykid_get_sidebar_options(){
    // Get the registered sidebars.
    global $wp_registered_sidebars;

    $sidebars = array();
    foreach ( $wp_registered_sidebars as $id => $sidebar ) {
        $sidebars[ $id ] = $sidebar['name'];
    }

    return $sidebars;
}

function citykid_get_the_ID(){
    if( 'ctrl_listings' === get_post_type() ){
        $page_id = control_listings_setting( 'listing_archive_page' );
        $post_exists = (new \WP_Query(['post_type' => 'any', 'p'=>$page_id]))->found_posts > 0;
        if($post_exists){
            return $page_id;
        }
    }
    return get_the_ID();	
}

function citykid_get_themeURI($trail=""){    
    $ThemeURI =  apply_filters('citykid_get_themeURI', trailingslashit(wp_get_theme('citykid')->get('ThemeURI')));
    return $ThemeURI.$trail;
}