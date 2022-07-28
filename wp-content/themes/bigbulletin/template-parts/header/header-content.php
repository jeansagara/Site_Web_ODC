<?php
/**
 * Header Layout 2
 *
 * @package BigBulletin
 */

use bigbulletin\BigBulletin_Walkernav;

$bigbulletin_default = bigbulletin_get_default_theme_options();
$bigbulletin_header_bg_size = get_theme_mod( 'bigbulletin_header_bg_size', $bigbulletin_default['bigbulletin_header_bg_size'] );
$ed_header_bg_fixed = get_theme_mod( 'ed_header_bg_fixed', $bigbulletin_default['ed_header_bg_fixed'] );
$ed_header_bg_overlay = get_theme_mod( 'ed_header_bg_overlay', $bigbulletin_default['ed_header_bg_overlay'] ); ?>

<header id="site-header" class="theme-header <?php if( $ed_header_bg_overlay ){ echo 'header-overlay-enabled'; } ?>" role="banner">
    <?php if ( is_front_page() || is_home() ) { ?>
        <div class="theme-news-ticker hidden-sm-element">
            <div class="wrapper">
                <div class="ticker-item-panel">
                    <?php if (is_active_sidebar('bigbulletin-offcanvas-widget')): ?>
                       <div id="widgets-nav" class="icon-sidr">
                           <button id="hamburger-one" class="navbar-control">
                               <span class="navbar-control-trigger" tabindex="-1">
                                   <span class="hamburger-wrapper">
                                       <span class="hamburger-inner"></span>
                                   </span>
                               </span>
                           </button>
                       </div>
                   <?php endif; ?>

                    <div class="ticker-item ticker-item-left">
                        <?php bigbulletin_header_ticker_posts(); ?>
                    </div>
                    <div class="ticker-item ticker-item-right">

                        <div class="ticker-controls">
                            <button type="button" class="slide-btn theme-aria-button slide-prev-ticker">
                                <span class="btn__content" tabindex="-1">
                                    <?php bigbulletin_theme_svg('chevron-left'); ?>
                                </span>
                            </button>

                            <button type="button" class="slide-btn theme-aria-button ticker-control ticker-control-play">
                                <span class="btn__content" tabindex="-1">
                                    <?php bigbulletin_theme_svg('play'); ?>
                                </span>
                            </button>

                            <button type="button" class="slide-btn theme-aria-button ticker-control ticker-control-pause pp-button-active">
                                <span class="btn__content" tabindex="-1">
                                    <?php bigbulletin_theme_svg('pause'); ?>
                                </span>
                            </button>

                            <button type="button" class="slide-btn theme-aria-button slide-next-ticker">
                                <span class="btn__content" tabindex="-1">
                                    <?php bigbulletin_theme_svg('chevron-right'); ?>
                                </span>
                            </button>
                        </div>

                        <?php bigbulletin_theme_date_time(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="header-mainbar<?php if( get_header_image() ){ if( $ed_header_bg_fixed ){ echo 'data-bg-fixed'; } ?> data-bg header-bg-<?php echo esc_attr( $bigbulletin_header_bg_size ); ?> <?php } ?> "  <?php if( get_header_image() ){ ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?>>
    
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">
                <div class="header-titles">
                    <?php
                    bigbulletin_site_description();
                    bigbulletin_site_logo();
                    ?>
                </div>
            </div>

            <div class="header-item header-item-center">
                <div class="site-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'bigbulletin'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if( has_nav_menu('bigbulletin-primary-menu') ){

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'bigbulletin-primary-menu',
                                        'walker' => new bigbulletin\BigBulletin_Walkernav(),
                                    )
                                );

                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'walker' => new BigBulletin_Walker_Page(),
                                    )
                                );

                            } ?>
                        </ul>
                    </nav>
                </div>

            </div>

            <!-- favorite, date and time  -->

            <!-- <div class="header-item header-item-right">
                
                <?php bigbulletin_category_pin_posts_link(); ?>

                <?php bigbulletin_theme_date_time(); ?>
            </div> -->

            <div class="header-item header-item-right">
                <?php
                $ed_ticker_bar_social_nav = get_theme_mod( 'ed_ticker_bar_social_nav', $bigbulletin_default['ed_ticker_bar_social_nav'] );

                if (has_nav_menu('bigbulletin-social-menu') && $ed_ticker_bar_social_nav) { ?>
                    <div class="navbar-social-navigation">
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
                <?php } ?>



                <?php main_navigation_extras(); ?>
                </div>

                <?php bigbulletin_content_trending_news_render(); ?>


             </div>
            
        </div>
    </div>

</header>


