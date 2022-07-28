<?php
/**
* Sidebar Metabox.
*
* @package BigBulletin
*/
 
add_action( 'add_meta_boxes', 'bigbulletin_metabox' );

if( ! function_exists( 'bigbulletin_metabox' ) ):


    function  bigbulletin_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'bigbulletin' ),
            'bigbulletin_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'bigbulletin' ),
            'bigbulletin_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$bigbulletin_page_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'bigbulletin' ),
    'layout-2' => esc_html__( 'Banner Layout', 'bigbulletin' ),
);

$bigbulletin_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'bigbulletin' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'bigbulletin' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'bigbulletin' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'bigbulletin' ),
                ),
);

$bigbulletin_post_layout_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'bigbulletin' ),
    'layout-1' => esc_html__( 'Simple Layout', 'bigbulletin' ),
    'layout-2' => esc_html__( 'Banner Layout', 'bigbulletin' ),
);

$bigbulletin_header_overlay_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'bigbulletin' ),
    'enable-overlay' => esc_html__( 'Enable Header Overlay', 'bigbulletin' ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'bigbulletin_post_metafield_callback' ) ):
    
    function bigbulletin_post_metafield_callback() {
        global $post, $bigbulletin_post_sidebar_fields, $bigbulletin_post_layout_options,  $bigbulletin_page_layout_options, $bigbulletin_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'bigbulletin_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'bigbulletin'); ?>

                        </a>
                    </li>

                    <li>
                        <a id="metabox-navbar-appearance" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'bigbulletin'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'bigbulletin'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','bigbulletin'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $bigbulletin_post_sidebar = esc_html( get_post_meta( $post->ID, 'bigbulletin_post_sidebar_option', true ) );
                            if( $bigbulletin_post_sidebar == '' ){ $bigbulletin_post_sidebar = 'global-sidebar'; }

                            foreach ( $bigbulletin_post_sidebar_fields as $bigbulletin_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="bigbulletin_post_sidebar_option" value="<?php echo esc_attr( $bigbulletin_post_sidebar_field['value'] ); ?>" <?php if( $bigbulletin_post_sidebar_field['value'] == $bigbulletin_post_sidebar ){ echo "checked='checked'";} if( empty( $bigbulletin_post_sidebar ) && $bigbulletin_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $bigbulletin_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                    <?php if( $post_type == 'page' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','bigbulletin'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $bigbulletin_page_layout = esc_html( get_post_meta( $post->ID, 'bigbulletin_page_layout', true ) );
                                if( $bigbulletin_page_layout == '' ){ $bigbulletin_page_layout = 'layout-1'; }

                                foreach ( $bigbulletin_page_layout_options as $key => $bigbulletin_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="bigbulletin_page_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $bigbulletin_page_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $bigbulletin_page_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','bigbulletin'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $bigbulletin_ed_header_overlay = esc_attr( get_post_meta( $post->ID, 'bigbulletin_ed_header_overlay', true ) ); ?>

                                <input type="checkbox" id="bigbulletin-header-overlay" name="bigbulletin_ed_header_overlay" value="1" <?php if( $bigbulletin_ed_header_overlay ){ echo "checked='checked'";} ?>/>

                                <label for="bigbulletin-header-overlay"><?php esc_html_e( 'Enable Header Overlay','bigbulletin' ); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if( $post_type == 'post' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','bigbulletin'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $bigbulletin_post_layout = esc_html( get_post_meta( $post->ID, 'bigbulletin_post_layout', true ) );
                                if( $bigbulletin_post_layout == '' ){ $bigbulletin_post_layout = 'global-layout'; }

                                foreach ( $bigbulletin_post_layout_options as $key => $bigbulletin_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="bigbulletin_post_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $bigbulletin_post_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $bigbulletin_post_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','bigbulletin'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $bigbulletin_header_overlay = esc_html( get_post_meta( $post->ID, 'bigbulletin_header_overlay', true ) );
                                if( $bigbulletin_header_overlay == '' ){ $bigbulletin_header_overlay = 'global-layout'; }

                                foreach ( $bigbulletin_header_overlay_options as $key => $bigbulletin_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="bigbulletin_header_overlay" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $bigbulletin_header_overlay ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $bigbulletin_header_overlay_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Feature Image Setting','bigbulletin'); ?></h3>

                        <div class="metabox-opt-wrap theme-checkbox-wrap">

                            <?php
                            $bigbulletin_ed_feature_image = esc_html( get_post_meta( $post->ID, 'bigbulletin_ed_feature_image', true ) );
                            if (!isset( $_POST['bigbulletin_ed_feature_image'] )) {
                                $bigbulletin_ed_feature_image = get_theme_mod('ed_post_thumbnail');
                            }
                            ?>

                            <input type="checkbox" id="bigbulletin-ed-feature-image" name="bigbulletin_ed_feature_image" value="<?php echo $bigbulletin_default_feature_image; ?>" <?php if( $bigbulletin_ed_feature_image ){ echo "checked='checked'";} ?>/>

                            <label for="bigbulletin-ed-feature-image"><?php esc_html_e( 'Disable Feature Image','bigbulletin' ); ?></label>


                        </div>

                    </div>

                     <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','bigbulletin'); ?></h3>

                        <?php $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Navigation Type','bigbulletin' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','bigbulletin'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','bigbulletin'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php esc_html_e('Next Previous Navigation','bigbulletin'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','bigbulletin'); ?></option>

                            </select>

                        </div>
                    </div>

                </div>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $bigbulletin_ed_post_views = esc_html( get_post_meta( $post->ID, 'bigbulletin_ed_post_views', true ) );
                    $bigbulletin_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'bigbulletin_ed_post_read_time', true ) );
                    $bigbulletin_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'bigbulletin_ed_post_like_dislike', true ) );
                    $bigbulletin_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'bigbulletin_ed_post_author_box', true ) );
                    $bigbulletin_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'bigbulletin_ed_post_social_share', true ) );
                    $bigbulletin_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'bigbulletin_ed_post_reaction', true ) );
                    $bigbulletin_ed_post_rating = esc_html( get_post_meta( $post->ID, 'bigbulletin_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','bigbulletin'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="bigbulletin-ed-post-views" name="bigbulletin_ed_post_views" value="1" <?php if( $bigbulletin_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="bigbulletin-ed-post-views"><?php esc_html_e( 'Disable Post Views','bigbulletin' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="bigbulletin-ed-post-read-time" name="bigbulletin_ed_post_read_time" value="1" <?php if( $bigbulletin_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                    <label for="bigbulletin-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','bigbulletin' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="bigbulletin-ed-post-like-dislike" name="bigbulletin_ed_post_like_dislike" value="1" <?php if( $bigbulletin_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="bigbulletin-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','bigbulletin' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="bigbulletin-ed-post-author-box" name="bigbulletin_ed_post_author_box" value="1" <?php if( $bigbulletin_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="bigbulletin-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','bigbulletin' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="bigbulletin-ed-post-social-share" name="bigbulletin_ed_post_social_share" value="1" <?php if( $bigbulletin_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="bigbulletin-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','bigbulletin' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="bigbulletin-ed-post-reaction" name="bigbulletin_ed_post_reaction" value="1" <?php if( $bigbulletin_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="bigbulletin-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','bigbulletin' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="bigbulletin-ed-post-rating" name="bigbulletin_ed_post_rating" value="1" <?php if( $bigbulletin_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="bigbulletin-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','bigbulletin' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'bigbulletin_save_post_meta' );

if( ! function_exists( 'bigbulletin_save_post_meta' ) ):

    function bigbulletin_save_post_meta( $post_id ) {

        global $post, $bigbulletin_post_sidebar_fields, $bigbulletin_post_layout_options, $bigbulletin_header_overlay_options,  $bigbulletin_page_layout_options;

        if ( !isset( $_POST[ 'bigbulletin_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bigbulletin_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $bigbulletin_post_sidebar_fields as $bigbulletin_post_sidebar_field ) {
            

                $old = esc_html( get_post_meta( $post_id, 'bigbulletin_post_sidebar_option', true ) );
                $new = isset( $_POST['bigbulletin_post_sidebar_option'] ) ? bigbulletin_sanitize_sidebar_option_meta( wp_unslash( $_POST['bigbulletin_post_sidebar_option'] ) ) : '';

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'bigbulletin_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'bigbulletin_post_sidebar_option', $old );

                }

            
        }

        $twp_disable_ajax_load_next_post_old = esc_html( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? bigbulletin_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '';

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }


        foreach ( $bigbulletin_post_layout_options as $bigbulletin_post_layout_option ) {
            
            $bigbulletin_post_layout_old = esc_html( get_post_meta( $post_id, 'bigbulletin_post_layout', true ) );
            $bigbulletin_post_layout_new = isset( $_POST['bigbulletin_post_layout'] ) ? bigbulletin_sanitize_post_layout_option_meta( wp_unslash( $_POST['bigbulletin_post_layout'] ) ) : '';

            if ( $bigbulletin_post_layout_new && $bigbulletin_post_layout_new != $bigbulletin_post_layout_old ){

                update_post_meta ( $post_id, 'bigbulletin_post_layout', $bigbulletin_post_layout_new );

            }elseif( '' == $bigbulletin_post_layout_new && $bigbulletin_post_layout_old ) {

                delete_post_meta( $post_id,'bigbulletin_post_layout', $bigbulletin_post_layout_old );

            }
            
        }



        foreach ( $bigbulletin_header_overlay_options as $bigbulletin_header_overlay_option ) {
            
            $bigbulletin_header_overlay_old = esc_html( get_post_meta( $post_id, 'bigbulletin_header_overlay', true ) );
            $bigbulletin_header_overlay_new = isset( $_POST['bigbulletin_header_overlay'] ) ? bigbulletin_sanitize_header_overlay_option_meta( wp_unslash( $_POST['bigbulletin_header_overlay'] ) ) : '';

            if ( $bigbulletin_header_overlay_new && $bigbulletin_header_overlay_new != $bigbulletin_header_overlay_old ){

                update_post_meta ( $post_id, 'bigbulletin_header_overlay', $bigbulletin_header_overlay_new );

            }elseif( '' == $bigbulletin_header_overlay_new && $bigbulletin_header_overlay_old ) {

                delete_post_meta( $post_id,'bigbulletin_header_overlay', $bigbulletin_header_overlay_old );

            }
            
        }



        $bigbulletin_ed_feature_image_old = esc_html( get_post_meta( $post_id, 'bigbulletin_ed_feature_image', true ) );
        $bigbulletin_ed_feature_image_new = isset( $_POST['bigbulletin_ed_feature_image'] ) ? absint( wp_unslash( $_POST['bigbulletin_ed_feature_image'] ) ) : '';

        if ( $bigbulletin_ed_feature_image_new && $bigbulletin_ed_feature_image_new != $bigbulletin_ed_feature_image_old ){

            update_post_meta ( $post_id, 'bigbulletin_ed_feature_image', $bigbulletin_ed_feature_image_new );

        }elseif( '' == $bigbulletin_ed_feature_image_new && $bigbulletin_ed_feature_image_old ) {

            delete_post_meta( $post_id,'bigbulletin_ed_feature_image', $bigbulletin_ed_feature_image_old );

        }



        $bigbulletin_ed_post_views_old = esc_html( get_post_meta( $post_id, 'bigbulletin_ed_post_views', true ) );
        $bigbulletin_ed_post_views_new = isset( $_POST['bigbulletin_ed_post_views'] ) ? absint( wp_unslash( $_POST['bigbulletin_ed_post_views'] ) ) : '';

        if ( $bigbulletin_ed_post_views_new && $bigbulletin_ed_post_views_new != $bigbulletin_ed_post_views_old ){

            update_post_meta ( $post_id, 'bigbulletin_ed_post_views', $bigbulletin_ed_post_views_new );

        }elseif( '' == $bigbulletin_ed_post_views_new && $bigbulletin_ed_post_views_old ) {

            delete_post_meta( $post_id,'bigbulletin_ed_post_views', $bigbulletin_ed_post_views_old );

        }



        $bigbulletin_ed_post_read_time_old = esc_html( get_post_meta( $post_id, 'bigbulletin_ed_post_read_time', true ) );
        $bigbulletin_ed_post_read_time_new = isset( $_POST['bigbulletin_ed_post_read_time'] ) ? absint( wp_unslash( $_POST['bigbulletin_ed_post_read_time'] ) ) : '';

        if ( $bigbulletin_ed_post_read_time_new && $bigbulletin_ed_post_read_time_new != $bigbulletin_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'bigbulletin_ed_post_read_time', $bigbulletin_ed_post_read_time_new );

        }elseif( '' == $bigbulletin_ed_post_read_time_new && $bigbulletin_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'bigbulletin_ed_post_read_time', $bigbulletin_ed_post_read_time_old );

        }



        $bigbulletin_ed_post_like_dislike_old = esc_html( get_post_meta( $post_id, 'bigbulletin_ed_post_like_dislike', true ) );
        $bigbulletin_ed_post_like_dislike_new = isset( $_POST['bigbulletin_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['bigbulletin_ed_post_like_dislike'] ) ) : '';

        if ( $bigbulletin_ed_post_like_dislike_new && $bigbulletin_ed_post_like_dislike_new != $bigbulletin_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'bigbulletin_ed_post_like_dislike', $bigbulletin_ed_post_like_dislike_new );

        }elseif( '' == $bigbulletin_ed_post_like_dislike_new && $bigbulletin_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'bigbulletin_ed_post_like_dislike', $bigbulletin_ed_post_like_dislike_old );

        }



        $bigbulletin_ed_post_author_box_old = esc_html( get_post_meta( $post_id, 'bigbulletin_ed_post_author_box', true ) );
        $bigbulletin_ed_post_author_box_new = isset( $_POST['bigbulletin_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['bigbulletin_ed_post_author_box'] ) ) : '';

        if ( $bigbulletin_ed_post_author_box_new && $bigbulletin_ed_post_author_box_new != $bigbulletin_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'bigbulletin_ed_post_author_box', $bigbulletin_ed_post_author_box_new );

        }elseif( '' == $bigbulletin_ed_post_author_box_new && $bigbulletin_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'bigbulletin_ed_post_author_box', $bigbulletin_ed_post_author_box_old );

        }



        $bigbulletin_ed_post_social_share_old = esc_html( get_post_meta( $post_id, 'bigbulletin_ed_post_social_share', true ) );
        $bigbulletin_ed_post_social_share_new = isset( $_POST['bigbulletin_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['bigbulletin_ed_post_social_share'] ) ) : '';

        if ( $bigbulletin_ed_post_social_share_new && $bigbulletin_ed_post_social_share_new != $bigbulletin_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'bigbulletin_ed_post_social_share', $bigbulletin_ed_post_social_share_new );

        }elseif( '' == $bigbulletin_ed_post_social_share_new && $bigbulletin_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'bigbulletin_ed_post_social_share', $bigbulletin_ed_post_social_share_old );

        }



        $bigbulletin_ed_post_reaction_old = esc_html( get_post_meta( $post_id, 'bigbulletin_ed_post_reaction', true ) );
        $bigbulletin_ed_post_reaction_new = isset( $_POST['bigbulletin_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['bigbulletin_ed_post_reaction'] ) ) : '';

        if ( $bigbulletin_ed_post_reaction_new && $bigbulletin_ed_post_reaction_new != $bigbulletin_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'bigbulletin_ed_post_reaction', $bigbulletin_ed_post_reaction_new );

        }elseif( '' == $bigbulletin_ed_post_reaction_new && $bigbulletin_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'bigbulletin_ed_post_reaction', $bigbulletin_ed_post_reaction_old );

        }



        $bigbulletin_ed_post_rating_old = esc_html( get_post_meta( $post_id, 'bigbulletin_ed_post_rating', true ) );
        $bigbulletin_ed_post_rating_new = isset( $_POST['bigbulletin_ed_post_rating'] ) ? absint( wp_unslash( $_POST['bigbulletin_ed_post_rating'] ) ) : '';

        if ( $bigbulletin_ed_post_rating_new && $bigbulletin_ed_post_rating_new != $bigbulletin_ed_post_rating_old ){

            update_post_meta ( $post_id, 'bigbulletin_ed_post_rating', $bigbulletin_ed_post_rating_new );

        }elseif( '' == $bigbulletin_ed_post_rating_new && $bigbulletin_ed_post_rating_old ) {

            delete_post_meta( $post_id,'bigbulletin_ed_post_rating', $bigbulletin_ed_post_rating_old );

        }

        foreach ( $bigbulletin_page_layout_options as $bigbulletin_post_layout_option ) {
        
            $bigbulletin_page_layout_old = sanitize_text_field( get_post_meta( $post_id, 'bigbulletin_page_layout', true ) );
            $bigbulletin_page_layout_new = isset( $_POST['bigbulletin_page_layout'] ) ? bigbulletin_sanitize_post_layout_option_meta( wp_unslash( $_POST['bigbulletin_page_layout'] ) ) : '';

            if ( $bigbulletin_page_layout_new && $bigbulletin_page_layout_new != $bigbulletin_page_layout_old ){

                update_post_meta ( $post_id, 'bigbulletin_page_layout', $bigbulletin_page_layout_new );

            }elseif( '' == $bigbulletin_page_layout_new && $bigbulletin_page_layout_old ) {

                delete_post_meta( $post_id,'bigbulletin_page_layout', $bigbulletin_page_layout_old );

            }
            
        }

        $bigbulletin_ed_header_overlay_old = absint( get_post_meta( $post_id, 'bigbulletin_ed_header_overlay', true ) );
        $bigbulletin_ed_header_overlay_new = isset( $_POST['bigbulletin_ed_header_overlay'] ) ? absint( wp_unslash( $_POST['bigbulletin_ed_header_overlay'] ) ) : '';

        if ( $bigbulletin_ed_header_overlay_new && $bigbulletin_ed_header_overlay_new != $bigbulletin_ed_header_overlay_old ){

            update_post_meta ( $post_id, 'bigbulletin_ed_header_overlay', $bigbulletin_ed_header_overlay_new );

        }elseif( '' == $bigbulletin_ed_header_overlay_new && $bigbulletin_ed_header_overlay_old ) {

            delete_post_meta( $post_id,'bigbulletin_ed_header_overlay', $bigbulletin_ed_header_overlay_old );

        }

    }

endif;   