<?php
/**
* Asidebar Settings.
*
* @package BigBulletin
*/

$bigbulletin_default = bigbulletin_get_default_theme_options();
$bigbulletin_post_category_list = bigbulletin_post_category_list();

$wp_customize->add_section( 'asidebar_settings',
	array(
	'title'      => esc_html__( 'Asidebar Settings', 'bigbulletin' ),
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	'priority'  => 20,
	)
);

$wp_customize->add_setting( 'asidebar_section_tab_title_1',
    array(
    'default'           => $bigbulletin_default['asidebar_section_tab_title_1'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'asidebar_section_tab_title_1',
    array(
    'label'       => esc_html__( 'Asidebar Tab Section Title 1', 'bigbulletin' ),
    'section'     => 'asidebar_settings',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'asidebar_section_tab_category_1',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'bigbulletin_sanitize_select',
    )
);
$wp_customize->add_control( 'asidebar_section_tab_category_1',
    array(
    'label'       => esc_html__( 'Asidebar Tab Section Category 1', 'bigbulletin' ),
    'section'     => 'asidebar_settings',
    'type'        => 'select',
    'choices'     => $bigbulletin_post_category_list,
    )
);


$wp_customize->add_setting( 'asidebar_section_tab_title_2',
    array(
    'default'           => $bigbulletin_default['asidebar_section_tab_title_2'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'asidebar_section_tab_title_2',
    array(
    'label'       => esc_html__( 'Asidebar Tab Section Title 2', 'bigbulletin' ),
    'section'     => 'asidebar_settings',
    'type'        => 'text',
    )
);



$wp_customize->add_setting( 'asidebar_section_tab_category_2',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'bigbulletin_sanitize_select',
    )
);
$wp_customize->add_control( 'asidebar_section_tab_category_2',
    array(
    'label'       => esc_html__( 'Asidebar Tab Section Category 2', 'bigbulletin' ),
    'section'     => 'asidebar_settings',
    'type'        => 'select',
    'choices'     => $bigbulletin_post_category_list,
    )
);


$wp_customize->add_setting('hide_asidebar_on_mobile',
    array(
        'default' => $bigbulletin_default['hide_asidebar_on_mobile'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_checkbox',
    )
);

$wp_customize->add_control('hide_asidebar_on_mobile',
    array(
        'label' => esc_html__('Hide on Mobile', 'bigbulletin'),
        'section' => 'asidebar_settings',
        'type' => 'checkbox',
    )
);