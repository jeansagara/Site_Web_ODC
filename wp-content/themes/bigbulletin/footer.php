<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BigBulletin
 * @since 1.0.0
 */
?>

<?php if ( is_active_sidebar('bigbulletin-offcanvas-widget') ): ?>
    <div id="sidr-nav">
        <a class="skip-link-offcanvas-first" href="javascript:void(0)"></a>
        <a class="sidr-offcanvas-close" href="#sidr-nav">
           <span>
               <?php echo esc_html__('Close','bigbulletin'); ?>
            </span>
        </a>
        <div class="sidr-area">
            <?php dynamic_sidebar('bigbulletin-offcanvas-widget'); ?>
        </div>
        <a class="skip-link-offcanvas-last" href="javascript:void(0)"></a>
    </div>
<?php endif; ?>

<?php
/**
 * Toogle Contents
 * @hooked bigbulletin_header_toggle_search - 10
 * @hooked bigbulletin_content_offcanvas - 30
*/

do_action('bigbulletin_before_footer_content_action'); ?>

<footer id="site-footer" role="contentinfo">
    <?php
    /**
     * Footer Content
     * @hooked bigbulletin_footer_content_widget - 10
     * @hooked bigbulletin_footer_content_info - 20
    */

    do_action('bigbulletin_footer_content_action'); ?>

</footer>

</div> <!-- theme-main-panel -->

</div><!--site-content-->


</div>

<?php wp_footer(); ?>
</body>
</html>
