<?php
/**
* Custom Functions.
*
* @package BigBulletin
*/


if( !function_exists( 'bigbulletin_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function bigbulletin_sanitize_sidebar_option( $bigbulletin_input ){

        $bigbulletin_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $bigbulletin_input,$bigbulletin_metabox_options ) ){

            return $bigbulletin_input;

        }

        return;

    }

endif;

if( !function_exists( 'bigbulletin_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function bigbulletin_sanitize_single_pagination_layout( $bigbulletin_input ){

        $bigbulletin_single_pagination = array( 'no-navigation','norma-navigation','ajax-next-post-load' );
        if( in_array( $bigbulletin_input,$bigbulletin_single_pagination ) ){

            return $bigbulletin_input;

        }

        return;

    }

endif;

if( !function_exists( 'bigbulletin_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function bigbulletin_sanitize_archive_layout( $bigbulletin_input ){

        $bigbulletin_archive_option = array( 'default','full','grid' );
        if( in_array( $bigbulletin_input,$bigbulletin_archive_option ) ){

            return $bigbulletin_input;

        }

        return;

    }

endif;

if( !function_exists( 'bigbulletin_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function bigbulletin_sanitize_single_post_layout( $bigbulletin_input ){

        $bigbulletin_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $bigbulletin_input,$bigbulletin_single_layout ) ){

            return $bigbulletin_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'bigbulletin_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function bigbulletin_sanitize_checkbox( $bigbulletin_checked ) {

		return ( ( isset( $bigbulletin_checked ) && true === $bigbulletin_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'bigbulletin_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function bigbulletin_sanitize_select( $bigbulletin_input, $bigbulletin_setting ) {

        // Ensure input is a slug.
        $bigbulletin_input = sanitize_text_field( $bigbulletin_input );

        // Get list of choices from the control associated with the setting.
        $choices = $bigbulletin_setting->manager->get_control( $bigbulletin_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $bigbulletin_input, $choices ) ? $bigbulletin_input : $bigbulletin_setting->default );

    }

endif;

if ( ! function_exists( 'bigbulletin_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function bigbulletin_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'section_ed' 
                        || $key == 'ed_tab' 
                        || $key == 'ed_arrows_carousel' 
                        || $key == 'ed_dots_carousel' 
                        || $key == 'ed_autoplay_carousel' 
                        || $key == 'ed_flip_column' 
                        || $key == 'ed_ribbon_bg'
                    ){

                        $input_decoded[$boxes][$key] = bigbulletin_sanitize_repeater_ed( $value );

                    }elseif( $key == 'home_section_type' ){

                        $input_decoded[$boxes][$key] = bigbulletin_sanitize_home_sections( $value );

                    }elseif( $key == 'ribbon_bg_color_schema' ){

                        $input_decoded[$boxes][$key] = bigbulletin_sanitize_ribbon_bg( $value );

                    }elseif( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }elseif( $key == 'tiles_post_per_page' ){

                        $input_decoded[$boxes][$key] =  absint( $value );

                    }elseif( $key == 'advertise_image' || $key == 'advertise_link' ){

                         $input_decoded[$boxes][$key] = esc_url_raw( $value );

                    }elseif($key == 'section_category' || 
                            $key == 'section_post_slide_cat' || 
                            $key == 'section_post_cat_1' || 
                            $key == 'section_category_1' || 
                            $key == 'section_category_2' || 
                            $key == 'section_category_3' || 
                            $key == 'section_category_4' || 
                            $key == 'category'
                        ){

                        $input_decoded[$boxes][$key] =  bigbulletin_sanitize_category( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;

/** Sanitize Enable Disable Checkbox **/
function bigbulletin_sanitize_repeater_ed( $input ) {

    $valid_keys = array('yes','no');
    if ( in_array( $input , $valid_keys ) ) {
        return $input;
    }
    return '';

}

function bigbulletin_sanitize_home_sections( $input ) {

    $home_sections = array(

        'tiles-blocks' => esc_html__('Tiles Block','bigbulletin'),
        'main-banner' => esc_html__('Main Banner Slider','bigbulletin'),
        'grid-list-block' => esc_html__('Grid-List Block','bigbulletin'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','bigbulletin'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','bigbulletin'),
        'slider-blocks' => esc_html__('Slider Block','bigbulletin'),
        'advertise-blocks' => esc_html__('Advertise Block','bigbulletin'),
        'home-widget-area' => esc_html__('Widgets Area Block','bigbulletin'),
        'you-may-like-blocks' => esc_html__('You May Like Block','bigbulletin'),

    );
    if ( array_key_exists( $input , $home_sections ) ) {
        return $input;
    }
    return '';

}

/** Sanitize Category **/
function bigbulletin_sanitize_category( $input ) {

   $bigbulletin_post_category_list = bigbulletin_post_category_list();
    if ( array_key_exists( $input , $bigbulletin_post_category_list ) ) {
        return $input;
    }
    return '';

}

function bigbulletin_sanitize_ribbon_bg( $input ) {

    $ribbon_bg = array( 
                    '1' =>  array(
                                    'title' =>  esc_html__( 'Blue', 'bigbulletin' ),
                                    'color' =>  '#3061ff',
                                ),
                    '2' =>  array(
                                    'title' =>  esc_html__( 'Orange', 'bigbulletin' ),
                                    'color' =>  '#fa9000',
                                ),
                    '3' =>  array(
                                    'title' =>  esc_html__( 'Royal Blue', 'bigbulletin' ),
                                    'color' =>  '#00167a',
                                ),
                    '4' =>  array(
                                    'title' =>  esc_html__( 'Pink', 'bigbulletin' ),
                                    'color' =>  '#ff2d55',
                                ),
                );

    if ( array_key_exists( $input , $ribbon_bg ) ) {
        return $input;
    }
    return '';

}