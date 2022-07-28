<?php
/**
 * Article Banner Slider Widget Style
 *
 * @package BigBulletin
 */
if (!function_exists('bigbulletin_post_banner_slider_widget')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function bigbulletin_post_banner_slider_widget()
    {
        register_widget('BigBulletin_Post_Banner_Slider_Widget');
    }
endif;
add_action('widgets_init', 'bigbulletin_post_banner_slider_widget');
// Article Widget Carousel Layout
if (!class_exists('BigBulletin_Post_Banner_Slider_Widget')) :
    /**
     * Article Widget Carousel Layout
     *
     * @since 1.0.0
     */
    class BigBulletin_Post_Banner_Slider_Widget extends BigBulletin_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'bigbulletin_post_banner_slider_widget',
                'description' => esc_html__('Displays post form selected category in banner slider styles', 'bigbulletin'),
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
                'post_number' => array(
                    'label' => esc_html__('Number of posts to show:', 'bigbulletin'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
                'enable_meta' => array(
                    'label' => esc_html__('Enable Categories:', 'bigbulletin'),
                    'type' => 'checkbox',
                    'default' => true,
                ),                
                'enable_autoplay' => array(
                    'label' => esc_html__('Enable Autoplay:', 'bigbulletin'),
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
            parent::__construct('bigbulletin-widget-banner-slider-style', esc_html__('BigBulletin: Slider Widget', 'bigbulletin'), $opts, array(), $fields);
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
            $post_number = $params['post_number'];
            $qargs = array(
                'post_type' => 'post',
                'posts_per_page' => $post_number,
                'post__not_in' => get_option("sticky_posts"),
            );
            $cat_link = "";

            if( is_rtl() ) {
                $rtl = 'right';
            }else{
                $rtl = 'left';
            }
            if( !empty($params['enable_autoplay']) ) {
                $autoplay = 'true';
            }else{
                $autoplay = 'false';
            }

            if (absint($params['post_category']) > 0) {
                $qargs['cat'] = absint($params['post_category']);
                $cat_link = get_category_link($params['post_category']);
            }
            $style_1_posts_query = new WP_Query($qargs);
            if ($style_1_posts_query->have_posts()) : ?>
                <div class="widget-layout widget-layout-slider">
                    <header class="theme-widget-header">
                        <div class="theme-widget-title">
                            <?php if (!empty($params['title'])) { ?>
                                <h2 class="widget-title">
                                    <?php echo $params['title'] ?>
                                </h2>
                            <?php } ?>
                        </div>
                    </header>
                    <div class="theme-widget-content">
                        <div class="widget-slider-panel">
                            <div class="theme-widget-slider" data-slick='{ "autoplay": <?php echo esc_attr($autoplay); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                                <?php
                                while ($style_1_posts_query->have_posts()) :
                                    $style_1_posts_query->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                    <div class="slick-slide-widget">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                            <div class="data-bg data-bg-xlarge data-bg-overlay" data-background="<?php echo esc_url($featured_image); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" tabindex="0"></a>
                                            </div>
                                            <div class="article-content mt-30">
                                                <div class="entry-meta">
                                                    <?php bigbulletin_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>
                                                <h3 class="entry-title entry-title-large">
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
                                    <?php
                                    wp_reset_postdata();
                                endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($params['button_text']) && !empty($cat_link)) { ?>
                        <div class="theme-footer-link theme-widget-footer">
                            <div class="theme-footer-panel widget-footer-panel">
                                <hr>
                                <a class="theme-viewmore-link" href="<?php echo esc_url($cat_link); ?>"><?php echo $params['button_text']; ?></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php endif;
            echo $args['after_widget'];
        }
    }
endif;