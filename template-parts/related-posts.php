<?php
$hfh_theme_related_query = hfh_theme_related_posts(get_the_ID(), 3);
if ($hfh_theme_related_query->have_posts()) :
?>

    <div class="hfh-related-posts hfh-w-container">
        <h2 class="hfh-h2"><?= __('Related posts', 'hfh-theme') ?></h2>
        <div class="hfh-related-posts__teasers">
            <?php
            while ($hfh_theme_related_query->have_posts()) :
                $hfh_theme_related_query->the_post();
            ?>
                <div class="hfh-related-posts__teaser">
                    <hfh-teaser link='<?= esc_url(get_the_permalink()) ?>' title='<?= esc_attr(get_the_title()) ?>' image-src='<?= get_the_post_thumbnail_url() ?>' image-alt='<?= get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?>' pretitle='<?= get_the_date('d.m.Y') ?>'></hfh-teaser>
                </div>
            <?php
            endwhile;
            ?>
        </div>
    </div>
<?php
endif;
wp_reset_postdata();
?>