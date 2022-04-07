<?php

/**
 * HfH Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package HfH_Theme
 */

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

		add_theme_support('post-formats', array('video'));
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

//Metabox
function hfh_add_video_metabox($post)
{
	add_meta_box(
		'hfh-theme-video-metabox',
		__('Video'),
		'hfh_render_metabox',
		'post',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes_post', 'hfh_add_video_metabox');


function hfh_render_metabox($object)
{
	$source = get_post_meta($object->ID, "hfh_theme_video_metabox_source", true);
	wp_nonce_field('hfh_theme_video_metabox', 'hfh_wpnonce'); ?>
	<div class="hfh-theme-video-metabox">
		<label for="hfh-theme-video-metabox-source"><?= __("Choose a video source:") ?></label>
		<div class="video-metabox-sources">
			<div><input type="radio" name="hfh-theme-video-metabox-source" id="hfh-theme-video-metabox-source-embed" value="embed" <?= $source == 'embed' ? 'checked' : ''  ?>>
				<label for="hfh-theme-video-metabox-source-embed"><?= __('Embed external video', 'hfh-theme') ?></label>
			</div>
			<div>
				<input type="radio" name="hfh-theme-video-metabox-source" id="hfh-theme-video-metabox-source-file" value="file" <?= $source == 'file' ? 'checked' : ''  ?>>
				<label for="hfh-theme-video-metabox-source-file"><?= __('Use video from media library', 'hfh-theme') ?></label>
			</div>
		</div>
		<div class="hfh-theme-video-metabox-embed-wrapper <?= $source == 'embed' ? '' : 'hfh-hidden' ?>">
			<label for="hfh-theme-video-metabox-embed"><?= __('Enter video embed code:') ?></label><br>
			<textarea id="hfh-theme-video-metabox-embed" name="hfh-theme-video-metabox-embed"><?= wp_kses_post(get_post_meta($object->ID, "hfh_theme_video_metabox_embed", true)) ?></textarea>
		</div>
		<div class="hfh-theme-video-metabox-file-wrapper <?= $source == 'file' ? '' : 'hfh-hidden' ?>">
			<?php
			global $post;
			$saved = get_post_meta($post->ID, 'hfh_theme_video_metabox_file', true);
			?>
			<input type="hidden" name="hfh-theme-video-metabox-file" id="hfh-theme-video-metabox-file" value="<?php echo esc_attr($saved); ?>"><br>
			<div id="hfh-theme-video-metabox-preview">
				<?php if ($saved) : ?>
					<video src=<?= $saved ?>></video>
				<?php endif; ?>
			</div>
			<button type="button" class="button<?php if (!$saved) : ?> hfh-hidden<?php endif; ?>" id="hfh-theme-video-metabox-remove" data-media-uploader-target="#hfh-theme-video-metabox-file"><?php _e('Remove Video', 'hfh-theme') ?></button>
			<button type="button" class="button" id="hfh-theme-video-metabox-upload" data-media-uploader-target="#hfh-theme-video-metabox-file"><?php _e('Select Video', 'hfh-theme') ?></button>
		</div>
	</div>
<?php
}


add_action('save_post', 'hfh_save_meta_box', 10, 2);
function hfh_save_meta_box($post_id, $post)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

	if (!$_POST['post_type'] == 'post' || !$_POST['post_format'] == 'video' || !current_user_can('edit_post', $post_id)) {
		return;
	}
	if (isset($_POST['hfh_wpnonce']) && wp_verify_nonce($_POST['hfh_wpnonce'], 'hfh_theme_video_metabox') && check_admin_referer('hfh_theme_video_metabox', 'hfh_wpnonce')) {
		if (isset($_POST['hfh-theme-video-metabox-source'])) {
			$source = $_POST['hfh-theme-video-metabox-source'];
			if (!in_array($source, array('embed', 'file'))) {
				return;
			}
			update_post_meta($post_id, 'hfh_theme_video_metabox_source', sanitize_text_field($source));
			if ($source === 'embed' && isset($_POST['hfh-theme-video-metabox-embed'])) {
				update_post_meta($post_id, 'hfh_theme_video_metabox_embed', wp_filter_post_kses($_POST['hfh-theme-video-metabox-embed']));
				delete_post_meta($post_id, 'hfh_theme_video_metabox_file');
			} else if ($source === 'file' && isset($_POST['hfh-theme-video-metabox-file'])) {
				update_post_meta($post_id, 'hfh_theme_video_metabox_file', esc_url_raw($_POST['hfh-theme-video-metabox-file']));
				delete_post_meta($post_id, 'hfh_theme_video_metabox_embed');
			}
		}
	}
	return;
}

function hfh_theme_load_admin_scripts($hook)
{
	global $post;
	global $typenow;
	if ($typenow == 'post' && get_post_format($post) == 'video') {
		wp_enqueue_media();

		wp_register_script('hfh_theme_media_uploader', get_template_directory_uri() . '/js/media-uploader.js', array('jquery'), HFH_THEME_VERSION);
		wp_localize_script(
			'hfh_theme_media_uploader',
			'phpVars',
			array(
				'title' => __('Choose or Upload Media', 'hfh-theme'),
				'button' => __('Use this media', 'hfh-theme'),
			)
		);
		wp_enqueue_script('hfh_theme_media_uploader');
	}
}
add_action('admin_enqueue_scripts', 'hfh_theme_load_admin_scripts', 10, 1);
?>