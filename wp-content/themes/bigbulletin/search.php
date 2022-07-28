<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BigBulletin
 * @since 1.0.0
 */
get_header();

    $bigbulletin_default = bigbulletin_get_default_theme_options();
    $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $bigbulletin_default['global_sidebar_layout'] ) );
    $bigbulletin_archive_layout = esc_attr( get_theme_mod( 'bigbulletin_archive_layout', $bigbulletin_default['bigbulletin_archive_layout'] ) ); ?>

    <div class="theme-block theme-block-archive">
        <div class="wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="200.000000pt" height="200.000000pt" viewBox="0 0 200.000000 200.000000" preserveAspectRatio="xMidYMid meet">
            <g transform="translate(0.000000,200.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
            <path d="M650 1823 c-111 -18 -224 -81 -311 -170 -112 -114 -157 -216 -166 -373 -10 -171 46 -317 168 -439 173 -173 426 -220 648 -120 36 16 80 41 99 55 l33 26 25 -23 c15 -14 24 -34 24 -53 0 -27 33 -64 263 -294 l262 -262 68 68 67 67 -263 263 c-245 245 -264 262 -298 262 -23 0 -42 7 -54 20 -17 19 -17 21 7 58 74 112 108 218 108 342 0 266 -183 498 -445 565 -55 14 -175 18 -235 8z m248 -183 c185 -65 299 -268 263 -465 -61 -331 -468 -458 -706 -220 -158 158 -160 426 -4 586 113 116 288 155 447 99z"/>
            <path d="M592 1418 c-23 -23 -11 -53 45 -110 l57 -57 -58 -61 c-46 -48 -57 -65 -54 -87 2 -21 9 -29 27 -31 18 -3 38 11 85 57 l62 61 59 -60 c59 -60 89 -72 113 -48 21 21 13 39 -50 104 l-62 65 62 62 c34 34 62 68 62 74 0 17 -29 43 -47 43 -8 0 -43 -27 -77 -60 l-62 -59 -59 59 c-60 60 -81 70 -103 48z"/>
            </g>
            </svg>
            <?php bigbulletin_breadcrumb_with_title_block(); ?>
        </div> 
        <div class="wrapper">
            <div class="column-row">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        
                        <?php
                        if( have_posts() ): ?>

                            <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr( $bigbulletin_archive_layout ); ?>">

                                <?php while( have_posts() ):
                                    the_post();

                                    get_template_part( 'template-parts/content', '' );

                                endwhile; ?>

                            </div>

                            <?php the_posts_pagination();

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
get_footer();
