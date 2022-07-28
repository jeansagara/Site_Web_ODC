<?php
/**
 * Pagination Settings
 *
 * @package BigBulletin
 */

$bigbulletin_default = bigbulletin_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'bigbulletin_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'bigbulletin' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'bigbulletin_pagination_layout',
	array(
	'default'           => $bigbulletin_default['bigbulletin_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'bigbulletin_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'bigbulletin' ),
	'section'     => 'bigbulletin_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','bigbulletin'),
		'numeric' => esc_html__('Numeric Method','bigbulletin'),
		'load-more' => esc_html__('Ajax Load More Button','bigbulletin'),
		'auto-load' => esc_html__('Ajax Auto Load','bigbulletin'),
	),
	)
);