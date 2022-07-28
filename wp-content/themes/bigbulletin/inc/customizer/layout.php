<?php
/**
* Layouts Settings.
*
* @package BigBulletin
*/

$bigbulletin_default = bigbulletin_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'layout_setting',
	array(
	'title'      => esc_html__( 'Archive Settings', 'bigbulletin' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting( 'global_sidebar_layout',
	array(
	'default'           => $bigbulletin_default['global_sidebar_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bigbulletin_sanitize_sidebar_option',
	)
);
$wp_customize->add_control( 'global_sidebar_layout',
	array(
	'label'       => esc_html__( 'Global Sidebar Layout', 'bigbulletin' ),
	'section'     => 'layout_setting',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'bigbulletin' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'bigbulletin' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'bigbulletin' ),
	    ),
	)
);

// Archive Layout.
$wp_customize->add_setting(
    'bigbulletin_archive_layout',
    array(
        'default' 			=> $bigbulletin_default['bigbulletin_archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_archive_layout'
    )
);
$wp_customize->add_control(
    new BigBulletin_Custom_Radio_Image_Control(
        $wp_customize,
        'bigbulletin_archive_layout',
        array(
            'settings'      => 'bigbulletin_archive_layout',
            'section'       => 'layout_setting',
            'label'         => esc_html__( 'Archive Layout', 'bigbulletin' ),
            'choices'       => array(
            	'default'  => get_template_directory_uri() . '/assets/images/Layout-style-1.png',
                'full'  => get_template_directory_uri() . '/assets/images/Layout-style-2.png',
                'grid'  => get_template_directory_uri() . '/assets/images/Layout-style-3.png',
            )
        )
    )
);


$wp_customize->add_setting('ed_image_content_inverse',
    array(
        'default' => $bigbulletin_default['ed_image_content_inverse'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_image_content_inverse',
    array(
        'label' => esc_html__('Inverse Image with Content', 'bigbulletin'),
        'section' => 'layout_setting',
        'type' => 'checkbox',
        'active_callback' => 'bigbulletin_header_archive_layout_ac',
    )
);

