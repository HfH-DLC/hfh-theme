<?php

/**
 * Template part for displaying posts with video format
 *
 * @package HfH_Theme
 */

$hfh_video_source = get_post_meta(get_the_ID(), "hfh_theme_video_metabox_source", true);
$hfh_video = '';
if ($hfh_video_source == 'embed') {
	$hfh_video = wp_kses(get_post_meta(get_the_ID(), "hfh_theme_video_metabox_embed", true), wp_kses_allowed_html('post'));
} else if ($hfh_video_source == 'file') {
	$hfh_video_file = esc_url_raw(get_post_meta(get_the_ID(), "hfh_theme_video_metabox_file", true));
	$hfh_video = $hfh_video_file ? "<video src='$hfh_video_file' controls></video>" : '';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ('post' === get_post_type()) :
		?>
			<div class="entry-meta">
				<?php
				hfh_theme_categories();
				hfh_theme_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		<?php
		if (is_singular()) :
			the_title('<h1 class="entry-title">', '</h1>');
		else :
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="post-video">
		<?php if ($hfh_video) : ?>
			<?= $hfh_video ?>
		<?php endif; ?>
	</div><!-- .post-thumbnail -->

	<div class="entry-contact">
		<div class="entry-contact__title">
			<?php echo esc_html__('Contact', 'hfh-theme'); ?>
		</div>
		<address class="entry-contact__content">
			<div class="entry-contact__image"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author"><?php echo get_avatar(get_the_author_meta('ID'), 70); ?></a></div>
			<div class="entry-contact__author">
				<div class="entry-contact__name"><?php the_author(); ?></div>
		</address>
	</div>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'hfh-theme'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->