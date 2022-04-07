<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HfH_Theme
 */

get_header();
?>
<div class="site-flex">
	<main id="primary" class="site-main">

		<?php if (have_posts()) : ?>

			<header class="page-header">
				<?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				the_archive_description('<div class="archive-description">', '</div>');
				?>
			</header><!-- .page-header -->

			<div class="site-teasers">
				<?php
				/* Start the Loop */
				while (have_posts()) :
					the_post();
				?>
					<div class="teaser-row">
						<div class="teaser">
							<?php
							get_template_part('template-parts/teaser', get_post_format());
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
