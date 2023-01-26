<?php
get_header();
?>
<main id="main" class="hfh-single">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', get_post_type());
        get_template_part('template-parts/single-navigation');
        get_template_part('template-parts/related-posts');
    endwhile;
    ?>
</main>
<?php
get_footer()
?>