<?php

$hfh_theme_previous_post = get_previous_post();
$hfh_theme_previous_post_url = get_permalink($hfh_theme_previous_post);
$hfh_theme_next_post = get_next_post();
$hfh_theme_next_post_url = get_permalink($hfh_theme_next_post);

?>
<div class="hfh-single-navigation hfh-w-container">
    <?php if ($hfh_theme_previous_post) : ?>
        <a class="hfh-single-navigation__link hfh-single-navigation__link--previous" href='<?= esc_url(get_the_permalink($hfh_theme_previous_post)) ?>'><hfh-arrow-icon></hfh-arrow-icon><?= __('Previous Post', 'hfh-theme') ?></hfh-link>
        <?php
    endif;
    if ($hfh_theme_next_post) :
        ?>
            <hfh-link class="hfh-single-navigation__link hfh-single-navigation__link--next" href='<?= esc_url(get_the_permalink($hfh_theme_next_post)) ?>'><?= __('Next Post', 'hfh-theme') ?><hfh-arrow-icon></hfh-arrow-icon></hfh-link>
        <?php endif; ?>
</div>