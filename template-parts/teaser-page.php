<?php

/**
 * Template part for displaying post teasers
 *
 * @package HfH_Theme
 */

?>

<?php
if (get_template_part('template-parts/teasers/' . get_post_type() . '/teaser', get_post_format()) === false) : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('post-teaser'); ?>>
        <a class="post-teaser__link" href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail() || get_theme_mod('hfh_display_teaser_image_placeholder', true)) : ?>
                <div class="post-teaser__image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="post-teaser__text">
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

<?php endif; ?>