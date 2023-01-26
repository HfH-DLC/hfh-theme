<?php

$hfh_theme_previous_post = get_previous_post();
$hfh_theme_previous_post_url = get_permalink($hfh_theme_previous_post);
$hfh_theme_next_post = get_next_post();
$hfh_theme_next_post_url = get_permalink($hfh_theme_next_post);

?>
<div class="hfh-single-navigation hfh-w-container">
    <?php if ($hfh_theme_previous_post) : ?>
        <div class="hfh-single-navigation__teaser hfh-single-navigation__teaser--previous">
            <h2 class="hfh-h2"><?= __('Previous Post', 'hfh-theme') ?></h2>
            <hfh-teaser link='<?= esc_url(get_the_permalink($hfh_theme_previous_post)) ?>' title='<?= esc_attr(get_the_title($hfh_theme_previous_post)) ?>' image-src='<?= get_the_post_thumbnail_url($hfh_theme_previous_post) ?>' image-alt='<?= get_post_meta(get_post_thumbnail_id($hfh_theme_previous_post), '_wp_attachment_image_alt', true) ?>' pretitle='<?= get_the_date('d.m.Y', $hfh_theme_previous_post) ?>'></hfh-teaser>
        </div>
    <?php
    endif;
    if ($hfh_theme_next_post) :
    ?>
        <div class="hfh-single-navigation__teaser hfh-single-navigation__teaser--next">
            <h2 class="hfh-h2"><?= __('Next Post', 'hfh-theme') ?></h2>
            <hfh-teaser link='<?= esc_url(get_the_permalink($hfh_theme_next_post)) ?>' title='<?= esc_attr(get_the_title($hfh_theme_next_post)) ?>' image-src='<?= get_the_post_thumbnail_url($hfh_theme_next_post) ?>' image-alt='<?= get_post_meta(get_post_thumbnail_id($hfh_theme_next_post), '_wp_attachment_image_alt', true) ?>' pretitle='<?= get_the_date('d.m.Y', $hfh_theme_next_post) ?>'></hfh-teaser>
        </div>
    <?php endif; ?>
</div>