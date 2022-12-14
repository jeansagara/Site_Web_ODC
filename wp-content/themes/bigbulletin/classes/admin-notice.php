<?php
if ( !class_exists('BigBulletin_Dashboard_Notice') ):

    class BigBulletin_Dashboard_Notice
    {
        function __construct()
        {	
            global $pagenow;

        	if( $this->bigbulletin_show_hide_notice() ){

	            add_action( 'admin_notices',array( $this,'bigbulletin_admin_notiece' ) );
                
	        }
	        add_action( 'wp_ajax_bigbulletin_notice_dismiss', array( $this, 'bigbulletin_notice_dismiss' ) );
			add_action( 'switch_theme', array( $this, 'bigbulletin_notice_clear_cache' ) );
        
            if( isset( $_GET['page'] ) && $_GET['page'] == 'bigbulletin-about' ){

                add_action('in_admin_header', array( $this,'bigbulletin_hide_all_admin_notice' ),1000 );

            }
        }

        public function bigbulletin_hide_all_admin_notice(){

            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');

        }
        
        public static function bigbulletin_show_hide_notice( $status = false ){

            if( $status ){

                if( (class_exists( 'Booster_Extension_Class' ) ) || get_option('bigbulletin_admin_notice') ){

                    return false;

                }else{

                    return true;

                }

            }

            // Check If current Page 
            if ( isset( $_GET['page'] ) && $_GET['page'] == 'bigbulletin-about'  ) {
                return false;
            }

        	// Hide if dismiss notice
        	if( get_option('bigbulletin_admin_notice') ){
				return false;
			}
        	// Hide if all plugin active
        	if ( class_exists( 'Booster_Extension_Class' ) ) {
				return false;
			}
			// Hide On TGMPA pages
			if ( ! empty( $_GET['tgmpa-nonce'] ) ) {
				return false;
			}
			// Hide if user can't access
        	if ( current_user_can( 'manage_options' ) ) {
				return true;
			}
			
        }

        // Define Global Value
        public static function bigbulletin_admin_notiece(){

            $theme_info      = wp_get_theme();
            $theme_name            = $theme_info->__get( 'Name' );
            ?>
           <div class="updated notice is-dismissible twp-bigbulletin-notice">

                <h3><?php esc_html_e('Quick Setup','bigbulletin'); ?></h3>

                <p><strong><?php printf( __( '%1$s is now installed and ready to use. Are you looking for a better experience to set up your site?', 'bigbulletin' ), esc_html( $theme_name ) ); ?></strong></p>

                <small><?php esc_html_e("We've prepared a unique onboarding process through our",'bigbulletin'); ?> <a href="<?php echo esc_url( admin_url().'themes.php?page='.get_template().'-about') ?>"><?php esc_html_e('Getting started','bigbulletin'); ?></a> <?php esc_html_e("page. It helps you get started and configure your upcoming website with ease. Let's make it shine!",'bigbulletin'); ?></small>

                <p>
                    <a class="button button-primary twp-install-active" href="javascript:void(0)"><?php esc_html_e('Install and activate recommended plugins','bigbulletin'); ?></a>
                    <span class="quick-loader-wrapper"><span class="quick-loader"></span></span>

                    <a target="_blank" class="button button-primary" href="<?php echo esc_url( 'https://live-preview.themeinwp.com/bigbulletin/' ); ?>"><?php esc_html_e('View Demo','bigbulletin'); ?></a>
                    <a target="_blank" class="button button-primary button-primary-upgrade" href="<?php echo esc_url( 'https://www.themeinwp.com/theme/bigbulletin-pro/' ); ?>"><?php esc_html_e('Upgrade to Pro','bigbulletin'); ?></a>
                    <a class="btn-dismiss twp-custom-setup" href="javascript:void(0)"><?php esc_html_e('Dismiss this notice.','bigbulletin'); ?></a>

                </p>

            </div>

        <?php
        }

        public function bigbulletin_notice_dismiss(){

        	if ( isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'bigbulletin_ajax_nonce' ) ) {

	        	update_option('bigbulletin_admin_notice','hide');

	        }

            die();

        }

        public function bigbulletin_notice_clear_cache(){

        	update_option('bigbulletin_admin_notice','');

        }

    }
    new BigBulletin_Dashboard_Notice();
endif;