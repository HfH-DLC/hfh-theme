<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package HfH_Theme
 */

get_header();
?>
<div class="site-flex">
	<main id="primary" class="site-main">

		<?php
		if (have_posts()) :
			get_search_form();

			global $wp_query;
			$hfh_theme_results_count = $wp_query->found_posts;

			echo '<strong>' . esc_html($hfh_theme_results_count) . '</strong> ' . esc_html(_nx('result', 'results', $hfh_theme_results_count, 'search result count', 'hfh-theme'));
		?>

			<div class="site-teasers">
				<?php
				/* Start the Loop */
				while (have_posts()) :
					the_post();
				?>
					<div class="teaser-row">
						<div class="teaser">
							<?php
							hfh_theme_get_template_part('teaser', get_post_type(), get_post_format());
							?>
						</div>
					</div>
				<?php

				endwhile;

				?>
			</div>
		<?php

			the_posts_navigation();

		else :

			get_template_part('template-parts/content', 'none');

		endif;
		?>

	</main><!-- #main -->
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
