<?php
/**
 * Advertise
 *
 * @package BigBulletin
 */
if (!function_exists('bigbulletin_main_banner')):
    function bigbulletin_main_banner($bigbulletin_home_section, $repeat_times)
    {
        $section_post_slide_cat = esc_html(isset($bigbulletin_home_section->section_post_slide_cat) ? $bigbulletin_home_section->section_post_slide_cat : '');
        $section_post_cat_1 = esc_html(isset($bigbulletin_home_section->section_post_cat_1) ? $bigbulletin_home_section->section_post_cat_1 : '');
        $slider_arrows = esc_html(isset($bigbulletin_home_section->ed_arrows_carousel) ? $bigbulletin_home_section->ed_arrows_carousel : '');
        $slider_dots = esc_html(isset($bigbulletin_home_section->ed_dots_carousel) ? $bigbulletin_home_section->ed_dots_carousel : '');
        $slider_autoplay = esc_html(isset($bigbulletin_home_section->ed_autoplay_carousel) ? $bigbulletin_home_section->ed_autoplay_carousel : '');
        $home_section_title_4 = isset($bigbulletin_home_section->home_section_title_4) ? $bigbulletin_home_section->home_section_title_4 : '';
        $home_section_title_3 = isset($bigbulletin_home_section->home_section_title_3) ? $bigbulletin_home_section->home_section_title_3 : '';
        if ($slider_arrows == 'yes' || $slider_arrows == '') {
            $arrow = 'true';
        } else {
            $arrow = 'false';
        }
        if ($slider_autoplay == 'yes' || $slider_autoplay == '') {
            $autoplay = 'true';
        } else {
            $autoplay = 'false';
        }
        if ($slider_dots == 'yes') {
            $dots = 'true';
        } else {
            $dots = 'false';
        }
        if (is_rtl()) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
        $banner_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_cat_1)));
        $banner_query_2 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_slide_cat))); ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-main-banner">

            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-7 column-md-12 column-sm-12 mb-md-203">
                        <?php if ($banner_query_2->have_posts()): ?>
                            <div class="theme-panel-wrapper">
                                <div class="theme-slider-wrapper">

                                    <?php if ($home_section_title_3) { ?>
                                        <div class="theme-panel-wrapper mb-20">
                                            <header class="block-title-wrapper">
                                                <?php if ($home_section_title_3) { ?>
                                                    <h2 class="block-title">
                                                        <?php echo esc_html($home_section_title_3); ?>
                                                    </h2>
                                                <?php } ?>
                                            </header>
                                        </div>
                                    <?php } ?>

                                    <div class="theme-heading-controls">
                                        <button type="button" class="slide-btn slide-btn-small slide-prev-banner">
                                            <?php bigbulletin_theme_svg('chevron-left'); ?>
                                        </button>
                                        <button type="button" class="slide-btn slide-btn-small slide-next-banner">
                                            <?php bigbulletin_theme_svg('chevron-right'); ?>
                                        </button>
                                    </div>

                                    <div class="theme-main-slider-block" data-slick='{"arrows": <?php echo esc_attr($arrow); ?>, "autoplay": <?php echo esc_attr($autoplay); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                                        <?php
                                        while ($banner_query_2->have_posts()) {
                                            $banner_query_2->the_post();
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                            <div class="theme-slider-item">
                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                                    <div class="data-bg data-bg-xlarge thumb-overlay" data-background="<?php echo esc_url($featured_image); ?>">
                                                        <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                    </div>

                                                    <div class="article-content article-content-overlay">
                                                        <div class="entry-meta">
                                                            <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                        </div>
                                                        <h2 class="entry-title entry-title-large">
                                                            <a href="<?php the_permalink(); ?>" tabindex="0"
                                                               rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>
                                                        <div class="entry-footer">
                                                            <div class="entry-meta">
                                                                <?php bigbulletin_posted_by(); ?>
                                                                <?php bigbulletin_post_view_count(); ?>
                                                            </div>
                                                        </div>

                                                        <div class="entry-content hidden-xs-element entry-content-muted">
                                                            <?php
                                                            if (has_excerpt()) {
                                                                the_excerpt();
                                                            } else {
                                                                echo '<p>';
                                                                echo esc_html(wp_trim_words(get_the_content(), 30, '...'));
                                                                echo '</p>';
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php wp_reset_postdata();
                        endif; ?>
                    </div>

                    <?php if ($banner_query_1->have_posts()): ?>
                        <div class="column column-5 column-md-12 column-sm-12 column-xs-12">
                            <?php if ($home_section_title_4) { ?>
                                <div class="theme-panel-wrapper">
                                    <header class="block-title-wrapper">
                                        <?php if ($home_section_title_4) { ?>
                                            <h2 class="block-title">
                                                <?php echo esc_html($home_section_title_4); ?>
                                            </h2>
                                        <?php } ?>
                                    </header>
                                </div>
                            <?php } ?>

                            <div class="main-banner-left">
                                <?php
                                while ($banner_query_1->have_posts()) {
                                    $banner_query_1->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-instant'); ?>>
                                        <div class="column-row">
                                            <div class="column column-8">
                                                <div class="article-content">
                                                    <div class="entry-meta">
                                                        <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                    </div>
            
                                                    <h3 class="entry-title entry-title-small">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    </h3>
            
                                                </div>
            
                                                <div class="article-content-footer">
                                                    <div class="entry-meta">
                                                        <?php bigbulletin_posted_by(); ?>
                                                        <?php bigbulletin_post_view_count(); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="column column-4">
                                                <div class="data-bg data-bg-small" data-background="<?php echo esc_url($featured_image); ?>">
                                                    <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <?php
                                } ?>
                            </div>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    <?php }
endif; ?>