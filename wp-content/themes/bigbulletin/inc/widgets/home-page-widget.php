<?php
/**
 * Article Widget Style
 *
 * @package BigBulletin
 */
if (!function_exists('bigbulletin_post_widget')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function bigbulletin_post_widget()
    {
        register_widget('BigBulletin_Post_Widget');
    }
endif;
add_action('widgets_init', 'bigbulletin_post_widget');
// Article Widget Layout 1
if (!class_exists('BigBulletin_Post_Widget')) :
    /**
     * Article Widget Layout 1
     *
     * @since 1.0.0
     */
    class BigBulletin_Post_Widget extends BigBulletin_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'bigbulletin_post_widget',
                'description' => esc_html__('Displays post form selected category in different styles', 'bigbulletin'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Section Title:', 'bigbulletin'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => esc_html__('Select Category:', 'bigbulletin'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'bigbulletin'),
                ),
                'display_orientation' => array(
                    'label' => esc_html__('Display Layout:', 'bigbulletin'),
                    'type' => 'select',
                    'default' => 'layout-1',
                    'options' => array(
                        'layout-1' => esc_html__('Layout - 1 ', 'bigbulletin'),
                        'layout-2' => esc_html__('Layout - 2', 'bigbulletin'),
                        'layout-3' => esc_html__('Layout - 3', 'bigbulletin'),
                    ),
                ),
                'enable_meta' => array(
                    'label' => esc_html__('Enable Categories:', 'bigbulletin'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'enable_meta_1' => array(
                    'label' => esc_html__('Enable Date & Author:', 'bigbulletin'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'button_text' => array(
                    'label' => esc_html__('Button Text:', 'bigbulletin'),
                    'type' => 'text',
                    'default' => 'View more',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('bigbulletin-widget-style-1', esc_html__('BigBulletin: HomePage Post Widget', 'bigbulletin'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         * @since 1.0.0
         *
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            if ($params['display_orientation'] == 'layout-1') {
                $post_number = 2;
            } else {
                $post_number = 4;
            }
            $qargs = array(
                'post_type' => 'post',
                'posts_per_page' => $post_number,
                'post__not_in' => get_option("sticky_posts"),
            );
            $cat_link = "";
            if (absint($params['post_category']) > 0) {
                $qargs['cat'] = absint($params['post_category']);
                $cat_link = get_category_link($params['post_category']);
            }
            $style_1_posts_query = new WP_Query($qargs);
            if ($style_1_posts_query->have_posts()) : ?>
                <?php $display_orientation = esc_attr($params['display_orientation']);
                if ($display_orientation == 'layout-1') { ?>
                    <div class="theme-widget widget-layout widget-layout-1">
                        <?php if (!empty($params['title'])) { ?>
                        <div class="theme-widget-title">
                            <h2 class="widget-title">
                                <span> <?php echo $params['title'] ?></span>
                            </h2>
                        </div>
                        <?php } ?>
                        <div class="theme-widget-content">
                            <?php
                            $i = 1;
                            while ($style_1_posts_query->have_posts()) :
                                $style_1_posts_query->the_post(); ?>
                                <div class="theme-widget-panel widget-panel-<?php echo $i; ?>">
                                    <div class="widget-story">
                                        <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>

                                            <?php if (has_post_thumbnail()): ?>
                                                <div class="data-bg data-bg-big" data-background="<?php echo esc_url($featured_image); ?>">
                                                    <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                </div>
                                            <?php endif; ?>

                                            <div class="article-content">
                                                <?php if ($params['enable_meta'] == 'yes') { ?>
                                                    <div class="entry-meta">
                                                        <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                    </div>
                                                <?php } ?>

                                                <h3 class="entry-title entry-title-big">
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>

                                                <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                                    <div class="entry-meta">
                                                        <?php bigbulletin_posted_by(); ?>
                                                    </div>
                                                <?php } ?>

                                                <div class="entry-content entry-content-muted">
                                                    <?php
                                                    if (has_excerpt()) {

                                                        the_excerpt();

                                                    } else {

                                                        echo '<p>';
                                                        echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                        echo '</p>';

                                                    } ?>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <?php $i++; endwhile; ?>
                        </div>
                        <?php if (!empty($params['button_text']) && !empty($cat_link)) { ?>
                            <div class="theme-widget-footer">
                                <div class="widget-footer-panel">
                                    <hr>
                                    <a class="theme-viewmore-link" href="<?php echo esc_url($cat_link); ?>"><?php echo $params['button_text']; ?></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } elseif ($display_orientation == 'layout-2') { ?>
                    <div class="theme-widget widget-layout widget-layout-2">
                    <?php if (!empty($params['title'])) { ?>
                        <div class="theme-widget-title">
                            <h2 class="widget-title">
                                <span> <?php echo $params['title'] ?></span>
                            </h2>
                        </div>
                    <?php } ?>
                    <div class="theme-widget-content">
                        <?php
                        $i = 1;
                        while ($style_1_posts_query->have_posts()) :
                        $style_1_posts_query->the_post(); ?>
                        <?php if ($i == 1) { ?>
                        <div class="theme-widget-panel widget-panel-1">
                            <div class="widget-story"">
                                <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>

                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="data-bg data-bg-big" data-background="<?php echo esc_url($featured_image); ?>">
                                            <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="article-content">
                                        <?php if ($params['enable_meta'] == 'yes') { ?>
                                            <div class="entry-meta">
                                                <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                            </div>
                                        <?php } ?>

                                        <h3 class="entry-title entry-title-big">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>

                                        <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                            <div class="entry-meta">
                                                <?php bigbulletin_posted_by(); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="entry-content entry-content-muted">
                                            <?php
                                            if (has_excerpt()) {

                                                the_excerpt();

                                            } else {

                                                echo '<p>';
                                                echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                echo '</p>';

                                            } ?>
                                        </div>

                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="theme-widget-panel theme-svg-seperator">
                            <?php bigbulletin_theme_svg('seperator'); ?>
                        </div>
                        <div class="theme-widget-panel widget-panel-2">
                            <?php $i++;
                            } else { ?>
                                <div class="widget-story-list">
                                    <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-catalogue'); ?>>
                                        <div class="article-content mb-xs-20">
                                            <?php if ($params['enable_meta'] == 'yes') { ?>
                                                <div class="entry-meta">
                                                    <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>
                                            <?php } ?>

                                            <h3 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>

                                            <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                                <div class="entry-meta">
                                                    <?php bigbulletin_posted_by(); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="data-bg data-bg-small"
                                                 data-background="<?php echo esc_url($featured_image); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>"
                                                   tabindex="0"></a></a>
                                            </div>
                                        <?php endif; ?>
                                    </article>
                                </div>
                                <?php if ($style_1_posts_query->current_post + 1 == $style_1_posts_query->post_count) {
                                    echo '</div>';
                                } ?>
                            <?php } ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php if (!empty($params['button_text']) && !empty($cat_link)) { ?>
                        <div class="theme-widget-footer">
                            <div class="widget-footer-panel">
                                <hr>
                                <a class="theme-viewmore-link"
                                   href="<?php echo esc_url($cat_link); ?>"><?php echo $params['button_text']; ?></a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } elseif ($display_orientation == 'layout-3') { ?>


                    <div class="theme-widget widget-layout widget-layout-3">
                    <?php if (!empty($params['title'])) { ?>
                        <div class="theme-widget-title">
                            <h2 class="widget-title">
                                <span> <?php echo $params['title'] ?></span>
                            </h2>
                        </div>
                    <?php } ?>

                    <div class="theme-widget-content">
                        <?php
                        $i = 1;
                        while ($style_1_posts_query->have_posts()) :
                        $style_1_posts_query->the_post(); ?>
                        <?php if ($i == 1) { ?>
                        <div class="theme-widget-panel widget-panel-1">
                            <div class="widget-story-jumbotron mb-20">
                                <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-mega'); ?>>

                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="data-bg data-bg-large" data-background="<?php echo esc_url($featured_image); ?>">
                                            <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                        </div>
                                    <?php endif; ?>


                                    <div class="article-content mt-sm-15">
                                        <?php if ($params['enable_meta'] == 'yes') { ?>
                                            <div class="entry-meta">
                                                <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                            </div>
                                        <?php } ?>
                                        <h3 class="entry-title entry-title-big">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>

                                        <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                            <div class="entry-meta">
                                                <?php bigbulletin_posted_by(); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="entry-content entry-content-muted">
                                            <?php
                                            if (has_excerpt()) {

                                                the_excerpt();

                                            } else {

                                                echo '<p>';
                                                echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                echo '</p>';

                                            } ?>
                                        </div>

                                    </div>
                                </article>
                            </div>
                        </div>

                        <div class="theme-widget-panel widget-panel-2 mt-20">
                            <?php $i++;
                            } else { ?>
                                <div class="widget-story-panel">
                                    <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="data-bg data-bg-medium" data-background="<?php echo esc_url($featured_image); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a></a>
                                            </div>
                                        <?php endif; ?>

                                        <div class="article-content">
                                            <?php if ($params['enable_meta'] == 'yes') { ?>
                                                <div class="entry-meta">
                                                    <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>
                                            <?php } ?>

                                            <h3 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>

                                            <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                                <div class="entry-meta">
                                                    <?php bigbulletin_posted_by(); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </article>
                                </div>
                                <?php if ($style_1_posts_query->current_post + 1 == $style_1_posts_query->post_count) {
                                    echo '</div>';
                                } ?>
                            <?php } ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php if (!empty($params['button_text']) && !empty($cat_link)) { ?>
                        <div class="theme-widget-footer">
                            <div class="widget-footer-panel">
                                <hr>
                                <a class="theme-viewmore-link"
                                   href="<?php echo esc_url($cat_link); ?>"><?php echo $params['button_text']; ?></a>
                            </div>
                        </div>
                    <?php } ?>

                <?php } ?>
            <?php endif;
            echo $args['after_widget'];
        }
    }
endif;