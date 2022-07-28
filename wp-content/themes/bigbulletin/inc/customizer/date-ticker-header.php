<?php
/**
* Header Options.
*
* @package BigBulletin
*/

$bigbulletin_default = bigbulletin_get_default_theme_options();
$bigbulletin_post_category_list = bigbulletin_post_category_list();
$wp_customize->add_section( 'breaking_news_setting',
    array(
    'title'      => esc_html__( 'Ticker News Settings', 'bigbulletin' ),
    'priority'   => 13,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);


$wp_customize->add_setting('ed_header_ticker_posts',
    array(
        'default' => $bigbulletin_default['ed_header_ticker_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ticker_posts',
    array(
        'label' => esc_html__('Enable Ticker Posts', 'bigbulletin'),
        'section' => 'breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_ticker_posts_title',
    array(
    'default'           => $bigbulletin_default['ed_header_ticker_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_ticker_posts_title',
    array(
    'label'       => esc_html__( 'Ticker Section Title', 'bigbulletin' ),
    'section'     => 'breaking_news_setting',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'bigbulletin_header_ticker_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'bigbulletin_sanitize_select',
    )
);
$wp_customize->add_control( 'bigbulletin_header_ticker_cat',
    array(
    'label'       => esc_html__( 'Ticker Posts Category', 'bigbulletin' ),
    'section'     => 'breaking_news_setting',
    'type'        => 'select',
    'choices'     => $bigbulletin_post_category_list,
    )
);

$wp_customize->add_setting('ed_ticker_slider_autoplay',
    array(
        'default' => $bigbulletin_default['ed_ticker_slider_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_slider_autoplay',
    array(
        'label' => esc_html__('Enable Ticker Posts Autoplay', 'bigbulletin'),
        'section' => 'breaking_news_setting',
        'type' => 'checkbox',
    )
);