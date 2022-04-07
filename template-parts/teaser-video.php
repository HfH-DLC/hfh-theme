<?php

/**
 * Template part for displaying video post teasers
 *
 * @package HfH_Theme
 */

$hfh_video_source = get_post_meta(get_the_ID(), "hfh_theme_video_metabox_source", true);
$hfh_video = '';
if ($hfh_video_source == 'embed') {
	$hfh_video = $GLOBALS['wp_embed']->run_shortcode(wp_kses_post(get_post_meta(get_the_ID(), "hfh_theme_video_metabox_embed", true)));
} else if ($hfh_video_source == 'file') {
	$hfh_video_file = esc_url_raw(get_post_meta(get_the_ID(), "hfh_theme_video_metabox_file", true));
	$hfh_video = $hfh_video_file ? "<video src='$hfh_video_file' controls></video>" : '';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-teaser'); ?>>
	<div class="post-teaser__video <?= !$hfh_video ? 'post-teaser__video--empty' : '' ?>">
		<?php if ($hfh_video) : ?>
			<?= $hfh_video ?>
		<?php endif; ?>
	</div>
	<a class=" post-teaser__link" href="<?php the_permalink(); ?>">
		<div class="post-teaser__text">
			<div class="post-teaser__date">
				<?php hfh_theme_posted_on(); ?>
			</div>
			<div class="post-teaser__title">
				<?php the_title(); ?>
			</div>
			<div class="post-teaser__excerpt">
				<?php the_excerpt(); ?>
			</div>
			<div class="post-teaser__arrow">
				<svg width='47px' height='20px' viewBox='0 0 47 20' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'>
					<g transform='translate(0.000000, 1.000000)' stroke='currentColor' stroke-width='2' fill='none' fill-rule='evenodd'>
						<line x1='45' y1='9' x2='-1.19015908e-13' y2='9'></line>
						<polyline points='36.5 0 45 9 36.5 18'></polyline>
					</g>
				</svg>
			</div>
		</div>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->