<?php
/**
 * Social Link Widgets.
 *
 * @package BigBulletin
 */

if (!function_exists('bigbulletin_social_link_widget')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function bigbulletin_social_link_widget()
    {

        // Social Link Widget.
        register_widget('BigBulletin_Social_Link_widget');

    }
endif;
add_action('widgets_init', 'bigbulletin_social_link_widget');


/*Social widget*/
if (!class_exists('BigBulletin_Social_Link_widget'))  :

    /**
     * Social widget Class.
     *
     * @since 1.0.0
     */
    class BigBulletin_Social_Link_widget extends BigBulletin_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'bigbulletin_social_widget',
                'description' => esc_html__('Displays Social share.', 'bigbulletin'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'bigbulletin'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'url-fb' => array(
                    'label' => esc_html__('Facebook URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tw' => array(
                    'label' => esc_html__('Twitter URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-lt' => array(
                    'label' => esc_html__('Linkedin URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-ig' => array(
                    'label' => esc_html__('Instagram URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-pt' => array(
                    'label' => esc_html__('Pinterest URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-rt' => array(
                    'label' => esc_html__('Reddit URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-sk' => array(
                    'label' => esc_html__('Skype URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-sc' => array(
                    'label' => esc_html__('Snapchat URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tr' => array(
                    'label' => esc_html__('Tumblr URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-th' => array(
                    'label' => esc_html__('Twitch URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-yt' => array(
                    'label' => esc_html__('Youtube URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-vo' => array(
                    'label' => esc_html__('Vimeo URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-wa' => array(
                    'label' => esc_html__('Whatsapp URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-wp' => array(
                    'label' => esc_html__('WordPress URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-gh' => array(
                    'label' => esc_html__('Github URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-fs' => array(
                    'label' => esc_html__('FourSquare URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-db' => array(
                    'label' => esc_html__('Dribbble URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-vk' => array(
                    'label' => esc_html__('VK URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tiktok' => array(
                    'label' => esc_html__('TikTok URL:', 'bigbulletin'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('bigbulletin-social-layout', esc_html__('BigBulletin: Sidebar Social Widget', 'bigbulletin'), $opts, array(), $fields);
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

            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html($params['title']) . $args['after_title'];
            } ?>

            <div class="theme-social-widget">
                <ul class="social-widget-list">

                    <?php if (!empty($params['url-fb'])) { ?>
                        <li class="theme-social-facebook">
                            <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('facebook'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Facebook', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-tw'])) { ?>
                        <li class="theme-social-twitter">
                            <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('twitter'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Twitter', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-lt'])) { ?>
                        <li class="theme-social-linkedin">
                            <a href="<?php echo esc_url($params['url-lt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('linkedin'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('LinkedIn', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-ig'])) { ?>
                        <li class="theme-social-instagram">
                            <a href="<?php echo esc_url($params['url-ig']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('instagram'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Instagram', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-pt'])) { ?>
                        <li class="theme-social-pinterest">
                            <a href="<?php echo esc_url($params['url-pt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('pinterest'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Pinterest', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-rt'])) { ?>
                        <li class="theme-social-reddit">
                            <a href="<?php echo esc_url($params['url-rt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('reddit'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Reddit', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-sk'])) { ?>
                        <li class="theme-social-skype">
                            <a href="<?php echo esc_url($params['url-sk']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('skype'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Skype', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-sc'])) { ?>
                        <li class="theme-social-snapchat">
                            <a href="<?php echo esc_url($params['url-sc']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('snapchat'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Snapchat', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-tr'])) { ?>
                        <li class="theme-social-tumblr">
                            <a href="<?php echo esc_url($params['url-tr']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('tumblr'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Tumblr', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-th'])) { ?>
                        <li class="theme-social-twitch">
                            <a href="<?php echo esc_url($params['url-th']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('twitch'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Twitch', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-yt'])) { ?>
                        <li class="theme-social-youtube">
                            <a href="<?php echo esc_url($params['url-yt']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('youtube'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Youtube', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-vo'])) { ?>
                        <li class="theme-social-vimeo">
                            <a href="<?php echo esc_url($params['url-vo']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('vimeo'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Vimeo', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-wa'])) { ?>
                        <li class="theme-social-whatsapp">
                            <a href="<?php echo esc_url($params['url-wa']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('whatsapp'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('WhatsApp', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-wp'])) { ?>
                        <li class="theme-social-wordpress">
                            <a href="<?php echo esc_url($params['url-wp']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('wp'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('WordPress', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-gh'])) { ?>
                        <li class="theme-social-github">
                            <a href="<?php echo esc_url($params['url-gh']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('github'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('GitHub', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-fs'])) { ?>
                        <li class="theme-social-foursquare">
                            <a href="<?php echo esc_url($params['url-fs']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('foursquare'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Foursquare', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-db'])) { ?>
                        <li class="theme-social-dribbble">
                            <a href="<?php echo esc_url($params['url-db']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('dribbble'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('Dribbble', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-vk'])) { ?>
                        <li class="theme-social-vk">
                            <a href="<?php echo esc_url($params['url-vk']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('vk'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('VK', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-tiktok'])) { ?>
                        <li class="theme-social-vk">
                            <a href="<?php echo esc_url($params['url-tiktok']); ?>" target="_blank">
                                <span class="theme-social-icons"><?php bigbulletin_theme_svg('tiktok'); ?></span>
                                <span class="theme-social-label"><?php esc_html_e('TikTok', 'bigbulletin'); ?></span>
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

