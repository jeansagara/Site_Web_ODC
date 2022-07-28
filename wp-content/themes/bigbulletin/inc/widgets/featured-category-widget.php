<?php
/**
 * Featured Category Widgets.
 *
 * @package BigBulletin
 */


if (!function_exists('bigbulletin_featured_category_widgets')) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function bigbulletin_featured_category_widgets()
    {
        // Recent Post widget.
        register_widget('BigBulletin_Sidebar_Featured_Category_Widget');

    }

endif;
add_action('widgets_init', 'bigbulletin_featured_category_widgets');

// Recent Post widget
if (!class_exists('BigBulletin_Sidebar_Featured_Category_Widget')) :

    /**
     * Recent Post.
     *
     * @since 1.0.0
     */
    class BigBulletin_Sidebar_Featured_Category_Widget extends BigBulletin_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'bigbulletin_featured_category_widget',
                'description' => esc_html__('Displays post list form selected categories.', 'bigbulletin'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title_1' => array(
                    'label' => esc_html__('Title 1:', 'bigbulletin'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_1' => array(
                    'label' => esc_html__('Select Category 1:', 'bigbulletin'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'bigbulletin'),
                ),
                'title_2' => array(
                    'label' => esc_html__('Title 2:', 'bigbulletin'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_2' => array(
                    'label' => esc_html__('Select Category 2:', 'bigbulletin'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'bigbulletin'),
                ),
                'title_3' => array(
                    'label' => esc_html__('Title 3:', 'bigbulletin'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_3' => array(
                    'label' => esc_html__('Select Category 3:', 'bigbulletin'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'bigbulletin'),
                ),
            );

            parent::__construct('bigbulletin-featured-category-layout', esc_html__('BigBulletin: Post List Widget', 'bigbulletin'), $opts, array(), $fields);
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

            //echo '<pre>';print_r($params);

            $col = 0;
            $class_arr = array('column-12','column-6','column-4');
            for($x = 1; $x <= 3; $x++){
                $section_category = isset($params['post_category_' . $x]) ? $params['post_category_' . $x] : '';
                if($section_category){
                    $col++;
                }
            }

            //print_r($col);

            echo $args['before_widget'];
             ?>

            <div class="theme-widget widget-categories-panel">
                <div class="wrapper">
                    <div class="column-row">
                        <?php

                        for ($x = 1; $x <= 3; $x++) {

                            $section_category = isset($params['post_category_' . $x]) ? $params['post_category_' . $x] : '';

                            if ($section_category) {

                                $qargs = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 4,
                                    'post__not_in' => get_option("sticky_posts"),
                                );
                                $qargs['cat'] = $section_category;
                                $category_list_query = new WP_Query($qargs);
                                if ($category_list_query->have_posts()) : ?>
                                    <div class="column <?php echo $class_arr[$col-1]?> column-md-12 column-sm-12">
                                        <div class="widget-panel-title">
                                            <h2 class="widget-title">
                                                <span><?php echo esc_html($params['title_' . $x]); ?></span>
                                            </h2>
                                        </div>
                                        <div class="widget-panel-list">
                                            <?php
                                            $count = 1;
                                            $sm_article_panel = 'news-article-panel';
                                            $sm_article_image = 'entry-title-medium';
                                            while ($category_list_query->have_posts()) :
                                                $category_list_query->the_post();
                                                if ($count != 1){
                                                    $sm_article_panel = 'news-article-list';
                                                    $sm_article_image = 'entry-title-small';
                                                }
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class(array('news-article news-article-bg news-article-bg-1', $sm_article_panel)); ?>>
                                                    <div class="data-bg" data-background="<?php echo esc_url($featured_image); ?>">
                                                        <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                                    </div>
                                                    <div class="article-content">
                                                        <h3 class="entry-title <?php echo esc_attr($sm_article_image); ?>">
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
                                                <?php $count++;
                                                wp_reset_postdata();
                                            endwhile; ?>
                                        </div>
                                    </div>
                                <?php endif;
                            }

                        } ?>

                    </div>
                </div>
            </div>

            <?php
            echo $args['after_widget'];

        }
    }
endif;