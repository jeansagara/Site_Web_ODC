<?php
/**
 * Latest Posts
 *
 * @package BigBulletin
 */
if( !function_exists('bigbulletin_latest_blocks') ):
    
    function bigbulletin_latest_blocks($bigbulletin_home_section,$repeat_times){

        global $post;
        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $bigbulletin_default['global_sidebar_layout'] ) );

        $bigbulletin_archive_layout = esc_attr( get_theme_mod( 'bigbulletin_archive_layout', $bigbulletin_default['bigbulletin_archive_layout'] ) ); ?>
        <div id="theme-block-<?php echo esc_attr( $repeat_times ); ?>" class="theme-block theme-block-archive">
            <div class="wrapper">
                <div class="column-row">
                    <div id="primary" class="content-area theme-top-sticky">
                        <main id="main" class="site-main" role="main">

                                <?php
                                if( !is_front_page() ) {
                                    bigbulletin_breadcrumb_with_title_block();
                                }

                                if( have_posts() ): ?>

                                    <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr( $bigbulletin_archive_layout ); ?>">
                                        <?php while (have_posts()) :
                                            the_post();

                                            if( !is_page() ){

                                                get_template_part( 'template-parts/content', get_post_format() );
                                                
                                            }else{
                                                get_template_part('template-parts/content', 'single');
                                            }


                                        endwhile; ?>
                                    </div>

                                    <?php if( !is_page() ): do_action('bigbulletin_archive_pagination'); endif;

                                else :

                                    get_template_part('template-parts/content', 'none');

                                endif; ?>

                        </main><!-- #main -->
                    </div>

                    <?php if( $sidebar != 'no-sidebar' ){

                        get_sidebar();
                        
                    } ?>
                </div>
            </div>
        </div>

    <?php
    }
    
endif;
