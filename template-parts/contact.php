<?php
$props = wp_json_encode([
    'imageSrc' => get_avatar_url(get_the_author_meta('ID')),
    'link' => esc_url((get_the_author_meta('user_url'))),
    'name' => get_the_author_meta('nickname'),
    'position' => get_the_author_meta('description'),
    'email' => get_the_author_meta('user_email'),
    'headingLevel' => 2,
]);
?>
<hfh-contact v-bind='<?= $props ?>' class="hfh-article__contact"></hfh-contact>