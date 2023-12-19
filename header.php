<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open();

	$props = wp_json_encode([
		'primaryItems' => hfh_get_menu('menu-primary') ?? [],
		'secondaryItems' => hfh_get_menu('menu-secondary') ?? [],
		'tertiaryItems' => hfh_get_menu('menu-tertiary') ?? [],
		'search' => true,
		'homeUrl' => home_url()
	]);
	?>
	<noscript>
		<div class="no-js-content">
			<div class="hfh-info-field">
				<p><?= __('Please enable javascript to view this website.', 'hfh-theme') ?></p>
			</div>
		</div>
	</noscript>
	<div id="page" class="js-content">
		<header-wrapper v-bind='<?= $props ?>'>
			<template #site-name><?= esc_html(get_bloginfo('name'));  ?></template>
		</header-wrapper>