<footer id="hfh-theme-footer">
    <hfh-footer>
        <template #tagline>
            <?= wp_kses_post(wpautop(get_theme_mod('hfh_tagline'))); ?>
        </template>
        <template #contact-address>
            <?= wp_kses_post(wpautop(get_theme_mod('hfh_contact_address'))); ?>
        </template>
        <template #contact-other>
            <?= wp_kses_post(wpautop(get_theme_mod('hfh_contact_other'))); ?>
        </template>
        <template #socials>
            <?php if (get_theme_mod('hfh_facebook')) { ?>
                <hfh-social-block icon="facebook" href="<?= esc_url(get_theme_mod('hfh_facebook')) ?>"></hfh-social-block>
            <?php
            }
            if (get_theme_mod('hfh_youtube')) {
            ?>
                <hfh-social-block icon="youtube" href="<?= esc_url(get_theme_mod('hfh_youtube')) ?>"></hfh-social-block>
            <?php
            }
            if (get_theme_mod('hfh_linkedin')) {
            ?>
                <hfh-social-block icon="linkedin" href="<?= esc_url(get_theme_mod('hfh_linkedin')); ?>"></hfh-social-block>
            <?php
            }
            if (get_theme_mod('hfh_instagram')) {
            ?>
                <hfh-social-block icon="instagram" href="<?= esc_url(get_theme_mod('hfh_instagram')); ?>"></hfh-social-block>
            <?php
            }
            if (get_theme_mod('hfh_twitter')) {
            ?>
                <hfh-social-block icon="twitter" href="<?= esc_url(get_theme_mod('hfh_twitter')); ?>"></hfh-social-block>
            <?php
            }
            if (get_theme_mod('hfh_issuu')) {
            ?>
                <hfh-social-block icon="issuu" href="<?= esc_url(get_theme_mod('hfh_issuu')); ?>"></hfh-social-block>
            <?php } ?>
        </template>
        <template #copyright><?= wp_kses_post(get_theme_mod('hfh_copyright')); ?></template>
        <template #links>
            <?php
            $menus_by_location = get_nav_menu_locations();
            if (array_key_exists('menu-footer', $menus_by_location)) :
                $menu =  $menus_by_location['menu-footer'];
                $items = wp_get_nav_menu_items(
                    $menu
                );
                if ($items) :
                    foreach ($items as $item) :
            ?>

                        <a href="<?= $item->url ?>" target="<?= $item->target ?>"><?= $item->title ?></a>
            <?php
                    endforeach;
                endif;
            endif;
            ?>
        </template>
    </hfh-footer>
</footer>
</div>

<?php wp_footer(); ?>
</body>

</html>