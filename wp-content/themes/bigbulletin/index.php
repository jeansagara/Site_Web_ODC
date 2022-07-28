<?php
/**
 *
 * Front Page
 *
 * @package BigBulletin
 */

get_header();


    $bigbulletin_default = bigbulletin_get_default_theme_options();
    $bigbulletin_default = bigbulletin_get_default_theme_options();
    $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $bigbulletin_default['global_sidebar_layout'] ) );
    

    if( is_single() || is_page() ){

        $bigbulletin_post_sidebar = esc_attr( get_post_meta( $post->ID, 'bigbulletin_post_sidebar_option', true ) );
        if( $bigbulletin_post_sidebar == 'global-sidebar' || empty( $bigbulletin_post_sidebar ) ){

            $sidebar = $sidebar;
        }else{
            $sidebar = $bigbulletin_post_sidebar;
        }

    }
    $twp_bigbulletin_home_sections_5 = get_theme_mod( 'twp_bigbulletin_home_sections_5', json_encode( $bigbulletin_default['twp_bigbulletin_home_sections_5'] ) );
    $repeat_times = 1;
    $paged_active = false;

    if ( !is_paged() ) {
        $paged_active = true;
    }

    $twp_bigbulletin_home_sections_5 = json_decode( $twp_bigbulletin_home_sections_5 );

    if( $twp_bigbulletin_home_sections_5 ){ ?>

        <?php
        foreach ( $twp_bigbulletin_home_sections_5 as $bigbulletin_home_section ) {

            $home_section_type = isset( $bigbulletin_home_section->home_section_type ) ? $bigbulletin_home_section->home_section_type : '';

            switch ($home_section_type) {

                case 'main-banner':

                    $ed_slider_blocks = isset( $bigbulletin_home_section->section_ed ) ? $bigbulletin_home_section->section_ed : '';
                    if ( $ed_slider_blocks == 'yes' && $paged_active ) {
                        bigbulletin_main_banner( $bigbulletin_home_section , $repeat_times);
                    }

                break;

                case 'grid-list-block':

                    $ed_grid_list_blocks = isset( $bigbulletin_home_section->section_ed ) ? $bigbulletin_home_section->section_ed : '';
                    if ( $ed_grid_list_blocks == 'yes' && $paged_active ) {
                        bigbulletin_grid_list_block( $bigbulletin_home_section , $repeat_times);
                    }

                break;

                case 'latest-posts-blocks':

                    $ed_latest_posts_blocks = isset( $bigbulletin_home_section->section_ed ) ? $bigbulletin_home_section->section_ed : '';
                    if ( $ed_latest_posts_blocks == 'yes' ) {
                        bigbulletin_latest_blocks( $bigbulletin_home_section  , $repeat_times);
                    }

                break;

                case 'tiles-blocks':

                    $ed_tiles_block = isset( $bigbulletin_home_section->section_ed ) ? $bigbulletin_home_section->section_ed : '';
                    if ( $ed_tiles_block == 'yes' && $paged_active ) {
                        bigbulletin_tiles_block_section( $bigbulletin_home_section , $repeat_times);
                    }

                break;

                case 'banner-blocks-1':

                    $ed_banner_blocks_1 = isset( $bigbulletin_home_section->section_ed ) ? $bigbulletin_home_section->section_ed : '';
                    if ( $ed_banner_blocks_1 == 'yes' && $paged_active ) {
                        bigbulletin_banner_block_1_section( $bigbulletin_home_section , $repeat_times);
                    }

                break;

                case 'advertise-blocks':

                    $ed_advertise_blocks = isset( $bigbulletin_home_section->section_ed ) ? $bigbulletin_home_section->section_ed : '';
                    if ( $ed_advertise_blocks == 'yes' && $paged_active ) {
                        bigbulletin_advertise_block( $bigbulletin_home_section , $repeat_times);
                    }
                    
                break;

                case 'home-widget-area':

                    $ed_home_widget_area = isset( $bigbulletin_home_section->section_ed ) ? $bigbulletin_home_section->section_ed : '';
                    if ( $ed_home_widget_area == 'yes' && $paged_active ) {
                        bigbulletin_case_home_widget_area_block( $bigbulletin_home_section , $repeat_times);
                    }
                    
                break;

                case 'you-may-like-blocks':

                    $ed_you_may_like_area = isset( $bigbulletin_home_section->section_ed ) ? $bigbulletin_home_section->section_ed : '';
                    if ( $ed_you_may_like_area == 'yes' && $paged_active ) {
                        bigbulletin_you_may_like_block_section( $bigbulletin_home_section , $repeat_times);
                    }
                    
                break;

                default:

                break;

            }

        $repeat_times++;
        } 
        ?>

    <?php
    }

get_footer();
