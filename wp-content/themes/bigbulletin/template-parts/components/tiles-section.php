<?php
/**
 * Tiles Blocks
 *
 * @package BigBulletin
 */
if (!function_exists('bigbulletin_tiles_block_section')):
    function bigbulletin_tiles_block_section($bigbulletin_home_section, $repeat_times)
    {
        $section_category = esc_html(isset($bigbulletin_home_section->section_category) ? $bigbulletin_home_section->section_category : '');
        // $tiles_post_per_page = esc_html(isset($bigbulletin_home_section->tiles_post_per_page) ? $bigbulletin_home_section->tiles_post_per_page : 6);
        $home_section_title = isset($bigbulletin_home_section->home_section_title) ? $bigbulletin_home_section->home_section_title : '';
        $tiles_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_category)));
        if ($tiles_post_query->have_posts()):
            $post_ids = array();
            while ($tiles_post_query->have_posts()) {
                $tiles_post_query->the_post();
                $post_ids[] = get_the_ID();
            }
            $posts_id = array();
            if ($post_ids && count($post_ids) > 6) {
                $posts_id = array_chunk($post_ids,6);
            } else {
                $posts_id[] = $post_ids;
            }
            if (empty($home_section_title) && $section_category) {
                $catObj = get_category_by_slug($section_category);
                if (isset($catObj->name) && $catObj->name) {
                    $home_section_title = $catObj->name;
                }
            } ?>
            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-bg theme-block-bg-1 theme-block-tiles">
                <div class="wrapper">
                    <div class="column-row column-row-small">
                        <?php if ($home_section_title || $section_category) { ?>
                            <div class="column column-12 column-sm-12">
                                <header class="block-title-wrapper">
                                    <?php if ($home_section_title) { ?>
                                        <h2 class="block-title">
                                            <?php echo esc_html($home_section_title); ?>
                                        </h2>
                                    <?php } ?>
                                    <?php if ($section_category) {
                                        $catObj = get_category_by_slug($section_category);
                                        if (isset($catObj->name) && $catObj->name) {
                                            $cat_title = $catObj->name;
                                        }
                                        $cat_link = get_category_link($catObj->term_id); ?>
                                        <div class="theme-heading-controls">
                                            <a href="<?php echo esc_url($cat_link); ?>" class="view-all-link">
                                                <span class="view-all-icon"><?php bigbulletin_theme_svg('plus'); ?></span>
                                                <span class="view-all-label"><?php echo esc_html_e('View All', 'bigbulletin'); ?></span>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </header>
                            </div>
                        <?php } ?>
                        <?php
                        foreach ($posts_id as $post_id) {
                            $post_ids_1 = array();
                            $post_ids_2 = array();
                            if (isset($post_id[0]) && $post_id[0]) {
                                $post_ids_1[] = $post_id[0];
                            }
                            if (isset($post_id[1]) && $post_id[1]) {
                                $post_ids_1[] = $post_id[1];
                            }
                            if (isset($post_id[2]) && $post_id[2]) {
                                $post_ids_1[] = $post_id[2];
                            }
                            if (isset($post_id[3]) && $post_id[3]) {
                                $post_ids_2[] = $post_id[3];
                            }
                            if (isset($post_id[4]) && $post_id[4]) {
                                $post_ids_2[] = $post_id[4];
                            }
                            if (isset($post_id[5]) && $post_id[5]) {
                                $post_ids_2[] = $post_id[5];
                            }
                            if ($post_ids_1) {
                                $tiles_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option("sticky_posts"), 'post__in' => $post_ids_1));
                                if ($tiles_query_1->have_posts()) { ?>
                                    <div class="column column-12 column-md-12 column-sm-12">
                                        <div class="block-tiles-slide">
                                            <div class="block-slide-container">
                                                    <?php while ($tiles_query_1->have_posts()) {
                                                        $tiles_query_1->the_post();
                                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';

                                                        ?>
                                                            <div class="block-slide-item">
                                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article mb-10'); ?>>
                                                                    <div class="column-row column-row-collapse">
                                                                        <div class="column column-6 column-xxs-12">
                                                                            <div class="data-bg data-bg-large thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                                                                <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                                            </div>
                                                                        </div>

                                                                        <div class="column column-6 column-xxs-12">
                                                                            <div class="article-content article-content-bg">
                                                                                <div class="entry-meta">
                                                                                    <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                                                </div>
                                                                                <h3 class="entry-title entry-title-large line-clamp-2">
                                                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                                        <?php the_title(); ?>
                                                                                    </a>
                                                                                </h3>
                                                                                <div class="entry-meta">
                                                                                    <?php bigbulletin_posted_by(); ?>
                                                                                    <?php bigbulletin_post_view_count(); ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </article>
                                                            </div>
                                                        <?php
                                                    } ?>
                                            </div>

                                            <div class="block-slide-button">
                                                <button class="slide-btn slide-btn-bg slide-prev-icon">
                                                    <svg class="svg-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path></svg>
                                                </button>

                                                <button class="slide-btn slide-btn-bg slide-next-icon">
                                                   <svg class="svg-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="currentColor" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            if ($post_ids_2) {
                                $tiles_query_2 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option("sticky_posts"), 'post__in' => $post_ids_2));
                                if ($tiles_query_2->have_posts()) { ?>
                                    <div class="column column-12 column-md-12 column-sm-12">
                                        <div class="column-row column-row-small">
                                            <?php
                                            while ($tiles_query_2->have_posts()) {
                                                $tiles_query_2->the_post();
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                                ?>
                                                <div class="column column-4 column-xxs-12">
                                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article mb-10'); ?>>
                                                        <div class="data-bg data-bg-medium thumb-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image[0]); ?>">
                                                            <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                        </div>

                                                        <div class="article-content article-content-overlay">
                                                            <div class="entry-meta">
                                                                <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                            </div>
                                                            <h3 class="entry-title entry-title-small">
                                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </h3>
                                                            <div class="entry-meta">
                                                                <?php bigbulletin_posted_by(); ?>
                                                                <?php bigbulletin_post_view_count(); ?>
                                                            </div>
                                                        </div>


                                                    </article>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        } ?>
                    </div>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        endif;
    }
endif;