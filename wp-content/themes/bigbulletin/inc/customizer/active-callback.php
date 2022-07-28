<?php
/**
 * BigBulletin Customizer Active Callback Functions
 *
 * @package BigBulletin
 */

function bigbulletin_header_archive_layout_ac( $control ){

    $bigbulletin_archive_layout = $control->manager->get_setting( 'bigbulletin_archive_layout' )->value();
    if( $bigbulletin_archive_layout == 'default' ){

        return true;
        
    }
    
    return false;
}

function bigbulletin_overlay_layout_ac( $control ){

    $bigbulletin_single_post_layout = $control->manager->get_setting( 'bigbulletin_single_post_layout' )->value();
    if( $bigbulletin_single_post_layout == 'layout-2' ){

        return true;
        
    }
    
    return false;
}

function bigbulletin_header_ad_ac( $control ){

    $ed_header_ad = $control->manager->get_setting( 'ed_header_ad' )->value();
    if( $ed_header_ad ){

        return true;
        
    }
    
    return false;
}