<?php
/**
 * Advertise
 *
 * @package BigBulletin
 */
if (!function_exists('bigbulletin_grid_list_block')):
    function bigbulletin_grid_list_block($bigbulletin_home_section, $repeat_times)
    {
        $section_post_cat_3 = esc_html(isset($bigbulletin_home_section->section_post_cat_3) ? $bigbulletin_home_section->section_post_cat_3 : '');
        $home_section_title_4 = isset($bigbulletin_home_section->home_section_title_4) ? $bigbulletin_home_section->home_section_title_4 : '';
        $section_post_cat_4 = esc_html(isset($bigbulletin_home_section->section_post_cat_4) ? $bigbulletin_home_section->section_post_cat_4 : '');
        $home_section_title_3 = isset($bigbulletin_home_section->home_section_title_3) ? $bigbulletin_home_section->home_section_title_3 : '';
        $list_grid_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_cat_3)));
        $list_grid_query_2 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_cat_4))); ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-list-grid">

            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-12">

                        <?php if ($home_section_title_3) { ?>
                            <div class="theme-panel-header">
                                <header class="block-title-wrapper">
                                    <h2 class="block-title">
                                        <?php echo esc_html($home_section_title_3); ?>
                                    </h2>
                                </header>
                            </div>
                        <?php } ?>

                        <div class="theme-panel-body">
                            <div class="column-row column-row-small">
                                <div class="column column-8 column-md-12 column-sm-12 mb-20">
                                    <div class="column-row column-row-small">
                                    <?php if ($list_grid_query_1->have_posts()): ?>
                                        <?php
                                        $i = 1;
                                        while ($list_grid_query_1->have_posts()) {
                                            $list_grid_query_1->the_post();
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                            <?php if ($i == 1) { ?>
                                                <div class="column column-8 column-sm-12">
                                                    <article class="news-article mb-10">
                                                        <div class="data-bg data-bg-big thumb-overlay" data-background = '<?php echo esc_url($featured_image); ?>'>
                                                            <a href="<?php the_permalink(); ?>" class="img-link"></a>
                                                        </div>

                                                        <div class="article-content article-content-overlay">
                                                            <div class="entry-meta">
                                                                <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>

                                                            </div>

                                                            <h2 class="entry-title entry-title-big">
                                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="7 Steps Leaders Can Take to Stop Making Women Choose Between Family and Career">
                                                                    <?php the_title(); ?>                                                            </a>
                                                            </h2>

                                                            <div class="entry-footer">
                                                                <div class="entry-meta">
                                                                    <?php bigbulletin_posted_by(); ?>
                                                                    <?php bigbulletin_post_view_count(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            <?php $i++; } else { ?>

                                                <div class="column column-4 column-sm-12">
                                                    <article class="news-article mb-10">
                                                        <div class="data-bg data-bg-medium mb-10" data-background = '<?php echo esc_url($featured_image); ?>'>
                                                            <a href="<?php the_permalink(); ?>" class="img-link"></a>
                                                        </div>
                                                
                                                        <div class="article-content">
                                                
                                                            <h2 class="entry-title entry-title-small">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_title(); ?>                                                            </a>
                                                            </h2>
                                                
                                                            <div class="entry-footer">
                                                                <div class="entry-meta">
                                                                    <?php bigbulletin_posted_by(); ?>
                                                                    <?php bigbulletin_post_view_count(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            <?php } ?>

                                            <?php
                                        } ?>
                                    <?php wp_reset_postdata();
                                    endif; ?>
                                    </div>
                                </div>
                                <?php if ($list_grid_query_2->have_posts()): ?>
                                    <div class="column column-4 column-md-12 column-sm-12">

                                        <?php if ($home_section_title_4) { ?>
                                            <div class="theme-panel-header panel-header-bg">
                                                <header class="block-title-wrapper">
                                                    <h2 class="block-title">
                                                        <?php echo esc_html($home_section_title_4);?>
                                                    </h2>
                                                </header>
                                            </div>
                                        <?php } ?>

                                        <div class="theme-panel-body">
                                            <?php
                                            while ($list_grid_query_2->have_posts()) {
                                                $list_grid_query_2->the_post();
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>

                                                    <article id="theme-post-178" class="news-article mb-20"
                                                    >
                                                        <div class="column-row">
                                                            <div class="column column-8">
                                                                <div class="article-content">
                                                                    <div class="entry-meta">
                                                                        <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                                    </div>

                                                                    <h3 class="entry-title entry-title-small">
                                                                    <a
                                                                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a
                                                                    >
                                                                    </h3>
                                                                </div>

                                                                <div class="article-content-footer">
                                                                    <div class="entry-meta-item entry-meta-views">
                                                                        <div class="article-content-footer">
                                                                            <div class="entry-meta">
                                                                                <?php bigbulletin_posted_by(); ?>
                                                                                <?php bigbulletin_post_view_count(); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="column column-4">
                                                                <div class="data-bg data-bg-small" data-background="<?php echo esc_url($featured_image); ?>">
                                                                    <a
                                                                    class="img-link"
                                                                    href=" <?php the_permalink(); ?>"
                                                                    tabindex="0"
                                                                    ></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                <?php
                                            } ?>
                                        </div>

                                        <div class="theme-panel-footer">
                                           <a href="" class="theme-btn-link">
                                            show more
                                           </a>
                                        </div>
                                    </div>
                                <?php wp_reset_postdata();
                                endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php }
endif; ?>