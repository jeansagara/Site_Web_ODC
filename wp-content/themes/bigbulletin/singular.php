<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BigBulletin
 * @since 1.0.0
 */
get_header();

$current_id = '';
if( have_posts() ):
    while (have_posts()) :
    the_post();
        $current_id  = get_the_ID();
    endwhile;
    wp_reset_postdata();
endif;
    
    $bigbulletin_default = bigbulletin_get_default_theme_options();
    $sidebar = get_theme_mod( 'global_sidebar_layout', $bigbulletin_default['global_sidebar_layout'] );
    $bigbulletin_post_sidebar = esc_attr( get_post_meta( $current_id, 'bigbulletin_post_sidebar_option', true ) );
    $twp_navigation_type = esc_attr( get_post_meta( $current_id, 'twp_disable_ajax_load_next_post', true ) );
    $bigbulletin_header_trending_page = get_theme_mod( 'bigbulletin_header_trending_page' );
    $bigbulletin_header_popular_page = get_theme_mod( 'bigbulletin_header_popular_page' );
    $bigbulletin_archive_layout = esc_attr( get_theme_mod( 'bigbulletin_archive_layout', $bigbulletin_default['bigbulletin_archive_layout'] ) );
    $article_wrap_class = '';
    $single_layout_class = ' single-layout-default';

    if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
        $twp_navigation_type = get_theme_mod('twp_navigation_type', $bigbulletin_default['twp_navigation_type']);
    }

    if( $bigbulletin_post_sidebar == 'global-sidebar' || empty( $bigbulletin_post_sidebar ) ){
        $sidebar = $sidebar;
    }else{
        $sidebar = $bigbulletin_post_sidebar;
    }
    $bigbulletin_post_layout = esc_attr( get_post_meta( $current_id, 'bigbulletin_post_layout', true ) );
    if( $bigbulletin_post_layout == '' || $bigbulletin_post_layout == 'global-layout' ){
        
        $bigbulletin_post_layout = get_theme_mod( 'bigbulletin_single_post_layout',$bigbulletin_default['bigbulletin_archive_layout'] );
    }
    if( $bigbulletin_post_layout == 'layout-2' ){
        $single_layout_class = ' single-layout-banner';
    }
    if( $bigbulletin_header_trending_page == $current_id || $bigbulletin_header_popular_page == $current_id ){
        $article_wrap_class = 'archive-layout-' . esc_attr($bigbulletin_archive_layout);
        $single_layout_class = '';
    }
    $bigbulletin_header_trending_page = get_theme_mod( 'bigbulletin_header_trending_page' );
    $bigbulletin_header_popular_page = get_theme_mod( 'bigbulletin_header_popular_page' );
    if( $bigbulletin_header_trending_page == get_the_ID() || $bigbulletin_header_popular_page == get_the_ID() ){

        $breadcrumb = true;

    }
    $bigbulletin_ed_post_rating = get_post_meta( $post->ID, 'bigbulletin_ed_post_rating', true ); ?>

    <div class="theme-block singular-main-block">
        <div class="wrapper">
            <div class="column-row">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main <?php if( $bigbulletin_ed_post_rating ){ echo 'bigbulletin-no-comment'; } ?>" role="main">

                        <?php
                        if( !is_home() && !is_front_page() && ( isset( $breadcrumb ) || $bigbulletin_post_layout != 'layout-2' ) ) {
                            bigbulletin_breadcrumb_with_title_block();
                        }

                        if( have_posts() ): ?>

                            <div class="article-wraper single-layout <?php echo esc_attr($article_wrap_class.$single_layout_class); ?>">

                                <?php while (have_posts()) :
                                    the_post();

                                    get_template_part('template-parts/content', 'single');

                                    /**
                                     *  Output comments wrapper if it's a post, or if comments are open,
                                     * or if there's a comment number – and check for password.
                                    **/
                                    if ( $bigbulletin_header_trending_page != $current_id && $bigbulletin_header_popular_page != $current_id ) {

                                        if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

                                            <div class="comments-wrapper">
                                                <?php comments_template(); ?>
                                            </div>

                                        <?php
                                        }
                                    }

                                endwhile; ?>

                            </div>

                        <?php
                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;

                        /**
                         * Navigation
                         * 
                         * @hooked bigbulletin_post_floating_nav - 10
                         * @hooked bigbulletin_related_posts - 20
                         * @hooked bigbulletin_single_post_navigation - 30
                        */

                        do_action('bigbulletin_navigation_action'); ?>

                    </main><!-- #main -->
                </div>

                <?php
                if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                    $sidebar_status = false;
                }else{
                    $sidebar_status = true;
                }
                if ( $sidebar != 'no-sidebar' && $sidebar_status ) {
                    get_sidebar();
                } ?>

            </div>
        </div>
    </div>

<?php
get_footer();
