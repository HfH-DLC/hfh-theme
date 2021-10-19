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
    <div class="footer-wrapper">
        <div class="footer-content">
            <?php wp_nav_menu(
                array(
                    'menu' => 'menu-footer',
                    'theme_location' => 'menu-footer',
                    'menu_id'        => 'menu-footer',
                    'container' => 'nav'
                )
            );
            ?>
            <div class="footer__copyright">
                <?php if (is_active_sidebar('copyright')) : ?>
                    <?php dynamic_sidebar('copyright'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>