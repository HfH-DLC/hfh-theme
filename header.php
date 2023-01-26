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
		'search' => true
	]);
	?>
	<noscript>
		<div class="no-js-content">
			<div class="hfh-info-field">
				<p><?= __('Please enable javascript to view this website.', 'hfh') ?></p>
			</div>
		</div>
	</noscript>
	<div id="page" class="js-content">
		<hfh-header v-bind='<?= $props ?>' @search='onSearch'>
			<template #logo-desktop>
				<div class="hfh-theme-logo-desktop">
					<a href="<?= home_url() ?>"><hfh-logo></hfh-logo></a><?= esc_html(get_bloginfo('name'));  ?>
				</div>
			</template>
			<template #logo-mobile>
				<div class="hfh-theme-logo-mobile">
					<a href="<?= home_url() ?>"><hfh-logo></hfh-logo></a><?= esc_html(get_bloginfo('name'));  ?>
				</div>
			</template>
		</hfh-header>