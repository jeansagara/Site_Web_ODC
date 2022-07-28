<?php
/**
 * BigBulletin Dynamic Styles
 *
 * @package BigBulletin
 */

function bigbulletin_dynamic_css()
{

    $bigbulletin_default = bigbulletin_get_default_theme_options();
    $logo_width_range = get_theme_mod('logo_width_range', $bigbulletin_default['logo_width_range']);
    
    $bigbulletin_general_color = get_theme_mod('bigbulletin_general_color', $bigbulletin_default['bigbulletin_general_color']);
    $bigbulletin_link_color = get_theme_mod('bigbulletin_link_color', $bigbulletin_default['bigbulletin_link_color']);
    
    $site_title_font_size = get_theme_mod('site_title_font_size', $bigbulletin_default['site_title_font_size']);


    echo "<style type='text/css' media='all'>"; ?>

    .site-logo .custom-logo-link{
        max-width:  <?php echo esc_attr($logo_width_range); ?>px;
    }

    @media (min-width: 1200px) {
    .header-titles .site-title,
    .header-titles .custom-logo-name{
    font-size: <?php echo esc_attr($site_title_font_size); ?>px;
    }
    }

    body, input, select, optgroup, textarea{
    color: <?php echo esc_attr($bigbulletin_general_color); ?>;
    }

    a,
    .widget-title,
    .block-title-wrapper .block-title{
    color: <?php echo esc_attr($bigbulletin_link_color); ?>;
    }

    .theme-block,
    .theme-aside-panel,
    #theme-banner-navs,
    .header-navbar,
    .megamenu-recent-article,
    .posts-navigation,
    .post-navigation{
    border-color: <?php echo bigbulletin_hex_2_rgba($bigbulletin_link_color,0.1); ?>;
    }

    #theme-banner-navs:before,
    #theme-banner-navs:after{
    border-color: <?php echo bigbulletin_hex_2_rgba($bigbulletin_link_color,0.2); ?>;
    }

    .megamenu-recent-article,
    .widget_recent_entries ul li,
    .widget_categories ul li,
    .widget_pages ul li,
    .widget_archive ul li,
    .widget_meta ul li,
    .widget_recent_comments ul li,
    .widget_block .wp-block-latest-posts li,
    .widget_block .wp-block-categories li,
    .widget_block .wp-block-archives li,
    .widget_block .wp-block-latest-comments li{
    border-bottom-color: <?php echo bigbulletin_hex_2_rgba($bigbulletin_link_color,0.1); ?>;
    }
    .theme-svg-seperator{
    color: <?php echo bigbulletin_hex_2_rgba($bigbulletin_link_color,0.2); ?>;
    }
    <?php echo "</style>";
}

add_action('wp_head', 'bigbulletin_dynamic_css', 100);

/**
 * Sanitizing Hex color function.
 */
function bigbulletin_sanitize_hex_color($color)
{

    if ('' === $color)
        return '';
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
        return $color;

}