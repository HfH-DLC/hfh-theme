<?php

/**
 * The home template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HfH_Theme
 */

get_header();
?>
<div class="site-flex">
	<main id="primary" class="site-main">

		<?php
		if (have_posts()) :

			if (!is_front_page()) :
		?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php
			endif;
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
							/*
				 * Include the Post-Type-specific template for the teaser.
				 * If you want to override this in a child theme, then include a file
				 * called teaser-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
							get_template_part('template-parts/teaser', get_post_type());
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
