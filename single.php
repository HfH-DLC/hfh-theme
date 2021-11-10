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
		while ( have_posts() ) :
			the_post();
			
			get_template_part( 'template-parts/content', get_post_type() );
			$hfh_theme_previous_post     = get_previous_post();
			$hfh_theme_previous_post_url = get_permalink( $hfh_theme_previous_post );
			$hfh_theme_next_post         = get_next_post();
			$hfh_theme_next_post_url     = get_permalink( $hfh_theme_next_post );

			echo '<div class="hfh-post-navigation">';
			if ( $hfh_theme_previous_post ) {
				echo '<div class="hfh-post-navigation__link previous-post">';
				if ( has_post_thumbnail( $hfh_theme_previous_post ) ) {
					echo '<a href="' . esc_url( $hfh_theme_previous_post_url ) . '">' . get_the_post_thumbnail( $hfh_theme_previous_post->ID, array( 75, 75 ) ) . '</a>';                    
				}
				echo '<a href="' . esc_url( $hfh_theme_previous_post_url ) . '"><div><span class="arrow  arrow--prev" aria-hidden="true" />' . esc_html__( 'Previous', 'hfh-theme' ) . '</div><div>' . esc_html( get_the_title( $hfh_theme_previous_post->ID ) ) . '</div></a></div>';
			}

			if ( $hfh_theme_next_post ) {
				echo '<div class="hfh-post-navigation__link next-post">';
				if ( has_post_thumbnail( $hfh_theme_next_post ) ) {
					echo '<a href="' . esc_url( $hfh_theme_next_post_url ) . '">' . get_the_post_thumbnail( $hfh_theme_next_post->ID, array( 75, 75 ) ) . '</a>';
				}
				echo '<a href="' . esc_url( $hfh_theme_next_post_url ) . '"><div><span class="arrow" aria-hidden="true" />' . esc_html__( 'Next', 'hfh-theme' ) . '</div><div>' . esc_html( get_the_title( $hfh_theme_next_post->ID ) ) . '</div></a></div>';
			}
			echo '</div>';

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
