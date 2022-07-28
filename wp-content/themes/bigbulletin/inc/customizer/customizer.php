<?php
/**
 * BigBulletin Theme Customizer
 *
 * @package BigBulletin
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('bigbulletin_customize_register')) :

function bigbulletin_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/active-callback.php';
	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/layout.php';
	require get_template_directory() . '/inc/customizer/date-ticker-header.php';
	require get_template_directory() . '/inc/customizer/header.php';
	require get_template_directory() . '/inc/customizer/repeater.php';
	require get_template_directory() . '/inc/customizer/pagination.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/single.php';
	require get_template_directory() . '/inc/customizer/footer.php';
	require get_template_directory() . '/inc/customizer/asidebar.php';

	$wp_customize->get_section( 'colors' )->panel = 'theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','bigbulletin');
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'header_image' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';
    


	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'bigbulletin_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'bigbulletin_customize_partial_blogdescription',
		) );
	}
	
	$bigbulletin_default = bigbulletin_get_default_theme_options();
	$wp_customize->add_setting('logo_width_range',
	    array(
	        'default'           => $bigbulletin_default['logo_width_range'],
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'bigbulletin_sanitize_number_range',
	    )
	);
	$wp_customize->add_control('logo_width_range',
	    array(
	        'label'       => esc_html__('Logo With', 'bigbulletin'),
	        'description'       => esc_html__( 'Define logo size min-200 to max-700 (step-20)', 'bigbulletin' ),
	        'section'     => 'title_tagline',
	        'type'        => 'range',
	        'input_attrs' => array(
				           'min'   => 200,
				           'max'   => 700,
				           'step'   => 20,
			        	),
	    )
	);
	$wp_customize->add_setting('site_title_font_size',
	    array(
	        'default'           => $bigbulletin_default['site_title_font_size'],
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'bigbulletin_sanitize_number_range',
	    )
	);
	$wp_customize->add_control('site_title_font_size',
	    array(
	        'label'       => esc_html__('Site Title Font size', 'bigbulletin'),
	        'description'       => esc_html__( 'Define Site title font size min-32 to max-150 (step-2)', 'bigbulletin' ),
	        'section'     => 'title_tagline',
	        'type'        => 'range',
	        'input_attrs' => array(
				           'min'   => 32,
				           'max'   => 150,
				           'step'   => 2,
			        	),
	    )
	);

	$wp_customize->add_setting( 'bigbulletin_general_color',
	    array(
	    'default'           => $bigbulletin_default['bigbulletin_general_color'],
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
	$wp_customize->add_control( 
	    new WP_Customize_Color_Control( 
	    $wp_customize, 
	    'bigbulletin_general_color',
	    array(
	        'label'      => esc_html__( 'General Text Color', 'bigbulletin' ),
	        'section'    => 'colors',
	        'settings'   => 'bigbulletin_general_color',
	    ) ) 
	);


	$wp_customize->add_setting( 'bigbulletin_link_color',
	    array(
	    'default'           => $bigbulletin_default['bigbulletin_link_color'],
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
	$wp_customize->add_control( 
	    new WP_Customize_Color_Control( 
	    $wp_customize, 
	    'bigbulletin_link_color',
	    array(
	        'label'      => esc_html__( 'General Link Color', 'bigbulletin' ),
	        'section'    => 'colors',
	        'settings'   => 'bigbulletin_link_color',
	    ) ) 
	);

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'bigbulletin' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'bigbulletin' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'bigbulletin' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);

	// Template Options
	$wp_customize->add_panel( 'theme_template_pannel',
		array(
			'title'      => esc_html__( 'Template Settings', 'bigbulletin' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Register custom section types.
	$wp_customize->register_section_type( 'BigBulletin_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new BigBulletin_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'BigBulletin Pro', 'bigbulletin' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'bigbulletin' ),
				'pro_url'  => esc_url('https://www.themeinwp.com/theme/bigbulletin-pro/'),
				'priority'  => 1,
			)
		)
	);

}

endif;
add_action( 'customize_register', 'bigbulletin_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('bigbulletin_customizer_scripts')) :

    function bigbulletin_customizer_scripts(){
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('bigbulletin-customizer', get_template_directory_uri() . '/assets/lib/custom/css/customizer.css');
        wp_enqueue_script('bigbulletin-customizer', get_template_directory_uri() . '/assets/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);

        $ajax_nonce = wp_create_nonce('bigbulletin_customizer_ajax_nonce');
        wp_localize_script( 
		    'bigbulletin-customizer', 
		    'bigbulletin_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'bigbulletin_customizer_scripts');
add_action('customize_controls_init', 'bigbulletin_customizer_scripts');

/**
 * Customizer Enqueue scripts and styles.
 */
function bigbulletin_customizer_repearer(){
	
	wp_enqueue_style('bigbulletin-repeater', get_template_directory_uri() . '/assets/lib/custom/css/repeater.css');
    wp_enqueue_script('bigbulletin-repeater', get_template_directory_uri() . '/assets/lib/custom/js/repeater.js', array('jquery','customize-controls'), '', 1);

    $bigbulletin_post_category_list = bigbulletin_post_category_list();

    $cat_option = '';

    if( $bigbulletin_post_category_list ){
	    foreach( $bigbulletin_post_category_list as $key => $cats ){
	    	$cat_option .= "<option value='". esc_attr( $key )."'>". esc_html( $cats )."</option>";
	    }
	}

    wp_localize_script( 
        'bigbulletin-repeater', 
        'bigbulletin_repeater',
        array(
            'optionns'   => "
            				<option selected='selected' value='tiles-blocks'>". esc_html__('Tiles Block','bigbulletin')."</option>
            				<option value='main-banner'>". esc_html__('Main Banner Slider','bigbulletin')."</option>
            				<option value='grid-list-block'>". esc_html__('Grid-List Block','bigbulletin')."</option>
            				<option value='banner-blocks-1'>". esc_html__('Slider & Tab Block','bigbulletin')."</option>
            				<option value='latest-posts-blocks'>". esc_html__('Latest Posts Block','bigbulletin')."</option>
        					<option value='advertise-blocks'>". esc_html__('Advertise Block','bigbulletin')."</option>
            				<option value='home-widget-area'>". esc_html__('Widgets Area Block','bigbulletin')."</option
        					<option value='you-may-like-blocks'>". esc_html__('You May Like Block','bigbulletin')."</option>",
           	'categories'   => $cat_option,
            'new_section'   =>  esc_html__('New Section','bigbulletin'),
            'upload_image'   =>  esc_html__('Choose Image','bigbulletin'),
            'use_image'   =>  esc_html__('Select','bigbulletin'),
         )
    );

    wp_localize_script( 
        'bigbulletin-customizer', 
        'bigbulletin_customizer',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
         )
    );
}

add_action('customize_controls_enqueue_scripts', 'bigbulletin_customizer_repearer');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('bigbulletin_customize_partial_blogname')) :

	function bigbulletin_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('bigbulletin_customize_partial_blogdescription')) :

	function bigbulletin_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bigbulletin_customize_preview_js() {
	wp_enqueue_script( 'bigbulletin-customizer-preview', get_template_directory_uri() . '/assets/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bigbulletin_customize_preview_js' );