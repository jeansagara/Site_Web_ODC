<?php
/**
 * Widget FUnctions.
 *
 * @package BigBulletin
 */
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bigbulletin_widgets_init(){

    $bigbulletin_default = bigbulletin_get_default_theme_options();

    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'bigbulletin'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'bigbulletin'),
        'before_widget' => '<div id="%1$s" class="widget theme-widget-bg %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar( array(
        'name' => esc_html__('Offcanvas Widget', 'bigbulletin'),
        'id' => 'bigbulletin-offcanvas-widget',
        'description' => esc_html__('Add widgets here.', 'bigbulletin'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    $twp_bigbulletin_home_sections_5 = get_theme_mod('twp_bigbulletin_home_sections_5', json_encode($bigbulletin_default['twp_bigbulletin_home_sections_5']));
    $twp_bigbulletin_home_sections_5 = json_decode($twp_bigbulletin_home_sections_5);

    foreach( $twp_bigbulletin_home_sections_5 as $bigbulletin_home_section ){

        $home_section_type = isset( $bigbulletin_home_section->home_section_type ) ? $bigbulletin_home_section->home_section_type : '';

        switch( $home_section_type ){

            case 'home-widget-area':

                $ed_home_widget_area = isset( $bigbulletin_home_section->section_ed ) ? $bigbulletin_home_section->section_ed : '';

                if( $ed_home_widget_area == 'yes' ){

                    register_sidebar(array(
                        'name' => esc_html__('Front Page Widget Area', 'bigbulletin'),
                        'id' => 'front-page-widget-area-1',
                        'description' => esc_html__('Add widgets here.', 'bigbulletin'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h2 class="widget-title"><span>',
                        'after_title' => '</span></h2>',
                    ));

                }

                break;

            default:

                break;

        }

    }

    $bigbulletin_default = bigbulletin_get_default_theme_options();
    $footer_column_layout = absint(get_theme_mod('footer_column_layout', $bigbulletin_default['footer_column_layout']));

    for( $i = 0; $i < $footer_column_layout; $i++ ){

        if ($i == 0) {
            $count = esc_html__('One', 'bigbulletin');
        }
        if ($i == 1) {
            $count = esc_html__('Two', 'bigbulletin');
        }
        if ($i == 2) {
            $count = esc_html__('Three', 'bigbulletin');
        }
        if ($i == 3) {
            $count = esc_html__('Four', 'bigbulletin');
        }

        register_sidebar(array(
            'name' => esc_html__('Footer Widget ', 'bigbulletin') . $count,
            'id' => 'bigbulletin-footer-widget-' . $i,
            'description' => esc_html__('Add widgets here.', 'bigbulletin'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

    }

}

add_action('widgets_init', 'bigbulletin_widgets_init');
require get_template_directory() . '/inc/widgets/widget-base.php';
require get_template_directory() . '/inc/widgets/author.php';
require get_template_directory() . '/inc/widgets/home-page-widget.php';
require get_template_directory() . '/inc/widgets/home-page-carousel-widget.php';
require get_template_directory() . '/inc/widgets/home-page-banner-slider-widget.php';
require get_template_directory() . '/inc/widgets/social-link.php';
require get_template_directory() . '/inc/widgets/featured-category-widget.php';