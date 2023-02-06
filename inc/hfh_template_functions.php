<?php

/**
 * Get hierarchical arraya of menu items for a given location.
 * Used by the HfhHeader component
 */
function hfh_get_menu(string $location)
{
    $output = [];
    $locations = get_nav_menu_locations();
    if (!array_key_exists($location, $locations)) {
        return null;
    }
    $menu = wp_get_nav_menu_object($locations[$location]);
    if ($menu === false) {
        return null;
    }
    $menu_items = wp_get_nav_menu_items($menu);

    foreach ($menu_items as $item) {
        $data = [
            'label' => $item->title,
        ];
        if (!empty($item->url)) {
            $data['link'] = ['href' => $item->url, 'target' => $item->target];
        } else {
            $data['children'] = [];
        }

        $parent_id = intval($item->menu_item_parent);
        if ($parent_id == 0) {
            $output[] = $data;
        } else {
            $current_parent = &$output[array_key_last($output)];
            if (!array_key_exists('children', $current_parent)) {
                $current_parent['children'] = [];
            }
            $current_parent['children'][] = $data;
        }
    }
    return $output;
}

/**
 * Get post data for teasers
 */
function hfh_get_teaser_data($posts)
{
    return array_map(function ($post) {
        return array(
            'id' => $post->ID,
            'url' => get_permalink($post),
            'imageSrc' => get_the_post_thumbnail_url($post),
            'imageAlt' => html_entity_decode(get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true)),
            'pretitle' =>  get_the_date('d.m.Y', $post),
            'title' =>  html_entity_decode(get_the_title($post)),
            'excerpt' => html_entity_decode(wp_kses_post(get_the_excerpt($post)))
        );
    }, $posts);
}

/**
 * Returns a list of related posts.
 *
 * @param int $post_id The Post ID.
 * @param int $related_count The number of related posts returned.
 */
function hfh_theme_related_posts($post_id, $related_count)
{
    $terms = get_the_terms($post_id, 'category');
    if (empty($terms)) {
        $terms = array();
    }
    $term_list = wp_list_pluck($terms, 'slug');
    $related_args = array(
        'post_type' => 'post',
        'posts_per_page' => $related_count,
        'post_status' => 'publish',
        'post__not_in' => array($post_id),
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $term_list,
            ),
        ),
    );

    return new WP_Query($related_args);
}

/**
 * Get data for the category filter
 */
function hfh_get_category_filter_data($category_ids = [], $restricted_by = [])
{
    return HfH_Theme_Category_Filter::getInstance()->get_data($category_ids, $restricted_by);
}

/**
 * Get post data for slider
 */
function hfh_get_slides()
{
    $query = new WP_Query(array(
        'post_type' => 'post',
        'orderby' => 'rand',
        'posts_per_page' => get_theme_mod('hfh_slider_number_of_slides')
    ));

    return array_map(function ($post) {
        return array(
            'title' => get_the_title($post),
            'excerpt' => get_the_excerpt($post),
            'link' => get_the_permalink($post),
            'imageSrc' => get_the_post_thumbnail_url($post, 'slider')
        );
    }, $query->posts);
}
