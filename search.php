<?php
get_header();
?>
<main id="main" class="hfh-w-container">
	<h1><?= __('Search', 'hfh-theme') ?></h1>

	<?php
	get_search_form();

	if (have_posts()) :
		global $wp_query;
		$hfh_theme_results_count = $wp_query->found_posts;
	?>
		<h2 class="hfh-search-result-count">
			<strong><?= esc_html($hfh_theme_results_count) ?></strong> <?= esc_html(_nx('result', 'results', $hfh_theme_results_count, 'search result count', 'hfh-theme')) ?>
		</h2>
		<ul class="hfh-search__results">
			<?php
			while (have_posts()) :
				the_post();
			?>
				<li>
					<?php get_template_part('template-parts/search-result', get_post_type()) ?>
				<li>
				<?php endwhile; ?>
		</ul>
	<?php
		get_template_part('template-parts/pagination');
	else : ?>
		<p class="hfh-search__no-results">
			<?= __('Your search yielded no results.', 'hfh-theme') ?>
		</p>
	<?php
	endif;
	?>

</main>
<?php
get_footer();
