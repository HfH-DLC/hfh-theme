<?php
/**
 * HfH Theme Customizer
 *
 * @package HfH_Theme
 */

/**
 * Customizer Richtext Control
 */
require_once get_template_directory() . '/inc/class-hfh-theme-tinymce-custom-control.php';

/**
 * Sanitize checkbox input. Returns true if checkbox is checked.
 * 
 * @param bool $checked The input value to be sanitized.
 */
function hfh_theme_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hfh_theme_customize_register( $wp_customize ) {
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'hfh_theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'hfh_theme_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_setting(
		'hfh_copyright',
		array(
			'default'           => '© Copyright ' . date( 'Y' ) . ' HfH',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) 
	);

	$wp_customize->add_setting(
		'hfh_address',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		) 
	);

	$wp_customize->add_setting(
		'hfh_facebook',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) 
	);


	$wp_customize->add_setting(
		'hfh_youtube',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) 
	);


	$wp_customize->add_setting(
		'hfh_linkedin',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) 
	);


	$wp_customize->add_setting(
		'hfh_instagram',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) 
	);


	$wp_customize->add_setting(
		'hfh_twitter',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) 
	);


	$wp_customize->add_setting(
		'hfh_issuu',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		) 
	);

	$wp_customize->add_setting(
		'hfh_footer_logo',
		array(
			'sanitize_callback' => 'absint',
		) 
	);

	$wp_customize->add_setting(
		'hfh_display_teaser_image_placeholder',
		array(
			'default'           => true,
			'sanitize_callback' => 'hfh_theme_sanitize_checkbox',
		) 
	);

	$wp_customize->add_section(
		'hfh-theme',
		array(
			'title'       => __( 'HfH Theme Options', 'hfh-theme' ),
			'description' => __( 'Options specific to the HfH Theme', 'hfh-theme' ),
		) 
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'hfh_footer_logo', 
			array(
				'label'     => __( 'Footer Logo', 'hfh-theme' ),
				'section'   => 'hfh-theme',
				'mime_type' => 'image',
			) 
		)
	);

	$wp_customize->add_control(
		new HfH_Theme_TinyMCE_Custom_Control(
			$wp_customize,
			'hfh_address',
			array(
				'label'   => __( 'Footer Address', 'hfh-theme' ),
				'section' => 'hfh-theme',
			)
		)
	);

	$wp_customize->add_control(
		'hfh_facebook',
		array(
			'label'   => __( 'Facebook', 'hfh-theme' ),
			'type'    => 'url',
			'section' => 'hfh-theme',
		) 
	);

	$wp_customize->add_control(
		'hfh_youtube',
		array(
			'label'   => __( 'Youtube', 'hfh-theme' ),
			'type'    => 'url',
			'section' => 'hfh-theme',
		) 
	);

	$wp_customize->add_control(
		'hfh_linkedin',
		array(
			'label'   => __( 'LinkedIn', 'hfh-theme' ),
			'type'    => 'url',
			'section' => 'hfh-theme',
		) 
	);

	$wp_customize->add_control(
		'hfh_instagram',
		array(
			'label'   => __( 'Instagram', 'hfh-theme' ),
			'type'    => 'url',
			'section' => 'hfh-theme',
		) 
	);

	$wp_customize->add_control(
		'hfh_twitter',
		array(
			'label'   => __( 'Twitter', 'hfh-theme' ),
			'type'    => 'url',
			'section' => 'hfh-theme',
		) 
	);

	$wp_customize->add_control(
		'hfh_issuu',
		array(
			'label'   => __( 'issuu', 'hfh-theme' ),
			'type'    => 'url',
			'section' => 'hfh-theme',
		) 
	);

	$wp_customize->add_control(
		'hfh_copyright',
		array(
			'label'   => __( 'Copyright Text', 'hfh-theme' ),
			'type'    => 'text',
			'section' => 'hfh-theme',
		) 
	);

	$wp_customize->add_control(
		'hfh_display_teaser_image_placeholder',
		array(
			'label'   => __( 'Display Teaser Image Placeholder', 'hfh-theme' ),
			'type'    => 'checkbox',
			'section' => 'hfh-theme',
		) 
	);
}
add_action( 'customize_register', 'hfh_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function hfh_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function hfh_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hfh_theme_customize_preview_js() {
	wp_enqueue_script( 'hfh-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), HFH_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'hfh_theme_customize_preview_js' );
