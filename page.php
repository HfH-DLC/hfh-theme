<?php
get_header();
?>
<main id="main">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', 'page');
    ?>
        <div id="hfh-theme-page-pagination"><?= get_template_part('template-parts/pagination'); ?></div>
    <?php
    endwhile;
    ?>
</main>
<?php
get_footer()
?>