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

		<?php if (have_posts()) :
			get_search_form();

			global $wp_query;
			echo '<strong>' . $wp_query->found_posts . '</strong> ' . _x('results', 'search result count');
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

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part('template-parts/content', 'search');
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
