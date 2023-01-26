<article id="post-<?php the_ID(); ?>" <?php post_class('hfh-content hfh-theme-content'); ?>>
    <header>
        <div class="hfh-article__date"><?php the_date() ?></div>
        <?php
        the_title('<h1>', '</h1>');
        ?>
    </header>
    <?php if (has_post_thumbnail()) : ?>
        <div class="hfh-article__image hfh-header-image"><?php the_post_thumbnail() ?></div>
    <?php endif; ?>
    <?php get_template_part('template-parts/contact') ?>
    <div class="hfh-article__content">
        <?php the_content() ?>
    </div>
</article>