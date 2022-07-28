<?php
/**
 * Custom Functions.
 *
 * @package BigBulletin
 */

if (!function_exists('bigbulletin_fonts_url')) :

    //Google Fonts URL
    function bigbulletin_fonts_url()
    {

        $font_families = array(
            'Inter:wght@100;200;300;400;500;600;700;800;900',
            'Roboto:wght@100;300;400;500;700;900',
        );

        $fonts_url = add_query_arg(array(
            'family' => implode('&family=', $font_families),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2');

        return esc_url_raw($fonts_url);
    }

endif;

if (!function_exists('bigbulletin_sanitize_sidebar_option_meta')) :

    // Sidebar Option Sanitize.
    function bigbulletin_sanitize_sidebar_option_meta($input)
    {

        $metabox_options = array('global-sidebar', 'left-sidebar', 'right-sidebar', 'no-sidebar');
        if (in_array($input, $metabox_options)) {

            return $input;

        } else {

            return '';

        }
    }

endif;

if (!function_exists('bigbulletin_page_lists')) :

    // Page List.
    function bigbulletin_page_lists()
    {

        $page_lists = array();
        $page_lists[''] = esc_html__('-- Select Page --', 'bigbulletin');
        $pages = get_pages(
            array(
                'parent' => 0, // replaces 'depth' => 1,
            )
        );
        foreach ($pages as $page) {

            $page_lists[$page->ID] = $page->post_title;

        }
        return $page_lists;
    }

endif;

if (!function_exists('bigbulletin_sanitize_post_layout_option_meta')) :

    // Sidebar Option Sanitize.
    function bigbulletin_sanitize_post_layout_option_meta($input)
    {

        $metabox_options = array('global-layout', 'layout-1', 'layout-2');
        if (in_array($input, $metabox_options)) {

            return $input;

        } else {

            return '';

        }

    }

endif;

if (!function_exists('bigbulletin_sanitize_header_overlay_option_meta')) :

    // Sidebar Option Sanitize.
    function bigbulletin_sanitize_header_overlay_option_meta($input)
    {

        $metabox_options = array('global-layout', 'enable-overlay');
        if (in_array($input, $metabox_options)) {

            return $input;

        } else {

            return '';

        }

    }

endif;

/**
 * BigBulletin SVG Icon helper functions
 *
 * @package BigBulletin
 * @since 1.0.0
 */
if (!function_exists('bigbulletin_theme_svg')):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the BigBulletin_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function bigbulletin_theme_svg($svg_name, $return = false)
    {

        if ($return) {

            return bigbulletin_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in bigbulletin_get_theme_svg();.

        } else {

            echo bigbulletin_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in bigbulletin_get_theme_svg();.

        }
    }

endif;

if (!function_exists('bigbulletin_get_theme_svg')):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function bigbulletin_get_theme_svg($svg_name)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            BigBulletin_SVG_Icons::get_svg($svg_name),
            array(
                'svg' => array(
                    'class' => true,
                    'xmlns' => true,
                    'width' => true,
                    'height' => true,
                    'viewbox' => true,
                    'aria-hidden' => true,
                    'role' => true,
                    'focusable' => true,
                ),
                'path' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'd' => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'points' => true,
                    'transform' => true,
                    'focusable' => true,
                ),

                'line' => array(
                    'stroke' => true,
                    'x1' => true,
                    'x2' => true,
                    'y1' => true,
                    'y2' => true,
                ),
            )
        );
        if (!$svg) {
            return false;
        }
        return $svg;

    }

endif;

if (!function_exists('bigbulletin_svg_escape')):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function bigbulletin_svg_escape($input)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg' => array(
                    'class' => true,
                    'xmlns' => true,
                    'width' => true,
                    'height' => true,
                    'viewbox' => true,
                    'aria-hidden' => true,
                    'role' => true,
                    'focusable' => true,
                ),
                'path' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'd' => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'points' => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if (!$svg) {
            return false;
        }

        return $svg;

    }

endif;

if (!function_exists('bigbulletin_social_menu_icon')) :

    function bigbulletin_social_menu_icon($item_output, $item, $depth, $args)
    {

        // Add Icon
        if (isset($args->theme_location) && 'bigbulletin-social-menu' === $args->theme_location) {

            $svg = BigBulletin_SVG_Icons::get_theme_svg_name($item->url);

            if (empty($svg)) {
                $svg = bigbulletin_theme_svg('link', $return = true);
            }

            $item_output = str_replace($args->link_after, '</span>' . $svg, $item_output);
        }

        return $item_output;
    }

endif;

add_filter('walker_nav_menu_start_el', 'bigbulletin_social_menu_icon', 10, 4);

if (!function_exists('bigbulletin_sub_menu_toggle_button')) :

    function bigbulletin_sub_menu_toggle_button($args, $item, $depth)
    {

        // Add sub menu toggles to the main menu with toggles
        if ($args->theme_location == 'bigbulletin-primary-menu' && isset($args->show_toggles)) {
            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after = '';
            // Add a toggle to items with children
            if (in_array('menu-item-has-children', $item->classes)) {
                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';
                // Add the sub menu toggle
                $args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __('Show sub menu', 'bigbulletin') . '</span>' . bigbulletin_get_theme_svg('chevron-down') . '</span></button>';
            }
            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)
        } elseif ($args->theme_location == 'bigbulletin-primary-menu') {
            if (in_array('menu-item-has-children', $item->classes)) {
                $args->before = '<div class="link-icon-wrapper">';
                $args->after = bigbulletin_get_theme_svg('chevron-down') . '</div>';
            } else {
                $args->before = '';
                $args->after = '';
            }
        }
        return $args;

    }

    add_filter('nav_menu_item_args', 'bigbulletin_sub_menu_toggle_button', 10, 3);

endif;

if (!function_exists('bigbulletin_post_category_list')) :

    // Post Category List.
    function bigbulletin_post_category_list($select_cat = true)
    {

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if ($select_cat) {

            $post_cat_cat_array[''] = esc_html__('Select Category', 'bigbulletin');

        }

        foreach ($post_cat_lists as $post_cat_list) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if (!function_exists('bigbulletin_sanitize_meta_pagination')):

    /** Sanitize Enable Disable Checkbox **/
    function bigbulletin_sanitize_meta_pagination($input)
    {

        $valid_keys = array('global-layout', 'no-navigation', 'norma-navigation', 'ajax-next-post-load');
        if (in_array($input, $valid_keys)) {
            return $input;
        }
        return '';

    }

endif;

if (!function_exists('bigbulletin_disable_post_views')):

    /** Disable Post Views **/
    function bigbulletin_disable_post_views()
    {

        add_filter('booster_extension_filter_views_ed', 'bigbulletin_disable_views_ed');

    }

endif;

if (!function_exists('bigbulletin_disable_views_ed')):

    /** Disable Reaction **/
    function bigbulletin_disable_views_ed()
    {

        return false;

    }

endif;

if (!function_exists('bigbulletin_disable_post_read_time')):

    /** Disable Read Time **/
    function bigbulletin_disable_post_read_time()
    {

        add_filter('booster_extension_filter_readtime_ed', 'bigbulletin_disable_read_time');

    }

endif;

if (!function_exists('bigbulletin_disable_read_time')):

    /** Disable Reaction **/
    function bigbulletin_disable_read_time()
    {

        return false;

    }

endif;

if (!function_exists('bigbulletin_disable_post_like_dislike')):

    /** Disable Like Dislike **/
    function bigbulletin_disable_post_like_dislike()
    {

        add_filter('booster_extension_filter_like_ed', 'bigbulletin_disable_like_ed');

    }

endif;

if (!function_exists('bigbulletin_disable_like_ed')):

    /** Disable Reaction **/
    function bigbulletin_disable_like_ed()
    {

        return false;

    }

endif;

if (!function_exists('bigbulletin_disable_post_author_box')):

    /** Disable Author Box **/
    function bigbulletin_disable_post_author_box()
    {

        add_filter('booster_extension_filter_ab_ed', 'bigbulletin_disable_ab_ed');

    }

endif;

if (!function_exists('bigbulletin_disable_ab_ed')):

    /** Disable Reaction **/
    function bigbulletin_disable_ab_ed()
    {

        return false;

    }

endif;

add_filter('booster_extension_filter_ss_ed', 'bigbulletin_disable_social_share');

if (!function_exists('bigbulletin_disable_social_share')):

    /** Disable Reaction **/
    function bigbulletin_disable_social_share()
    {

        return false;

    }

endif;

if (!function_exists('bigbulletin_disable_post_reaction')):

    /** Disable Reaction **/
    function bigbulletin_disable_post_reaction()
    {

        add_filter('booster_extension_filter_reaction_ed', 'bigbulletin_disable_reaction_cb');

    }

endif;

if (!function_exists('bigbulletin_disable_reaction_cb')):

    /** Disable Reaction **/
    function bigbulletin_disable_reaction_cb()
    {

        return false;

    }

endif;

if (!function_exists('bigbulletin_header_ad')):

    function bigbulletin_header_ad()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $ed_header_ad = get_theme_mod('ed_header_ad', $bigbulletin_default['ed_header_ad']);
        $header_ad_image = get_theme_mod('header_ad_image');
        $ed_header_link = get_theme_mod('ed_header_link');

        if ($ed_header_ad) {

            ?>

            <div class="theme-header-ads">
                <div class="wrapper">
                    <?php if ($header_ad_image) { ?>
                        <a target="_blank" href="<?php echo esc_url($ed_header_link); ?>">
                            <img src="<?php echo esc_url($header_ad_image); ?>"
                                 title="<?php esc_attr_e('Header AD Image', 'bigbulletin'); ?>"
                                 alt="<?php esc_attr_e('Header AD Image', 'bigbulletin'); ?>"/>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <?php

        }
    }

endif;

if (!function_exists('bigbulletin_post_floating_nav')):

    function bigbulletin_post_floating_nav()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod('ed_floating_next_previous_nav', $bigbulletin_default['ed_floating_next_previous_nav']);

        if ('post' === get_post_type() && $ed_floating_next_previous_nav) {

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if (isset($prev_post->ID)) {

                $prev_link = get_permalink($prev_post->ID); ?>

                <div class="floating-post-navigation floating-navigation-prev">
                    <?php if (get_the_post_thumbnail($prev_post->ID, 'medium')) { ?>
                        <?php echo wp_kses_post(get_the_post_thumbnail($prev_post->ID, 'medium')); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url($prev_link); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'bigbulletin'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
                    </a>
                </div>

            <?php }

            if (isset($next_post->ID)) {

                $next_link = get_permalink($next_post->ID); ?>

                <div class="floating-post-navigation floating-navigation-next">
                    <?php if (get_the_post_thumbnail($next_post->ID, 'medium')) { ?>
                        <?php echo wp_kses_post(get_the_post_thumbnail($next_post->ID, 'medium')); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url($next_link); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'bigbulletin'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
                    </a>
                </div>

                <?php
            }

        }

    }

endif;

add_action('bigbulletin_navigation_action', 'bigbulletin_post_floating_nav', 10);

if (!function_exists('bigbulletin_single_post_navigation')):

    function bigbulletin_single_post_navigation()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $twp_navigation_type = esc_attr(get_post_meta(get_the_ID(), 'twp_disable_ajax_load_next_post', true));
        $bigbulletin_header_trending_page = get_theme_mod('bigbulletin_header_trending_page');
        $bigbulletin_header_popular_page = get_theme_mod('bigbulletin_header_popular_page');
        $bigbulletin_archive_layout = esc_attr(get_theme_mod('bigbulletin_archive_layout', $bigbulletin_default['bigbulletin_archive_layout']));
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if ($twp_navigation_type == '' || $twp_navigation_type == 'global-layout') {
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $bigbulletin_default['twp_navigation_type']);
        }

        if ($bigbulletin_header_trending_page != $current_id && $bigbulletin_header_popular_page != $current_id) {

            if ($twp_navigation_type != 'no-navigation' && 'post' === get_post_type()) {

                if ($twp_navigation_type == 'norma-navigation') { ?>

                    <div class="navigation-wrapper">
                        <?php
                        // Previous/next post navigation.
                        the_post_navigation(array(
                            'prev_text' => '<span class="arrow" aria-hidden="true">' . bigbulletin_theme_svg('arrow-left', $return = true) . '</span><span class="screen-reader-text">' . __('Previous post:', 'bigbulletin') . '</span><span class="post-title">%title</span>',
                            'next_text' => '<span class="arrow" aria-hidden="true">' . bigbulletin_theme_svg('arrow-right', $return = true) . '</span><span class="screen-reader-text">' . __('Next post:', 'bigbulletin') . '</span><span class="post-title">%title</span>',
                        )); ?>
                    </div>
                    <?php

                } else {

                    $next_post = get_next_post();
                    if (isset($next_post->ID)) {

                        $next_post_id = $next_post->ID;
                        echo '<div loop-count="1" next-post="' . absint($next_post_id) . '" class="twp-single-infinity"></div>';

                    }
                }

            }

        }

    }

endif;

add_action('bigbulletin_navigation_action', 'bigbulletin_single_post_navigation', 30);

if (!function_exists('bigbulletin_header_banner')):

    function bigbulletin_header_banner()
    {

        global $post;

        if (have_posts()):

            while (have_posts()) :
                the_post();

                global $post;

            endwhile;

        endif;

        $bigbulletin_post_layout = '';
        $bigbulletin_default = bigbulletin_get_default_theme_options();

        if (is_singular()) {

            $bigbulletin_post_layout = esc_html(get_post_meta($post->ID, 'bigbulletin_post_layout', true));
            if ($bigbulletin_post_layout == '' || $bigbulletin_post_layout == 'global-layout') {

                $bigbulletin_post_layout = get_theme_mod('bigbulletin_single_post_layout', $bigbulletin_default['bigbulletin_archive_layout']);
            }

        }

        if (isset($post->ID)) {

            $bigbulletin_page_layout = esc_html(get_post_meta($post->ID, 'bigbulletin_page_layout', true));

        }

        if ($bigbulletin_post_layout == 'layout-2' && is_singular('post')) {

            if (have_posts()) :

                while (have_posts()) :
                    the_post();

                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                    $bigbulletin_ed_feature_image = esc_html(get_post_meta(get_the_ID(), 'bigbulletin_ed_feature_image', true));
                    ?>

                    <div class="single-featured-banner  <?php if (empty($bigbulletin_ed_feature_image) && isset($featured_image[0]) && $featured_image[0]) {
                        echo 'banner-has-image';
                    } ?>">

                        <div class="featured-banner-content">
                            <div class="wrapper">
                                <?php
                                if (!is_404() && !is_home() && !is_front_page()) {
                                    bigbulletin_breadcrumb_with_title_block();
                                } ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        <header class="entry-header">

                                            <div class="entry-meta">
                                                <?php
                                                bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false);
                                                ?>
                                            </div>

                                            <h1 class="entry-title entry-title-large">
                                                <?php the_title(); ?>
                                            </h1>
                                        </header>
                                        <div class="entry-meta">
                                            <?php
                                            bigbulletin_posted_by();
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php if (empty($bigbulletin_ed_feature_image) && isset($featured_image[0]) && $featured_image[0]) { ?>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner thumb-overlay"
                                     data-background="<?php echo esc_url($featured_image[0]); ?>"></div>
                            </div>
                        <?php } ?>

                    </div>

                <?php
                endwhile;

                wp_reset_postdata();

            endif;

        }

        if (is_singular('page') && $bigbulletin_page_layout == 'layout-2') {

            if (have_posts()) :

                while (have_posts()) :

                    the_post();

                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');

                    $bigbulletin_ed_feature_image = esc_html(get_post_meta(get_the_ID(), 'bigbulletin_ed_feature_image', true));
                    ?>

                    <div class="single-featured-banner  <?php if (empty($bigbulletin_ed_feature_image) && isset($featured_image[0]) && $featured_image[0]) {
                        echo 'banner-has-image';
                    } ?>">

                        <div class="featured-banner-content">
                            <div class="wrapper">
                                <?php
                                if (!is_404() && !is_home() && !is_front_page()) {
                                    bigbulletin_breadcrumb_with_title_block();
                                } ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        <header class="entry-header">

                                            <h1 class="entry-title entry-title-large">
                                                <?php the_title(); ?>
                                            </h1>
                                        </header>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php if (empty($bigbulletin_ed_feature_image) && isset($featured_image[0]) && $featured_image[0]) { ?>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner"
                                     data-background="<?php echo esc_url($featured_image[0]); ?>"></div>
                            </div>
                        <?php } ?>

                    </div>

                <?php
                endwhile;

                wp_reset_postdata();

            endif;

        }

    }

endif;

if (!function_exists('bigbulletin_header_toggle_search')):

    /**
     * Header Search
     **/
    function bigbulletin_header_toggle_search()
    { ?>

        <div class="header-searchbar">
            <div class="header-searchbar-inner">
                <div class="wrapper-fluid">
                    <div class="header-searchbar-panel">

                        <div class="header-searchbar-area">
                            <a class="skip-link-search-top" href="javascript:void(0)"></a>
                            <?php get_search_form(); ?>
                        </div>

                        <button type="button" id="search-closer" class="close-popup">
                            <?php bigbulletin_theme_svg('cross'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

endif;

add_action('bigbulletin_before_footer_content_action', 'bigbulletin_header_toggle_search', 10);

if (!function_exists('bigbulletin_theme_date_time')):

    function bigbulletin_theme_date_time()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options(); ?>

        <div id="theme-extrabar" class="theme-navextras">

            <?php bigbulletin_extra_area_render(); ?>

        </div>

        <?php
    }

endif;

if (!function_exists('bigbulletin_extra_area_render')):

    function bigbulletin_extra_area_render($render = true)
    {

        ob_start();

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $ed_ticker_bar = get_theme_mod('ed_ticker_bar', $bigbulletin_default['ed_ticker_bar']);
        $ed_ticker_bar_date = get_theme_mod('ed_ticker_bar_date', $bigbulletin_default['ed_ticker_bar_date']);
        $ticker_date_format = get_theme_mod('ticker_date_format', $bigbulletin_default['ticker_date_format']);

        if ($ed_ticker_bar && (has_nav_menu('bigbulletin-social-menu') || $ed_ticker_bar_date)) { ?>

            <div class="data-time-panel">
                <?php
                if ($ed_ticker_bar_date) {
                    ?>
                    <div class="theme-navextras-item theme-navextras-date">
                        <span class="theme-navextras-icon"><?php bigbulletin_theme_svg('calendar-full'); ?></span>
                        <span class="theme-navextras-label"><?php echo esc_html(date(esc_attr($ticker_date_format))); ?></span>
                    </div>
                <?php } ?>

                <div class="theme-navextras-item theme-navextras-clock">
                    <span class="theme-navextras-icon"><?php bigbulletin_theme_svg('clock'); ?></span>
                    <span class="theme-navextras-label"><span id="twp-time-clock"></span></span>
                </div>

            </div>

            <?php
        }

        $html = ob_get_contents();
        ob_get_clean();

        if ($render) {

            echo $html;

        } else {

            return $html;

        }

    }

endif;

if (!function_exists('bigbulletin_content_offcanvas')):

    // Offcanvas Contents
    function bigbulletin_content_offcanvas()
    {

        $responsive_content = false;
        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $ed_ticker_bar = get_theme_mod('ed_ticker_bar', $bigbulletin_default['ed_ticker_bar']);
        $ed_ticker_bar_date = get_theme_mod('ed_ticker_bar_date', $bigbulletin_default['ed_ticker_bar_date']);

        if ($ed_ticker_bar && (has_nav_menu('bigbulletin-social-menu') || $ed_ticker_bar_date)) {

            $responsive_content = true;

        }
        ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">

                <div class="close-offcanvas-menu">

                    <a class="skip-link-off-canvas" href="javascript:void(0)"></a>

                    <div class="offcanvas-close">

                        <?php if ($responsive_content) { ?>
                            <div class="responsive-date-clock">
                                <div class="responsive-content-date"></div>

                                <div class="theme-navextras-item theme-navextras-clock">
                                    <span class="theme-navextras-icon"><?php bigbulletin_theme_svg('clock'); ?></span>
                                    <span class="theme-navextras-label">
                                        <span id="twp-time-clock"></span>
                                    </span>
                                </div>

                            </div>
                        <?php } ?>

                        <button type="button" class="button-offcanvas-close">

                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'bigbulletin'); ?>
                            </span>

                            <span class="bars">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </span>

                        </button>

                    </div>
                </div>

                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper">
                        <ul class="primary-menu theme-menu">

                            <?php
                            if (has_nav_menu('bigbulletin-primary-menu')) {

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'bigbulletin-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );

                            } else {

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new BigBulletin_Walker_Page(),
                                    )
                                );

                            } ?>

                        </ul>
                    </nav>
                </div>

                <?php if (has_nav_menu('bigbulletin-social-menu')) { ?>

                    <div id="social-nav-offcanvas" class="offcanvas-item offcanvas-social-navigation">

                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'bigbulletin-social-menu',
                                'link_before' => '<span class="screen-reader-text">',
                                'link_after' => '</span>',
                                'container' => 'div',
                                'container_class' => 'bigbulletin-social-menu',
                                'depth' => 1,
                            )
                        ); ?>

                    </div>

                <?php }

                if ($responsive_content) { ?>
                    <div class="responsive-content-menu">

                    </div>
                <?php } ?>

                <a class="skip-link-offcanvas screen-reader-text" href="javascript:void(0)"></a>

            </div>
        </div>

        <?php
    }

endif;

add_action('bigbulletin_before_footer_content_action', 'bigbulletin_content_offcanvas', 30);

if (!function_exists('bigbulletin_content_trending_news_render')):

    function bigbulletin_content_trending_news_render()
    {

        $bigbulletin_header_trending_cat = get_theme_mod('bigbulletin_header_trending_cat');
        $trending_news_query = new WP_Query(
            array(
                'post_type' => 'post',
                'posts_per_page' => 9,
                'post__not_in' => get_option("sticky_posts"),
                'category_name' => $bigbulletin_header_trending_cat,
            )
        );

        if ($trending_news_query->have_posts()): ?>

            <div class="trending-news-main-wrap">
                <div class="wrapper-fluid">
                    <div class="column-row">

                        <a href="javascript:void(0)" class="bigbulletin-skip-link-start"></a>

                        <div class="column column-12">
                            <button type="button" id="trending-collapse">
                                <?php bigbulletin_theme_svg('cross'); ?>
                            </button>
                        </div>

                        <?php
                        while ($trending_news_query->have_posts()) {
                            $trending_news_query->the_post();

                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                            <div class="column column-4 column-sm-6 column-xs-12">

                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article mb-20'); ?>>
                                    <div class="column-row column-row-small">

                                        <?php if ($featured_image) { ?>

                                            <div class="column column-4">

                                                <div class="data-bg data-bg-thumbnail"
                                                     data-background="<?php echo esc_url($featured_image); ?>">

                                                    <a class="img-link" href="<?php the_permalink(); ?>"
                                                       tabindex="0"></a>

                                                </div>

                                            </div>

                                        <?php } ?>

                                        <div class="column column-<?php if ($featured_image) { ?>8<?php } else { ?>12<?php } ?>">
                                            <div class="article-content">

                                                <h3 class="entry-title entry-title-small">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                       title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h3>

                                                <div class="entry-meta">
                                                    <?php bigbulletin_posted_on($icon = true); ?>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </article>
                            </div>
                            <?php

                        } ?>

                        <a href="javascript:void(0)" class="bigbulletin-skip-link-end"></a>

                    </div>
                </div>
            </div>

            <?php
            wp_reset_postdata();

        endif;
    }

endif;

if (!function_exists('bigbulletin_footer_content_widget')):

    function bigbulletin_footer_content_widget()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        if (is_active_sidebar('bigbulletin-footer-widget-0') ||
            is_active_sidebar('bigbulletin-footer-widget-1') ||
            is_active_sidebar('bigbulletin-footer-widget-2')):
            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 4 && is_active_sidebar('bigbulletin-footer-widget-3')) {
                    $footer_sidebar++;
                }
                if ($x == 3 && is_active_sidebar('bigbulletin-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('bigbulletin-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('bigbulletin-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 4);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } elseif ($footer_sidebar == 3) {
                $footer_sidebar_class = 4;
            } else {
                $footer_sidebar_class = 3;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $bigbulletin_default['footer_column_layout'])); ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">
                        <?php if (is_active_sidebar('bigbulletin-footer-widget-0')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-md-12 column-sm-12 column-xs-12">
                                <?php dynamic_sidebar('bigbulletin-footer-widget-0'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('bigbulletin-footer-widget-1')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-md-12 column-sm-12 column-xs-12">
                                <?php dynamic_sidebar('bigbulletin-footer-widget-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('bigbulletin-footer-widget-2')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-md-12 column-sm-12 column-xs-12">
                                <?php dynamic_sidebar('bigbulletin-footer-widget-2'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('bigbulletin-footer-widget-3')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-md-12 column-sm-12 column-xs-12">
                                <?php dynamic_sidebar('bigbulletin-footer-widget-3'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        endif;

    }

endif;

add_action('bigbulletin_footer_content_action', 'bigbulletin_footer_content_widget', 10);

if (!function_exists('bigbulletin_footer_content_info')):

    /**
     * Footer Copyright Area
     **/
    function bigbulletin_footer_content_info()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options(); ?>
        <div class="footer-navarea">
            <div class="wrapper">
                <div class="column-row">
                    <?php
                    if (has_nav_menu('bigbulletin-social-menu')) { ?>
                        <div class="column column-8 column-sm-12">
                            <div class="footer-social-navigation">
                                <?php
                                wp_nav_menu(

                                    array(
                                        'theme_location' => 'bigbulletin-social-menu',
                                        'link_before' => '<span class="screen-reader-text">',
                                        'link_after' => '</span>',
                                        'container' => 'div',
                                        'container_class' => 'bigbulletin-social-menu',
                                        'depth' => 1,
                                    )

                                ); ?>

                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-8 column-sm-12">
                        <div class="footer-copyright">
                            <?php
                            $footer_copyright_text = wp_kses_post(get_theme_mod('footer_copyright_text', $bigbulletin_default['footer_copyright_text']));
                            echo esc_html__('Copyright ', 'bigbulletin') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html(get_bloginfo('name', 'display')) . '. </span></a> ' . esc_html($footer_copyright_text);

                            echo '<br>';
                            echo esc_html__('Theme: ', 'bigbulletin') . 'BigBulletin ' . esc_html__('By ', 'bigbulletin') . '<a href="' . esc_url('https://www.themeinwp.com/theme/bigbulletin') . '"  title="' . esc_attr__('Themeinwp', 'bigbulletin') . '" target="_blank" rel="author"><span>' . esc_html__('Themeinwp. ', 'bigbulletin') . '</span></a>';
                            echo esc_html__('Powered by ', 'bigbulletin') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'bigbulletin') . '" target="_blank"><span>' . esc_html__('WordPress.', 'bigbulletin') . '</span></a>';

                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <?php bigbulletin_footer_go_to_top(); ?>
        </div>

        <?php
    }

endif;

add_action('bigbulletin_footer_content_action', 'bigbulletin_footer_content_info', 20);

if (!function_exists('bigbulletin_footer_go_to_top')):

    // Scroll to Top render content
    function bigbulletin_footer_go_to_top()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $ed_scroll_top_button = get_theme_mod('ed_scroll_top_button', $bigbulletin_default['ed_scroll_top_button']);

        if ($ed_scroll_top_button) {

            ?>

            <div class="hide-no-js">
                <button type="button" class="scroll-up">
                    <?php bigbulletin_theme_svg('chevron-up'); ?>
                </button>
            </div>

            <?php

        }

    }

endif;

if (!function_exists('bigbulletin_post_view_count')):

    function bigbulletin_post_view_count()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $ed_post_views = get_theme_mod('ed_post_views', $bigbulletin_default['ed_post_views']);
        $twp_be_settings = get_option('twp_be_options_settings');
        $twp_be_enable_post_visit_tracking = isset($twp_be_settings['twp_be_enable_post_visit_tracking']) ? esc_html($twp_be_settings['twp_be_enable_post_visit_tracking']) : '';
        if ($twp_be_enable_post_visit_tracking && class_exists('Booster_Extension_Class')): ?>

            <div class="entry-meta-item entry-meta-views">
                <span class="entry-meta-icon views-icon">
                    <?php bigbulletin_theme_svg('viewer'); ?>
                </span>
                <a href="<?php the_permalink(); ?>">
                    <span class="post-view-count">
                       <?php
                       echo do_shortcode('[booster-extension-visit-count count_only="count" label="' . esc_html__('Views', 'bigbulletin') . '"]');
                       ?>
                    </span>
                </a>
            </div>

        <?php
        endif;
    }
endif;

if (!function_exists('bigbulletin_post_like_dislike')):

    function bigbulletin_post_like_dislike()
    {

        $bigbulletin_ed_post_like_dislike = esc_html(get_post_meta(get_the_ID(), 'bigbulletin_ed_post_like_dislike', true));
        if (class_exists('Booster_Extension_Class') && !$bigbulletin_ed_post_like_dislike): ?>

            <div class="entry-meta-item entry-meta-like-dislike">
                <?php echo do_shortcode('[booster-extension-like-dislike]'); ?>
            </div>

        <?php
        endif;
    }
endif;

add_action('wp_ajax_bigbulletin_tab_posts_callback', 'bigbulletin_tab_posts_callback');
add_action('wp_ajax_nopriv_bigbulletin_tab_posts_callback', 'bigbulletin_tab_posts_callback');

if (!function_exists('bigbulletin_tab_posts_callback')):
    // Masonry Post Ajax Call Function.

    function bigbulletin_tab_posts_callback()
    {

        if (isset($_POST['_wpnonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_wpnonce'])), 'bigbulletin_ajax_nonce') && isset($_POST['category'])) {

            $category = sanitize_text_field(wp_unslash($_POST['category']));

            $tab_post_query = new WP_Query(
                array(
                    'post_type' => 'post',
                    'posts_per_page' => 2,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html($category),
                    'post_status' => 'publish'
                )
            );

            $tab_post_query_1 = new WP_Query(
                array(
                    'post_type' => 'post',
                    'posts_per_page' => 2,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html($category),
                    'post_status' => 'publish'
                )
            );

            if ($tab_post_query->have_posts()): ?>

                <div class="column-row">
                    <div class="column column-12 column-xs-12">
                        <?php
                        $post_count = 1;
                        while ($tab_post_query->have_posts()) {
                            $tab_post_query->the_post();

                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-bg news-article-bg-1 news-article-panel'); ?>>
                                <div class="data-bg data-bg-medium " data-background="<?php echo esc_url($featured_image); ?>">
                                    <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                </div>

                                <div class="article-content">
                                    <div class="entry-meta">
                                        <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                    </div>
                                    <h3 class="entry-title entry-title-medium">
                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                           title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                </div>

                                <div class="article-content-footer">
                                    <div class="entry-meta">
                                        <?php bigbulletin_posted_by(); ?>
                                        <?php bigbulletin_post_view_count(); ?>
                                    </div>
                                </div>
                            </article>

                            <?php
                            if ($post_count == 2) {
                                break;
                            }

                            $post_count++;

                        }
                        wp_reset_postdata(); ?>

                    </div>
                </div>

                <?php
                wp_reset_postdata();

            endif;
        }

        wp_die();
    }

endif;

if (!function_exists('bigbulletin_header_ticker_posts')):

    function bigbulletin_header_ticker_posts()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $ed_header_ticker_posts = get_theme_mod('ed_header_ticker_posts', $bigbulletin_default['ed_header_ticker_posts']);
        $ed_header_ticker_posts_title = get_theme_mod('ed_header_ticker_posts_title', $bigbulletin_default['ed_header_ticker_posts_title']);
        $bigbulletin_header_ticker_cat = get_theme_mod('bigbulletin_header_ticker_cat');
        $slider_autoplay = get_theme_mod('ed_ticker_slider_autoplay', $bigbulletin_default['ed_ticker_slider_autoplay']);

        if ($slider_autoplay) {
            $autoplay = 'true';
        } else {
            $autoplay = 'false';
        }

        if (is_rtl()) {
            $rtl = 'right';
        } else {
            $rtl = 'left';
        }

        if ($ed_header_ticker_posts) { ?>

            <div class="theme-ticker-area hide-no-js">
                <?php if ($ed_header_ticker_posts_title) { ?>
                    <div class="theme-ticker-components theme-ticker-left">
                        <div class="theme-ticker-title">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.25em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 640 512"><path fill="currentColor" d="M634.91 154.88C457.74-8.99 182.19-8.93 5.09 154.88c-6.66 6.16-6.79 16.59-.35 22.98l34.24 33.97c6.14 6.1 16.02 6.23 22.4.38c145.92-133.68 371.3-133.71 517.25 0c6.38 5.85 16.26 5.71 22.4-.38l34.24-33.97c6.43-6.39 6.3-16.82-.36-22.98zM320 352c-35.35 0-64 28.65-64 64s28.65 64 64 64s64-28.65 64-64s-28.65-64-64-64zm202.67-83.59c-115.26-101.93-290.21-101.82-405.34 0c-6.9 6.1-7.12 16.69-.57 23.15l34.44 33.99c6 5.92 15.66 6.32 22.05.8c83.95-72.57 209.74-72.41 293.49 0c6.39 5.52 16.05 5.13 22.05-.8l34.44-33.99c6.56-6.46 6.33-17.06-.56-23.15z"/></svg>
                            <span class="ticker-title-part ticker-title-label">
                                <?php echo esc_html($ed_header_ticker_posts_title); ?>
                            </span>
                        </div>
                    </div>
                <?php } ?>

                <?php
                $ticker_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($bigbulletin_header_ticker_cat)));

                if ($ticker_posts_query->have_posts()): ?>

                    <div class="theme-ticker-component theme-ticker-right">
                        <div class="ticker-slides" data-direction="left" data-direction='<?php echo esc_attr($rtl); ?>'>
                            <?php
                            while ($ticker_posts_query->have_posts()):
                                $ticker_posts_query->the_post(); ?>

                                <a class="ticker-slides-item" href="<?php the_permalink(); ?>" tabindex="0"
                                   rel="bookmark" title="<?php the_title_attribute(); ?>">
                                    <?php if (has_post_thumbnail()) {
                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                        <span class="data-bg ticker-data-bg"
                                              data-background="<?php echo esc_url($featured_image); ?>"></span>
                                    <?php } ?>
                                    <span class="ticker-title"><?php the_title(); ?></span>
                                </a>

                            <?php
                            endwhile; ?>
                        </div>
                    </div>

                    <?php
                    wp_reset_postdata();
                endif; ?>
            </div>

            <?php
        }

    }

endif;

if (class_exists('WooCommerce')) {

    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
    add_action('woocommerce_before_main_content', 'bigbulletin_woo_before_main_content', 5);
    add_action('woocommerce_after_main_content', 'bigbulletin_woo_after_main_content', 15);

}
if (!function_exists('bigbulletin_woo_before_main_content')):

    function bigbulletin_woo_before_main_content()
    {

        echo '<div class="wrapper">';
        echo '<div class="column-row">';

    }

endif;

if (!function_exists('bigbulletin_woo_after_main_content')):

    function bigbulletin_woo_after_main_content()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $sidebar = esc_attr(get_theme_mod('global_sidebar_layout', $bigbulletin_default['global_sidebar_layout']));
        if ($sidebar != 'no-sidebar') {

            get_sidebar();

        }

        echo '</div>';
        echo '</div>';

    }

endif;

if (!function_exists('bigbulletin_content_loading')) {

    function bigbulletin_content_loading()
    { ?>

        <div class="content-loading-status">
            <div class="theme-ajax-loader"></div>
            <div class="screen-reader-text">
                <?php esc_html_e('Content Loading', 'bigbulletin'); ?>
            </div>
        </div>

        <?php
    }
}

function bigbulletin_hex2rgb($colour, $opacity = 1)
{

    if ($colour[0] == '#') {
        $colour = substr($colour, 1);
    }
    if (strlen($colour) == 6) {
        list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
    } elseif (strlen($colour) == 3) {
        list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
    } else {
        return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';

}

if (class_exists('Booster_Extension_Class')) {

    add_filter('booster_extemsion_content_after_filter', 'bigbulletin_after_content_pagination');

}

if (!function_exists('bigbulletin_after_content_pagination')):

    function bigbulletin_after_content_pagination($after_content)
    {

        $pagination_single = wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'bigbulletin'),
            'after' => '</div>',
            'echo' => false
        ));

        $after_content = $pagination_single . $after_content;

        return $after_content;

    }

endif;

if (!function_exists('main_navigation_extras')):

    function main_navigation_extras()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $ed_header_trending_news = get_theme_mod('ed_header_trending_news', $bigbulletin_default['ed_header_trending_news']); ?>
        <div class="navbar-controls hide-no-js">

            <button type="button" class="navbar-control navbar-control-offcanvas">
                <span class="navbar-control-trigger" tabindex="-1">
                    <span class="navbar-control-info">
                        <span class="navbar-control-label">
                            <?php esc_html_e('Menu', 'bigbulletin'); ?>
                        </span>
                        <span class="navbar-control-icon">
                            <?php bigbulletin_theme_svg('menu'); ?>
                        </span>
                    </span>
                </span>
            </button>

            <button type="button" class="navbar-control navbar-control-search">
                <span class="navbar-control-trigger" tabindex="-1">
                    <span>
                        <?php bigbulletin_theme_svg('search'); ?>
                    </span>
                    <span>
                        <?php //esc_html_e('Search', 'bigbulletin'); ?>
                    </span>
                </span>
            </button>

            <?php
            if ($ed_header_trending_news) {
                $ed_header_trending_posts_title = get_theme_mod('ed_header_trending_posts_title', $bigbulletin_default['ed_header_trending_posts_title']); ?>
                <button type="button" class="navbar-control navbar-control-trending-news">
                    <span class="navbar-control-trigger" tabindex="-1">
                        <?php echo esc_html($ed_header_trending_posts_title); ?>
                    </span>
                </button>
            <?php } ?>

        </div>

        <?php
    }

endif;

add_filter('comment_form_defaults', 'bigbulletin_comment_title_callback');

if (!function_exists('bigbulletin_comment_title_callback')):

    function bigbulletin_comment_title_callback($defaults)
    {

        $defaults['title_reply_before'] = '<header class="block-title-wrapper"><h3 class="block-title">';
        $defaults['title_reply_after'] = '</h3></header>';
        return $defaults;

    }

endif;

if (class_exists('Booster_Extension_Class')):

    add_filter('booster_extension_ed_content', 'bigbulletin_read_letter_content_false');

    if (!function_exists('bigbulletin_read_letter_content_false')):

        function bigbulletin_read_letter_content_false()
        {

            return false;

        }

    endif;

    add_action('booster_extension_read_later_post_content', 'bigbulletin_readletter_content', 20);

    if (!function_exists('bigbulletin_readletter_content')):

        function bigbulletin_readletter_content()
        {

            return get_template_part('template-parts/content', get_post_format());

        }

    endif;

endif;

if (!function_exists('bigbulletin_category_pin_posts_link')):

    function bigbulletin_category_pin_posts_link()
    {

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $ed_post_read_later = get_theme_mod('ed_post_read_later', $bigbulletin_default['ed_post_read_later']);

        if ($ed_post_read_later && class_exists('Booster_Extension_Class')):

            if (function_exists('booster_extension_get_read_letter_page_id')) {
                $page_id = booster_extension_get_read_letter_page_id();

                if ($page_id) {

                    $page_link = get_page_link($page_id);
                    ?>
                    <div class="theme-navextras-item theme-navextras-bookmark">
                        <a href="<?php echo esc_url($page_link); ?>">
                            <span class="theme-navextras-icon"><?php bigbulletin_theme_svg('bookmark'); ?></span>
                            <span class="theme-navextras-label"><?php esc_html_e('Favourites', 'bigbulletin'); ?></span>
                        </a>
                    </div>
                    <?php

                }
            }

        endif;

    }

endif;

function bigbulletin_hex_2_rgba($color, $opacity = false)
{

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(a) color string
    return $output;
}

if (!function_exists('bigbulletin_asidebar_section')):

    function bigbulletin_asidebar_section()
    {
        $bigbulletin_default = bigbulletin_get_default_theme_options();

        $asidebar_section_tab_title_1 = get_theme_mod('asidebar_section_tab_title_1', $bigbulletin_default['asidebar_section_tab_title_1']);
        $asidebar_section_tab_category_1 = get_theme_mod('asidebar_section_tab_category_1');
        $asidebar_section_tab_title_2 = get_theme_mod('asidebar_section_tab_title_2', $bigbulletin_default['asidebar_section_tab_title_2']);
        $asidebar_section_tab_category_2 = get_theme_mod('asidebar_section_tab_category_2');

        if ($asidebar_section_tab_category_1) {
            $tab_section_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($asidebar_section_tab_category_1)));
        } else {
            $asidebar_section_tab_category_1 = esc_html__("Popular", 'bigbulletin');
            $tab_section_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'post__not_in' => get_option("sticky_posts"), 'orderby' => 'comment_count'));
        }
        if ($asidebar_section_tab_category_2) {
            $tab_section_query_2 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($asidebar_section_tab_category_2)));
        } else {
            $asidebar_section_tab_category_2 = esc_html__("latest", 'bigbulletin');
            $tab_section_query_2 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'post__not_in' => get_option("sticky_posts")));
        } ?>


            <header id="theme-banner-navs">
                <ul>
                    <li class="active">
                        <a href="#banner-tab-1">
                            <?php echo esc_html($asidebar_section_tab_category_1); ?>
                        </a>
                    </li>
                    <li>
                        <a href="#banner-tab-2">
                            <?php echo esc_html($asidebar_section_tab_category_2); ?>
                        </a>
                    </li>
                </ul>
            </header>
            <div class="aside-panel-tabs">
                <div id="banner-tab-1" class="twp-banner-tab">
                    <?php $count = 1;
                    if ($tab_section_query_1->have_posts()):
                        while ($tab_section_query_1->have_posts()) {
                            $tab_section_query_1->the_post();
                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';
                            ?>
                            <?php if ($count % 5 == 1) { ?>
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>

                                    <div class="data-bg data-bg-small"
                                         data-background="<?php echo esc_url($featured_image); ?>">
                                        <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                    </div>

                                    <div class="article-content">
                                        <h3 class="entry-title entry-title-medium mb-15">
                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                               title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="entry-meta entry-meta-default">
                                            <?php bigbulletin_posted_on($icon = true); ?>
                                        </div>
                                    </div>
                                </article>
                            <?php } else { ?>
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list'); ?>>

                                    <div class="data-bg data-bg-small"
                                         data-background="<?php echo esc_url($featured_image); ?>">
                                        <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                    </div>

                                    <div class="article-content">
                                        <h3 class="entry-title entry-title-small mb-15">
                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                               title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="entry-meta entry-meta-default">
                                            <?php bigbulletin_posted_on($icon = true); ?>
                                        </div>
                                    </div>
                                </article>
                            <?php }
                            $count++; ?>

                            <?php
                        }
                        wp_reset_postdata();
                    endif; ?>
                </div>
                <div id="banner-tab-2" class="twp-banner-tab">
                    <?php $count = 1;
                    if ($tab_section_query_2->have_posts()): ?>
                        <?php
                        while ($tab_section_query_2->have_posts()) {
                            $tab_section_query_2->the_post();
                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                            <?php if ($count % 5 == 1) { ?>
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>

                                    <div class="data-bg data-bg-small" data-background="<?php echo esc_url($featured_image); ?>">
                                        <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                    </div>

                                    <div class="article-content mt-10">
                                        <div class="entry-meta">
                                            <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                        </div>

                                        <h3 class="entry-title entry-title-medium mb-15">
                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                               title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="entry-meta entry-meta-default">
                                            <?php bigbulletin_posted_on($icon = true); ?>
                                        </div>
                                    </div>
                                </article>
                            <?php } else { ?>
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list'); ?>>

                                    <div class="data-bg data-bg-small"
                                         data-background="<?php echo esc_url($featured_image); ?>">
                                        <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                    </div>

                                    <div class="article-content">

                                        <h3 class="entry-title entry-title-small mb-15">
                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                               title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="entry-meta entry-meta-default">
                                            <?php bigbulletin_posted_on($icon = true); ?>
                                        </div>
                                    </div>
                                </article>
                            <?php }
                            $count++; ?>
                            <?php
                        } ?>
                        <?php
                        wp_reset_postdata();
                    endif; ?>
                </div>
            </div>


    <?php }

endif;