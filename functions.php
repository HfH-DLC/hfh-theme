<?php

/**
 * HfH Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package HfH_Theme
 */

use HFH\Theme\PostVideoFormat;

if (!defined('HFH_THEME_VERSION')) {
	// Replace the version number of the theme on each release.
	define('HFH_THEME_VERSION', '1.0.0');
}

if (!function_exists('hfh_theme_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hfh_theme_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on HfH Theme, use a find and replace
		 * to change 'hfh-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('hfh-theme', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-header' => esc_html__('Primary', 'hfh-theme'),
				'menu-footer' => esc_html__('Footer', 'hfh-theme'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support('responsive-embeds');

		//add theme support for full-width blocks
		add_theme_support('align-wide');
	}
endif;
add_action('after_setup_theme', 'hfh_theme_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hfh_theme_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'hfh-theme'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'hfh-theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Footer Widgets', 'hfh-theme'),
			'id'            => 'footer-widgets',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Copyright', 'hfh-theme'),
			'id'            => 'copyright',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
		)
	);
}
add_action('widgets_init', 'hfh_theme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function hfh_theme_scripts()
{
	wp_enqueue_style('hfh-theme-style', get_stylesheet_uri(), array(), HFH_THEME_VERSION);
	wp_style_add_data('hfh-theme-style', 'rtl', 'replace');

	wp_enqueue_style('hfh-theme-style-index', get_template_directory_uri() . '/css/index.css', array(), HFH_THEME_VERSION);

	wp_enqueue_script('hfh-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), HFH_THEME_VERSION, true);

	wp_enqueue_script('hfh-theme-site-search', get_template_directory_uri() . '/js/site-search.js', array('jquery'), HFH_THEME_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'hfh_theme_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Post Video Format
 */
require get_template_directory() . '/inc/post-video-format.php';

/**
 * Set search results per page
 * 
 * @param  WP_Query $query The WP_Query instance that is about to run.
 */
function hfh_theme_searchfilter($query)
{

	if ($query->is_search && !is_admin()) {
		$query->set('posts_per_page', 10);
	}

	return $query;
}

add_filter('pre_get_posts', 'hfh_theme_searchfilter');

/**
 * 
 * Nav Walker Filters
 * 
 */
add_filter('nav_menu_link_attributes', 'hfh_theme_nav_menu_link_attributes', 10, 4);

function hfh_theme_nav_menu_link_attributes($atts, $menu_item, $args, $depth)
{
	if (in_array('menu-item-has-children', $menu_item->classes, true) && $depth === 0) {
		$atts['aria-has-popup'] = "true";
		$atts['aria-expanded'] = "false";
	}

	return $atts;
}

add_filter('nav_menu_css_class', 'hfh_theme_nav_menu_css_class', 10, 4);

function hfh_theme_nav_menu_css_class($classes, $menu_item, $args, $depth)
{
	if (in_array('menu-item-has-children', $classes, true) && $depth === 0) {
		$classes[] = "has-sub-menu";
	}
	return $classes;
}

add_filter('nav_menu_submenu_css_class', 'hfh_nav_menu_submenu_css_class', 10, 3);

function hfh_nav_menu_submenu_css_class($classes, $args, $depth)
{
	if ($depth > 0) {
		foreach (array_keys($classes, 'sub-menu', true) as $key) {
			unset($classes[$key]);
		}
	}
	return $classes;
}

add_action('admin_enqueue_scripts', 'hfh_theme_enqueue_admin_style');

function hfh_theme_enqueue_admin_style()
{
	wp_enqueue_style('admin-styles', get_template_directory_uri() . '/css/admin.css');
}

PostVideoFormat::get_instance();
