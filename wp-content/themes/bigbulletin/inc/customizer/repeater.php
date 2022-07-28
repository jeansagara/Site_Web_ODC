<?php
/**
* Sections Repeater Options.
*
* @package BigBulletin
*/

$bigbulletin_post_category_list = bigbulletin_post_category_list();
$bigbulletin_defaults = bigbulletin_get_default_theme_options();
$home_sections = array(
        
        'tiles-blocks' => esc_html__('Tiles Block','bigbulletin'),
        'main-banner' => esc_html__('Main Banner Slider','bigbulletin'),
        'grid-list-block' => esc_html__('Grid-List Block','bigbulletin'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','bigbulletin'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','bigbulletin'),
        'advertise-blocks' => esc_html__('Advertise Block','bigbulletin'),
        'home-widget-area' => esc_html__('Widgets Area Block','bigbulletin'),
        'you-may-like-blocks' => esc_html__('You May Like Block','bigbulletin'),

    );

// Slider Section.
$wp_customize->add_section( 'home_sections_repeater',
	array(
	'title'      => esc_html__( 'Homepage Sections', 'bigbulletin' ),
	'priority'   => 150,
	'capability' => 'edit_theme_options',
	)
);


// Recommended Posts Enable Disable.
$wp_customize->add_setting( 'twp_bigbulletin_home_sections_5', array(
    'sanitize_callback' => 'bigbulletin_sanitize_repeater',
    'default' => json_encode( $bigbulletin_defaults['twp_bigbulletin_home_sections_5'] ),
    // 'transport'           => 'postMessage',
));

$wp_customize->add_control(  new BigBulletin_Repeater_Controler( $wp_customize, 'twp_bigbulletin_home_sections_5',
    array(
        'section' => 'home_sections_repeater',
        'settings' => 'twp_bigbulletin_home_sections_5',
        'bigbulletin_box_label' => esc_html__('New Section','bigbulletin'),
        'bigbulletin_box_add_control' => esc_html__('Add New Section','bigbulletin'),
        'bigbulletin_box_add_button' => false,
    ),
        array(
            'section_ed' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Section', 'bigbulletin' ),
                'class'       => 'home-section-ed'
            ),
            'home_section_type' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Section Type', 'bigbulletin' ),
                'options'     => $home_sections,
                'class'       => 'home-section-type'
            ),
            'home_section_title' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields you-may-like-blocks-fields'
            ),
            'section_slide_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Slider Post Category', 'bigbulletin' ),
                'options'     => $bigbulletin_post_category_list,
                'class'       => 'home-repeater-fields-hs'
            ),
            'section_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category', 'bigbulletin' ),
                'options'     => $bigbulletin_post_category_list,
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields you-may-like-blocks-fields'
            ),
             'tiles_post_per_page' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Posts Per Page', 'bigbulletin' ),
                'options'     => array( 
                    '5' => 5,
                    '10' => 10,
                ),
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields'
            ),
             'home_section_column_1' => array(
                  'type'        => 'seperator',
                  'seperator_text'       => esc_html__( 'Column 1', 'bigbulletin' ),
                  'class'       => 'home-repeater-fields-hs main-banner-fields grid-list-block-fields'
              ),
              'home_section_title_4' => array(
                 'type'        => 'text',
                 'label'       => esc_html__( 'Block Title', 'bigbulletin' ),
                 'class'       => 'home-repeater-fields-hs main-banner-fields grid-list-block-fields'
             ),

              'section_post_cat_1' => array(
                  'type'        => 'select',
                  'label'       => esc_html__( 'Select Category', 'bigbulletin' ),
                  'options'     => $bigbulletin_post_category_list,
                  'class'       => 'home-repeater-fields-hs main-banner-fields'
              ),
            'section_post_cat_4' => array(
                  'type'        => 'select',
                  'label'       => esc_html__( 'Grid Post Category', 'bigbulletin' ),
                  'options'     => $bigbulletin_post_category_list,
                  'class'       => 'home-repeater-fields-hs grid-list-block-fields'
              ),
              
              'home_section_column_2' => array(
                   'type'        => 'seperator',
                   'seperator_text'       => esc_html__( 'Column 2', 'bigbulletin' ),
                   'class'       => 'home-repeater-fields-hs main-banner-fields grid-list-block-fields'
               ),
            
            'home_section_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Block Title', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields grid-list-block-fields'
            ),
            'home_section_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Slider Area Title', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'section_post_slide_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Slider Post Category', 'bigbulletin' ),
                'options'     => $bigbulletin_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'section_post_cat_3' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'List Post Category', 'bigbulletin' ),
                'options'     => $bigbulletin_post_category_list,
                'class'       => 'home-repeater-fields-hs grid-list-block-fields'
            ),


            'advertise_image' => array(
                'type'        => 'upload',
                'label'       => esc_html__( 'Advertise Image', 'bigbulletin' ),
                'description' => esc_html__( 'Recommended Image Size is 970x250 PX.', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'advertise_link' => array(
                'type'        => 'link',
                'label'       => esc_html__( 'Advertise Image Link', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'ed_arrows_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Arrows', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'ed_dots_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Dot', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'ed_autoplay_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Autoplay', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'home_section_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Tab Area Title', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),            
            'ed_tab' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Tab', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs ed-tabs-ac banner-blocks-1-fields'
            ),
            'cat_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title One', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_1' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category One', 'bigbulletin' ),
                'options'     => $bigbulletin_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'cat_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Two', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_2' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Two', 'bigbulletin' ),
                'options'     => $bigbulletin_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'cat_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Three', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_3' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Three', 'bigbulletin' ),
                'options'     => $bigbulletin_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'section_category_4' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Four', 'bigbulletin' ),
                'options'     => $bigbulletin_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'ed_flip_column' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Flip Column Right to Left', 'bigbulletin' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
    )
));

// Info.
$wp_customize->add_setting(
    'bigbulletin_notiece_info',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new BigBulletin_Info_Notiece_Control( 
        $wp_customize,
        'bigbulletin_notiece_info',
        array(
            'settings' => 'bigbulletin_notiece_info',
            'section'       => 'home_sections_repeater',
            'label'         => esc_html__( 'Info', 'bigbulletin' ),
        )
    )
);

$wp_customize->add_setting(
    'bigbulletin_premium_notiece',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new BigBulletin_Premium_Notiece_Control( 
        $wp_customize,
        'bigbulletin_premium_notiece',
        array(
            'label'      => esc_html__( 'Home Page Blocks', 'bigbulletin' ),
            'settings' => 'bigbulletin_premium_notiece',
            'section'       => 'home_sections_repeater',
        )
    )
);