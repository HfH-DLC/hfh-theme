<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HfH_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'hfh-theme'); ?></a>

		<header id="masthead" class="site-header">
			<div class="site-header-wrapper">
				<div class="site-branding">
					<?php
					if (has_custom_logo()) :
						the_custom_logo();
					else :
					?>
						<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
						<?php
						$hfh_theme_description = get_bloginfo('description', 'display');
						if ($hfh_theme_description || is_customize_preview()) :
						?>
							<p class="site-description">
								<?php
								echo $hfh_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								?>
							</p>
						<?php endif; ?>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_html_e('Main Menu', 'hfh-theme') ?>">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span aria-hidden="true"></span>
						<span aria-hidden="true"></span>
						<span aria-hidden="true"></span>
						<span aria-hidden="true"></span>
						<strong class="button-text"><?php esc_html_e('Menu', 'hfh-theme'); ?></strong>
					</button>
					<?php
					wp_nav_menu(
						array(
							'menu'           => 'menu-header',
							'theme_location' => 'menu-header',
							'menu_id'        => 'primary-menu',
							'container'      => false,
							'menu_class'     => 'main-navigation',
							'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						)
					);
					?>
					<button class="site-search-toggle" type="button" aria-controls="site-search" aria-expanded="false"><span class="sr-only"><?php echo esc_html_x('Toggle Search', 'toggle site search visibility', 'hfh-theme'); ?></span></button>
					<?php get_search_form(); ?>
				</nav><!-- #site-navigation -->
			</div>
			<div id="site-search">
				<?php get_search_form(); ?>
			</div>
		</header><!-- #masthead -->