<?php
/**
 * The template for the search form
 *
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package HfH_Theme
 */

?>
<form role = 'search' <?php echo esc_attr( $aria_label ); ?> method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="label">
		<?php echo esc_html_x( 'Search', 'label', 'hfh-theme' ); ?></label>
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'hfh-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'hfh-theme' ); ?>" />
</form>
