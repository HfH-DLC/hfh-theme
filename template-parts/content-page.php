<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HfH_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        the_title('<h1 class="entry-title">', '</h1>');
        ?>
    </header><!-- .entry-header -->

    <?php hfh_theme_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current page. Only visible to screen readers */
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