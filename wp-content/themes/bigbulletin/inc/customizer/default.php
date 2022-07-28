<?php
/**
 * Default Values.
 *
 * @package BigBulletin
 */

if (!function_exists('bigbulletin_get_default_theme_options')) :

    /**
     * Get default theme options
     *
     * @return array Default theme options.
     * @since 1.0.0
     *
     */
    function bigbulletin_get_default_theme_options(){

        $bigbulletin_defaults = array();

        $bigbulletin_defaults['twp_bigbulletin_home_sections_5'] = array(

            array(
                'home_section_type' => 'main-banner',
                'section_ed' => 'yes',
                'home_section_title_4' => esc_html__('Column Title One','bigbulletin'),
                'home_section_title_3' => esc_html__('Column Title Two','bigbulletin'),
                'section_post_cat_1' => '',
                'ed_arrows_carousel' => 'yes',
                'ed_dots_carousel' => 'no',
                'section_category_3' => '',
            ),
            array(
                'home_section_type' => 'grid-list-block',
                'section_ed' => 'yes',
                'home_section_title_4' => esc_html__('Column Title One','bigbulletin'),
                'home_section_title_3' => esc_html__('Column Title Two','bigbulletin'),
                'section_post_cat_3' => '',
                'section_post_cat_4' => '',
            ),
            array(
                'home_section_type' => 'tiles-blocks',
                'section_ed' => 'yes',
                'section_category' => '',
                'tiles_post_per_page' => 5,
            ),
            array(
                'home_section_type' => 'banner-blocks-1',
                'section_ed' => 'no',
                'section_category_1' => '',
                'section_category_2' => '',
                'ed_flip_column' => 'no',
                'ed_tab' => 'no',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
                'home_section_title_1' => esc_html__('Block Title One','bigbulletin'),
                'home_section_title_2' => esc_html__('Block Title Tab','bigbulletin'),
            ),
            array(
                'home_section_type' => 'latest-posts-blocks',
                'section_ed' => 'yes',
            ),
            array(
                'home_section_type' => 'advertise-blocks',
                'section_ed' => 'no',
                'advertise_image' => '',
                'advertise_link' => '',
            ),
            array(
                'home_section_type' => 'home-widget-area',
                'section_ed' => 'yes',
            ),
            array(
                'home_section_type' => 'you-may-like-blocks',
                'home_section_title' => esc_html__('You May Like','bigbulletin'),
                'section_ed' => 'yes',
                'home_section_title' => '',
                'section_category' => '',
            ),
        );

        // header section
        $bigbulletin_defaults['logo_width_range']      = 300;
        $bigbulletin_defaults['site_title_font_size']  = 52;

        $bigbulletin_defaults['asidebar_section_tab_title_1'] = esc_html__('Popular News', 'bigbulletin');
        $bigbulletin_defaults['asidebar_section_tab_title_2'] = esc_html__('Popular News', 'bigbulletin');
        $bigbulletin_defaults['hide_asidebar_on_mobile'] = '';

        // Options.
        $bigbulletin_defaults['global_sidebar_layout'] = 'left-sidebar';
        $bigbulletin_defaults['bigbulletin_archive_layout'] = 'grid';
        $bigbulletin_defaults['bigbulletin_pagination_layout'] = 'numeric';
        $bigbulletin_defaults['footer_column_layout'] = 3;
        $bigbulletin_defaults['footer_copyright_text'] = esc_html__('All rights reserved.', 'bigbulletin');
        $bigbulletin_defaults['ed_ticker_slider_autoplay'] = 1;
        $bigbulletin_defaults['ed_header_trending_news'] = 1;
        $bigbulletin_defaults['ed_header_trending_posts_title'] = esc_html__('Trending News', 'bigbulletin');
        $bigbulletin_defaults['ed_header_ad'] = 0;
        $bigbulletin_defaults['ed_header_ticker_posts'] = 1;
        $bigbulletin_defaults['ticker_date_format'] = 'l, F jS, Y';
        $bigbulletin_defaults['ed_header_ticker_posts_title'] = esc_html__('Breaking News', 'bigbulletin');
        $bigbulletin_defaults['ed_image_content_inverse'] = 0;
        $bigbulletin_defaults['ed_related_post'] = 1;
        $bigbulletin_defaults['related_post_title'] = esc_html__('More Stories', 'bigbulletin');
        $bigbulletin_defaults['twp_navigation_type'] = 'norma-navigation';
        $bigbulletin_defaults['bigbulletin_single_post_layout'] = 'layout-1';
        $bigbulletin_defaults['ed_post_thumbnail'] = 0;
        $bigbulletin_defaults['ed_post_date'] = 1;
        $bigbulletin_defaults['ed_post_category'] = 1;
        $bigbulletin_defaults['ed_header_overlay'] = 0;
        $bigbulletin_defaults['ed_floating_next_previous_nav'] = 1;
        $bigbulletin_defaults['bigbulletin_header_bg_size'] = 1;
        $bigbulletin_defaults['ed_header_bg_fixed'] = 0;
        $bigbulletin_defaults['ed_header_bg_overlay'] = 0;
        $bigbulletin_defaults['post_date_format'] = 'default';
        $bigbulletin_defaults['ed_fullwidth_layout'] = 'default';
        $bigbulletin_defaults['ed_post_views'] = 0;
        $bigbulletin_defaults['ed_scroll_top_button'] = 1;

        $bigbulletin_defaults['ed_ticker_bar']                  = 1;
        $bigbulletin_defaults['ed_ticker_bar_date']             = 1;
        $bigbulletin_defaults['ed_tags_wide_layout']            = 1;
        $bigbulletin_defaults['ed_post_tags']                   = 1;
        $bigbulletin_defaults['ed_post_read_later']             = 1;
        $bigbulletin_defaults['ed_ticker_bar_social_nav']       = 1;

        $bigbulletin_defaults['bigbulletin_general_color']            = '#404040';
        $bigbulletin_defaults['bigbulletin_link_color']            = '#000000';

        // Pass through filter.
        $bigbulletin_defaults = apply_filters('bigbulletin_filter_default_theme_options', $bigbulletin_defaults);

        return $bigbulletin_defaults;

    }

endif;
