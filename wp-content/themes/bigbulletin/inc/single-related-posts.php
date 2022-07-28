<?php
/**
* Related Posts Functions.
*
* @package BigBulletin
*/
if( !function_exists('bigbulletin_related_posts') ):

	// Single Posts Related Posts.
	function bigbulletin_related_posts(){

        $bigbulletin_default = bigbulletin_get_default_theme_options();
        $bigbulletin_header_trending_page = get_theme_mod( 'bigbulletin_header_trending_page' );
        $bigbulletin_header_popular_page = get_theme_mod( 'bigbulletin_header_popular_page' );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;

        if( $bigbulletin_header_trending_page != $current_id && $bigbulletin_header_popular_page != $current_id && is_single() && 'post' === get_post_type() ){

    		$cats = get_the_category( $post->ID );
    		$category = array();
            if( $cats ){
                foreach( $cats as $cat ){
                    $category[] = $cat->term_id; 
                }
            }

            $related_posts_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => array( $post->ID ), 'category__in' => $category ) );
    		$ed_related_post = absint( get_theme_mod( 'ed_related_post',$bigbulletin_default['ed_related_post'] ) );

    		if( $ed_related_post && $related_posts_query->have_posts() ): ?>

    			<div class="theme-block related-posts-area">

    	        	<?php $related_post_title = esc_html( get_theme_mod( 'related_post_title',$bigbulletin_default['related_post_title'] ) );
    	        	if( $related_post_title ){ ?>
                        <header class="block-title-wrapper">
                            <h2 class="block-title">
                                <?php echo esc_html( $related_post_title ); ?>
                            </h2>
                        </header>
    		        <?php } ?>

    	            <div class="related-posts-wrapper">

                        <?php while( $related_posts_query->have_posts() ):
                            $related_posts_query->the_post();

                            $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium' );
                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-catalogue'); ?>>
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="data-bg data-bg-small" data-background="<?php echo esc_url($featured_image); ?>">



                                            <a href="<?php the_permalink(); ?>">
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="article-content">
                                        <header class="entry-header">
                                            <h3 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                        </header>



                                        <div class="entry-meta">
                                            <?php bigbulletin_posted_by(); ?>
                                        </div>
                                    </div>
                                </article>
                        <?php endwhile; ?>

    	            </div>

    			</div>

    		<?php
    		wp_reset_postdata();
    		endif;

        }

	}

endif;
add_action( 'bigbulletin_navigation_action','bigbulletin_related_posts',20 );