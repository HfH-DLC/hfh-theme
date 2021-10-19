<form role="search" <?php echo $aria_label ?> method="get" class="search-form" action="<? echo esc_url(home_url('/'))  ?>">
    <label class="label">
        <?php echo _x('Search', 'label', 'hfh_theme') ?></label>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'hfh_theme') ?>" value="<?php echo get_search_query() ?>" name="s" />
    <input type="submit" class="search-submit" value="<?php echo esc_attr_x('Search', 'submit button', 'hfh_theme') ?>" />
</form>