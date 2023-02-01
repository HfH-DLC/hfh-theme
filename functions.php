<?php


if (!defined('HFH_THEME_VERSION')) {
    // Replace the version number of the theme on each release.
    define('HFH_THEME_VERSION', '2.0.2');
}

require(get_template_directory() . '/inc/hfh_theme_category_filter.php');
require(get_template_directory() . '/inc/hfh_template_functions.php');

/**
 * Enqueue scripts and styles.
 */
function hfh_theme_scripts()
{
    wp_enqueue_style('hfh-theme-assets-style', get_template_directory_uri() . '/dist/style.css', array(), HFH_THEME_VERSION);

    wp_enqueue_script('vue', 'https://unpkg.com/vue@3/dist/vue.global.js', array(), HFH_THEME_VERSION, true);
    wp_enqueue_script('hfh-theme-assets', get_template_directory_uri() . '/dist/hfh-theme-assets.umd.cjs', array('vue'),  HFH_THEME_VERSION, true);

    $config = array(
        'homeUrl' => get_home_url(),
    );
    wp_localize_script('hfh-theme-assets', 'wp_config', $config);
}
add_action('wp_enqueue_scripts', 'hfh_theme_scripts');

function hfh_theme_setup()
{
    load_theme_textdomain('hfh-theme',  get_template_directory() . '/languages');
    register_nav_menus(
        array(
            'menu-primary' => esc_html__('Primary', 'hfh-theme'),
            'menu-secondary' => esc_html__('Secondary', 'hfh-theme'),
            'menu-tertiary' => esc_html__('Tertiary', 'hfh-theme'),
            'menu-footer' => esc_html__('Footer', 'hfh-theme'),
        )
    );

    add_image_size('slider', 1120, 485, true); // (cropped)
}
add_action('after_setup_theme', 'hfh_theme_setup');

/**
 * Add customizer settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hfh_theme_customize_register($wp_customize)
{
    $wp_customize->add_setting(
        'hfh_show_slider',
        array(
            'default'           => false,
            'sanitize_callback' => 'wpc_sanitize_checkbox',
        )
    );

    $wp_customize->add_setting(
        'hfh_slider_number_of_slides',
        array(
            'default'           => 3,
            'sanitize_callback' => 'hfh_sanitize_positive_number',
        )
    );

    $wp_customize->add_setting(
        'hfh_show_category_filter',
        array(
            'default'           => false,
            'sanitize_callback' => 'wpc_sanitize_checkbox',
        )
    );

    $wp_customize->add_setting(
        'hfh_copyright',
        array(
            'default'           => '© Copyright ' . date('Y') . ' HfH',
            'sanitize_callback' => 'wp_filter_nohtml_kses',
        )
    );

    $wp_customize->add_setting(
        'hfh_tagline',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );

    $wp_customize->add_setting(
        'hfh_contact_address',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );

    $wp_customize->add_setting(
        'hfh_contact_other',
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
        'hfh_display_teaser_image_placeholder',
        array(
            'default'           => true,
            'sanitize_callback' => 'hfh_theme_sanitize_checkbox',
        )
    );

    $wp_customize->add_section(
        'hfh-theme',
        array(
            'title'       => __('HfH Theme Options', 'hfh-theme'),
            'description' => __('Options specific to the HfH Theme', 'hfh-theme'),
        )
    );

    $wp_customize->add_control(
        'hfh_show_slider',
        array(
            'type'        => 'checkbox',
            'label'   => __('Show slider', 'hfh-theme'),
            'section' => 'hfh-theme',
        )
    );

    $wp_customize->add_control(
        'hfh_slider_number_of_slides',
        array(
            'type'        => 'number',
            'label'   => __('Number of slides', 'hfh-theme'),
            'section' => 'hfh-theme',
        )
    );

    $wp_customize->add_control(
        'hfh_show_category_filter',
        array(
            'type'        => 'checkbox',
            'label'   => __('Show category filter', 'hfh-theme'),
            'section' => 'hfh-theme',
        )
    );


    $wp_customize->add_control(
        'hfh_tagline',
        array(
            'label'   => __('Footer Tagline', 'hfh-theme'),
            'section' => 'hfh-theme',
        )
    );

    $wp_customize->add_control(
        'hfh_contact_address',
        array(
            'label'   => __('Footer Contact Address', 'hfh-theme'),
            'section' => 'hfh-theme',
            'type' => 'textarea'
        )
    );


    $wp_customize->add_control(
        'hfh_contact_other',
        array(
            'label'   => __('Footer Contact Other', 'hfh-theme'),
            'section' => 'hfh-theme',
            'type' => 'textarea'
        )
    );

    $wp_customize->add_control(
        'hfh_facebook',
        array(
            'label'   => __('Facebook', 'hfh-theme'),
            'type'    => 'url',
            'section' => 'hfh-theme',
        )
    );

    $wp_customize->add_control(
        'hfh_youtube',
        array(
            'label'   => __('Youtube', 'hfh-theme'),
            'type'    => 'url',
            'section' => 'hfh-theme',
        )
    );

    $wp_customize->add_control(
        'hfh_linkedin',
        array(
            'label'   => __('LinkedIn', 'hfh-theme'),
            'type'    => 'url',
            'section' => 'hfh-theme',
        )
    );

    $wp_customize->add_control(
        'hfh_instagram',
        array(
            'label'   => __('Instagram', 'hfh-theme'),
            'type'    => 'url',
            'section' => 'hfh-theme',
        )
    );

    $wp_customize->add_control(
        'hfh_twitter',
        array(
            'label'   => __('Twitter', 'hfh-theme'),
            'type'    => 'url',
            'section' => 'hfh-theme',
        )
    );

    $wp_customize->add_control(
        'hfh_issuu',
        array(
            'label'   => __('issuu', 'hfh-theme'),
            'type'    => 'url',
            'section' => 'hfh-theme',
        )
    );

    $wp_customize->add_control(
        'hfh_copyright',
        array(
            'label'   => __('Copyright Text', 'hfh-theme'),
            'type'    => 'text',
            'section' => 'hfh-theme',
        )
    );
}
add_action('customize_register', 'hfh_theme_customize_register');


/**
 * Checkbox sanitization callback.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either true or false.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function wpc_sanitize_checkbox($checked)
{
    // Boolean check.
    return ((isset($checked) && true == $checked) ? true : false);
}

function hfh_sanitize_positive_number($number, $setting)
{
    $number = absint($number);
    return (1 <= $number ? $number : $setting->default);
}

/**
 * Get filtered posts for ajax requests
 */
function hfh_filter_posts()
{
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => get_option('posts_per_page')
    );
    $page = $_REQUEST['page'] ?? 1;
    $args['paged'] = $page;

    $category_id_string = $_REQUEST['category_ids'] ?? '';
    if (!empty($category_id_string)) {
        $category_ids = array_map('intval', explode(',', $category_id_string));
        if (!empty($category_ids)) {
            $args['category__and'] = $category_ids;
        }
    }
    $query = new WP_Query($args);

    wp_send_json_success(
        array(
            'posts' => hfh_get_teaser_data($query->posts),
            'totalPageCount' => $query->max_num_pages
        )
    );
}
add_action('wp_ajax_filter_posts', 'hfh_filter_posts');
add_action('wp_ajax_nopriv_filter_posts',  'hfh_filter_posts');
