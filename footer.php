<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HfH_Theme
 */

?>

<footer class="site-footer">
	<div class="pre-footer">
		<div class="pre-footer__content">
		<?php echo wp_get_attachment_image( get_theme_mod( 'hfh_footer_logo' ), array( 300, 300 ) ); ?>
		<div><?php echo wp_kses_post( wpautop( get_theme_mod( 'hfh_address' ) ) ); ?></div>

		<div class="footer__social">
				<nav role="navigation" >
					<ul>
						<?php if ( get_theme_mod( 'hfh_facebook' ) ) { ?>
						<li>
							<a href="<?php echo esc_url( get_theme_mod( 'hfh_facebook' ) ); ?>" target="_blank" rel="nofollow" class="facebook">facebook</a>
						</li>
							<?php 
						}
						if ( get_theme_mod( 'hfh_youtube' ) ) {
							?>
						<li>
							<a href="<?php echo esc_url( get_theme_mod( 'hfh_youtube' ) ); ?>" target="_blank" rel="nofollow" class="youtube">youtube</a>
						</li>
							<?php 
						}
						if ( get_theme_mod( 'hfh_linkedin' ) ) {
							?>
						<li>
							<a href="<?php echo esc_url( get_theme_mod( 'hfh_linkedin' ) ); ?>" target="_blank" rel="nofollow" class="linkedin">linkedin</a>
						</li>
							<?php 
						}
						if ( get_theme_mod( 'hfh_instagram' ) ) {
							?>
						<li>
							<a href="<?php echo esc_url( get_theme_mod( 'hfh_instagram' ) ); ?>" target="_blank" rel="nofollow" class="instagram">instagram</a>
						</li>
							<?php 
						}
						if ( get_theme_mod( 'hfh_twitter' ) ) {
							?>
						<li>
							<a href="<?php echo esc_url( get_theme_mod( 'hfh_twitter' ) ); ?>" target="_blank" rel="nofollow" class="twitter">twitter</a>
						</li>
							<?php 
						}
						if ( get_theme_mod( 'hfh_issuu' ) ) {
							?>
						<li>
							<a href="<?php echo esc_url( get_theme_mod( 'hfh_issuu' ) ); ?>" target="_blank" rel="nofollow" class="issuu">issuu</a>
						</li>
						<?php } ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="footer__content">
			<?php 
			wp_nav_menu(
				array(
					'menu'           => 'menu-footer',
					'theme_location' => 'menu-footer',
					'menu_id'        => 'menu-footer',
					'container'      => 'nav',
				)
			);
			?>
			<div class="footer__copyright">
				<?php echo esc_html( get_theme_mod( 'hfh_copyright' ) ); ?>
			</div>
		</div>
	</div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
