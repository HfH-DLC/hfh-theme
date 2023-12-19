<?php
get_header();
?>
<main id="main" class="hfh-single">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', get_post_type());
    ?>
        <div id="hfh-theme-single">
            <?php
            get_template_part('template-parts/single-navigation');
            get_template_part('template-parts/related-posts');
            ?>
        </div>
    <?php
    endwhile;
    ?>
</main>
<?php
get_footer()
?>