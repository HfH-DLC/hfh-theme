<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package HfH_Theme
 */

if (!function_exists('hfh_theme_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function hfh_theme_posted_on()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date()),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date()),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			'%s',
			$time_string
		);

		echo '<div class="posted-on">' . $posted_on . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('hfh_theme_posted_by')) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function hfh_theme_posted_by()
	{
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('by %s', 'post author', 'hfh-theme'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('hfh_theme_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function hfh_theme_entry_footer()
	{
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'hfh-theme'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<div class="cat-links">' . esc_html__('Posted in %1$s', 'hfh-theme') . '</div>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'hfh-theme'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'hfh-theme') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'hfh-theme'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>', 'hfh-theme'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if (!function_exists('hfh_theme_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function hfh_theme_post_thumbnail()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		if (is_singular()) :
?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

<?php
		endif; // End is_singular().
	}
endif;

if (!function_exists('hfh_theme_categories')) :
	/**
	 * Displays a comma-separated list of categories
	 */
	function hfh_theme_categories()
	{
		$categories = get_categories();
		if (count($categories) > 1) {
			$categories_list = get_the_category_list(_x(', ', 'list item separator', 'hfh-theme'));
			if ($categories_list) {
				printf(
					'<span class="cat-links">%s</span>',
					$categories_list // phpcs:ignore WordPress.Security.EscapeOutput
				);
			}
		}
	}

endif;

if (!function_exists('hfh_theme_related_posts')) :
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
		$term_list    = wp_list_pluck($terms, 'slug');
		$related_args = array(
			'post_type'      => 'post',
			'posts_per_page' => $related_count,
			'post_status'    => 'publish',
			'post__not_in'   => array($post_id),
			'orderby'        => 'rand',
			'tax_query'      => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $term_list,
				),
			),
		);

		return new WP_Query($related_args);
	}
endif;

if (!function_exists('hfh_theme_get_template_part')) :
	/**
	 * Returns the template part 'name-post_type-post_format'
	 * 
	 * @param string $name Name of the template.
	 * @param string $post_type Post type the template is for.
	 * @param int $post_format Post format the template is for.
	 */
	function hfh_theme_get_template_part($name, $post_type, $post_format)
	{
		if (get_template_part('template-parts/' . $name . '-' . $post_type, $post_format) === false) {
			get_template_part('template-parts/' . $name);
		}
	}
endif;
