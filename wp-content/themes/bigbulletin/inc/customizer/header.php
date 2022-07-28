<?php
/**
* Header Options.
*
* @package BigBulletin
*/

$bigbulletin_default = bigbulletin_get_default_theme_options();
$bigbulletin_page_lists = bigbulletin_page_lists();
$bigbulletin_post_category_list = bigbulletin_post_category_list();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'bigbulletin' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_header_ad',
    array(
        'default' => $bigbulletin_default['ed_header_ad'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ad',
    array(
        'label' => esc_html__('Enable Top Advertisement Area', 'bigbulletin'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('header_ad_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_ad_image',
        array(
            'label'      => esc_html__( 'Top Header AD Image', 'bigbulletin' ),
            'section'    => 'main_header_setting',
            'active_callback' => 'bigbulletin_header_ad_ac',
        )
    )
);

$wp_customize->add_setting('ed_header_link',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('ed_header_link',
    array(
        'label' => esc_html__('AD Image Link', 'bigbulletin'),
        'section' => 'main_header_setting',
        'type' => 'text',
        'active_callback' => 'bigbulletin_header_ad_ac',
    )
);



$wp_customize->add_setting('ed_ticker_bar_social_nav',
    array(
        'default' => $bigbulletin_default['ed_ticker_bar_social_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar_social_nav',
    array(
        'label' => esc_html__('Enable Social Nav', 'bigbulletin'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_ticker_bar_date',
    array(
        'default' => $bigbulletin_default['ed_ticker_bar_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar_date',
    array(
        'label' => esc_html__('Enable Current Date', 'bigbulletin'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ticker_date_format',
    array(
    'default'           => $bigbulletin_default['ticker_date_format'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ticker_date_format',
    array(
    'label'       => esc_html__( 'Ticker Date Format', 'bigbulletin' ),
    'section'     => 'main_header_setting',
    'type'        => 'text',
    )
);


// Archive Layout.
$wp_customize->add_setting(
    'bigbulletin_header_bg_size',
    array(
        'default'           => $bigbulletin_default['bigbulletin_header_bg_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control('bigbulletin_header_bg_size',
        array(
            'type'       => 'select',
            'section'       => 'header_image',
            'label'         => esc_html__( 'Header BG Size', 'bigbulletin' ),
            'choices'       => array(
                '1'  => esc_html__( 'Small', 'bigbulletin' ),
                '2'  => esc_html__( 'Medium', 'bigbulletin' ),
                '3'  => esc_html__( 'Large', 'bigbulletin' ),
            )
        )
);

$wp_customize->add_setting('ed_header_bg_fixed',
    array(
        'default' => $bigbulletin_default['ed_header_bg_fixed'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_fixed',
    array(
        'label' => esc_html__('Enable Fixed BG', 'bigbulletin'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_bg_overlay',
    array(
        'default' => $bigbulletin_default['ed_header_bg_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_overlay',
    array(
        'label' => esc_html__('Enable BG Overlay', 'bigbulletin'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

// Trending News Section
$wp_customize->add_section( 'header_news_section',
    array(
    'title'      => esc_html__( 'Main Navigation Area', 'bigbulletin' ),
    'priority'   => 15,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('ed_header_trending_news',
    array(
        'default' => $bigbulletin_default['ed_header_trending_news'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'bigbulletin_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_trending_news',
    array(
        'label' => esc_html__('Enable Trending News', 'bigbulletin'),
        'section' => 'header_news_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_trending_posts_title',
    array(
    'default'           => $bigbulletin_default['ed_header_trending_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_trending_posts_title',
    array(
    'label'       => esc_html__( 'Trending News Title', 'bigbulletin' ),
    'section'     => 'header_news_section',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'bigbulletin_header_trending_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'bigbulletin_sanitize_select',
    )
);
$wp_customize->add_control( 'bigbulletin_header_trending_cat',
    array(
    'label'       => esc_html__( 'Trending News Posts Category', 'bigbulletin' ),
    'section'     => 'header_news_section',
    'type'        => 'select',
    'choices'     => $bigbulletin_post_category_list,
    )
);