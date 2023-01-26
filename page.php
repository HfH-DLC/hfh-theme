<?php
get_header();
?>
<main id="main">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', 'page');
        get_template_part('template-parts/pagination');
    endwhile;
    ?>
</main>
<?php
get_footer()
?>