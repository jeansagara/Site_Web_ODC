<?php
/**
* Body Classes.
*
* @package BigBulletin
*/
 
 if (!function_exists('bigbulletin_body_classes')) :

    function bigbulletin_body_classes($classes) {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        global $post;

        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( !is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }
        
        if ( is_active_sidebar( 'sidebar-1' ) ) {

            $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$bigbulletin_default['global_sidebar_layout'] ) );

            if( is_single() || is_page() ){

                $bigbulletin_post_sidebar = esc_html( get_post_meta( $post->ID, 'bigbulletin_post_sidebar_option', true ) );

                if( $bigbulletin_post_sidebar == 'global-sidebar' || empty( $bigbulletin_post_sidebar ) ){

                    if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                        
                        $classes[] = 'no-sidebar';

                    }else{

                        $classes[] = esc_attr( $global_sidebar_layout );

                    }

                }else{

                    if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                        
                        $classes[] = 'no-sidebar';

                    }else{

                        $classes[] = esc_attr( $bigbulletin_post_sidebar );

                    }
                }
                
            }elseif( is_404() ){

                $classes[] = 'no-sidebar';

            }else{
                
                $classes[] = esc_attr( $global_sidebar_layout );
            }

        }
       
        if( is_page() ){

            $bigbulletin_header_trending_page = get_theme_mod( 'bigbulletin_header_trending_page' );
            $bigbulletin_header_popular_page = get_theme_mod( 'bigbulletin_header_popular_page' );

            if( $bigbulletin_header_trending_page == $post->ID || $bigbulletin_header_popular_page == $post->ID ){

                $bigbulletin_archive_layout = get_theme_mod( 'bigbulletin_archive_layout',$bigbulletin_default['bigbulletin_archive_layout'] );
                $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$bigbulletin_default['ed_image_content_inverse'] );
                if( $bigbulletin_archive_layout == 'default' && $ed_image_content_inverse ){

                    $classes[] = 'twp-archive-alternative';

                }

                $classes[] = 'twp-archive-'.esc_attr( $bigbulletin_archive_layout );
                
            }

        }

        if( is_singular('post') ){

            $bigbulletin_post_layout = esc_html( get_post_meta( $post->ID, 'bigbulletin_post_layout', true ) );

            if( $bigbulletin_post_layout == '' || $bigbulletin_post_layout == 'global-layout' ){
                
                $bigbulletin_post_layout = get_theme_mod( 'bigbulletin_single_post_layout',$bigbulletin_default['bigbulletin_archive_layout'] );

            }

            $classes[] = 'twp-single-'.esc_attr( $bigbulletin_post_layout );

            if( $bigbulletin_post_layout == 'layout-2' ){
                
                $bigbulletin_header_overlay = esc_html( get_post_meta( $post->ID, 'bigbulletin_header_overlay', true ) );

                if( $bigbulletin_header_overlay == '' || $bigbulletin_header_overlay == 'global-layout' ){

                    $bigbulletin_post_layout2 = get_theme_mod( 'bigbulletin_single_post_layout',$bigbulletin_default['bigbulletin_archive_layout'] );

                    if( $bigbulletin_post_layout2 == 'layout-2' ){

                        $ed_header_overlay = esc_html( get_post_meta( $post->ID, 'ed_header_overlay', true ) );
                        if( $ed_header_overlay == '' || $ed_header_overlay == 'global-layout' ){
                            
                            $ed_header_overlay = get_theme_mod( 'ed_header_overlay',$bigbulletin_default['ed_header_overlay'] );
                        }

                    }else{

                        $ed_header_overlay = false;

                    }

                }else{

                    $ed_header_overlay = true;

                }
                if( $ed_header_overlay ){

                    $classes[] = 'twp-single-header-overlay';

                }

            }

        }

        if( is_singular('page') ){

            $bigbulletin_page_layout = get_post_meta( $post->ID, 'bigbulletin_page_layout', true );

            if( $bigbulletin_page_layout == ''  ){
                
                $bigbulletin_page_layout = 'layout-1';

            }

            $classes[] = 'theme-single-'.esc_attr( $bigbulletin_page_layout );

            if( $bigbulletin_page_layout == 'layout-2' ){
                
                $bigbulletin_ed_header_overlay = get_post_meta( $post->ID, 'bigbulletin_ed_header_overlay', true );
                if( $bigbulletin_ed_header_overlay ){
                    $classes[] = 'theme-single-header-overlay';
                }

            }

        }

        if( is_archive() || is_home() || is_search() ){

            $bigbulletin_archive_layout = get_theme_mod( 'bigbulletin_archive_layout',$bigbulletin_default['bigbulletin_archive_layout'] );
            $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$bigbulletin_default['ed_image_content_inverse'] );
            if( $bigbulletin_archive_layout == 'default' && $ed_image_content_inverse ){

                $classes[] = 'twp-archive-alternative';

            }

            $classes[] = 'twp-archive-'.esc_attr( $bigbulletin_archive_layout );
            
        }

        if( is_singular('post') ){

            $bigbulletin_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'bigbulletin_ed_post_reaction', true ) );
            if( $bigbulletin_ed_post_reaction ){
                $classes[] = 'hide-comment-rating';
            }

        }
        $hide_asidebar_on_mobile = get_theme_mod( 'hide_asidebar_on_mobile',$bigbulletin_default['hide_asidebar_on_mobile'] );
        if ($hide_asidebar_on_mobile) {
            $classes[] = 'hide-asidebar-mobile';
        }
        
        return $classes;
    }

endif;

add_filter('body_class', 'bigbulletin_body_classes');