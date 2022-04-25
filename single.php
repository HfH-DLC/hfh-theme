<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package HfH_Theme
 */

get_header();
?>
<div class="site-flex">
	<main id="primary" class="site-main">

		<?php
		while (have_posts()) :
			the_post();

			hfh_theme_get_template_part('content', get_post_type(), get_post_format());

			$hfh_theme_previous_post     = get_previous_post();
			$hfh_theme_previous_post_url = get_permalink($hfh_theme_previous_post);
			$hfh_theme_next_post         = get_next_post();
			$hfh_theme_next_post_url     = get_permalink($hfh_theme_next_post);


		?>
			<div class="single-posts-navigation">
				<?php if ($hfh_theme_previous_post) : ?>
					<div class="single-posts-navigation__link previous-post"><a href="<?php echo esc_url($hfh_theme_previous_post_url); ?>">
							<?php
							if (has_post_thumbnail($hfh_theme_previous_post)) {
								echo get_the_post_thumbnail($hfh_theme_previous_post->ID);
							}
							?>
							<div><span class="arrow  arrow--prev" aria-hidden="true"><?php esc_html_e('Previous', 'hfh-theme'); ?></span></div>
							<div><?php echo esc_html(get_the_title($hfh_theme_previous_post->ID)); ?></div>
						</a></div>
				<?php
				endif;
				if ($hfh_theme_next_post) :
				?>
					<div class="single-posts-navigation__link next-post"><a href="<?php echo esc_url($hfh_theme_next_post_url); ?>">
							<?php
							if (has_post_thumbnail($hfh_theme_next_post)) {
								echo get_the_post_thumbnail($hfh_theme_next_post->ID);
							}
							?>
							<div><span class="arrow arrow--next" aria-hidden="true"><?php esc_html_e('Next', 'hfh-theme'); ?></span></div>
							<div><?php echo esc_html(get_the_title($hfh_theme_next_post->ID)); ?></div>
						</a></div>
				<?php endif; ?>
			</div>
			<?php
			$hfh_theme_related_query = hfh_theme_related_posts(get_the_ID(), 3);

			if ($hfh_theme_related_query->have_posts()) :
			?>
				<div class="hfh-related-posts">
					<div class="hfh-related-posts__label"><?php echo esc_html__('Related Posts', 'hfh-theme'); ?></div>
					<ul class="hfh-related-posts__list">
						<?php
						while ($hfh_theme_related_query->have_posts()) :
							$hfh_theme_related_query->the_post();
						?>
							<li>
								<a href="<?php the_permalink(); ?>">
									<div class="hfh-related-posts__link">
										<?php
										if (has_post_thumbnail()) {
											the_post_thumbnail();
										}
										?>
										<?php the_title(); ?>
										<?php hfh_theme_posted_on(); ?>
									</div>
								</a>
							</li>
						<?php
						endwhile;
						?>
					</ul>
				</div>
		<?php
			endif;

			wp_reset_postdata();

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
