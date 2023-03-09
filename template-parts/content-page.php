<article id="post-<?php the_ID(); ?>" <?php post_class('hfh-content hfh-theme-content'); ?>>
    <header>
        <?php
        if (is_front_page()) {
            the_title('<h1 class="hfh-sr-only">', '</h1>');
        } else {
            the_title('<h1>', '</h1>');
        }
        ?>
    </header>
    <?php if (has_post_thumbnail()) : ?>
        <div class="hfh-article__image hfh-header-image"><?php the_post_thumbnail() ?></div>
    <?php endif; ?>

    <?php the_content() ?>

</article>