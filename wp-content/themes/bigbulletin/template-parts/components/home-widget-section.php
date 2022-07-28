<?php
/**
 * Homepage Main Widget Area
 *
 * @package BigBulletin
 */

if (!function_exists('bigbulletin_case_home_widget_area_block')):

    function bigbulletin_case_home_widget_area_block($bigbulletin_home_section, $repeat_times)
    {
        ?>
        <?php if (is_active_sidebar('front-page-widget-area-1') ) { ?>
            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-bg theme-block-bg-1 theme-block-widgetarea">
                <?php if (is_active_sidebar('front-page-widget-area-1')) { ?>
                    <?php dynamic_sidebar('front-page-widget-area-1'); ?>
                <?php } ?>
            </div>
    <?php } ?>

        <?php
    }

endif;