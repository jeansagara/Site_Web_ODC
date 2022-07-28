<?php

/**
 * BigBulletin About Page
 * @package BigBulletin
 *
*/

if( !class_exists('BigBulletin_About_page') ):

	class BigBulletin_About_page{

		function __construct(){

			add_action('admin_menu', array($this, 'bigbulletin_backend_menu'),999);

		}

		// Add Backend Menu
        function bigbulletin_backend_menu(){

            add_theme_page(esc_html__( 'BigBulletin Options','bigbulletin' ), esc_html__( 'BigBulletin Options','bigbulletin' ), 'activate_plugins', 'bigbulletin-about', array($this, 'bigbulletin_main_page'));

        }

        // Settings Form
        function bigbulletin_main_page(){

            require get_template_directory() . '/classes/about-render.php';

        }

	}

	new BigBulletin_About_page();

endif;