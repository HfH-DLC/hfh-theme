<div id="hfh-theme-search-form">
    <hfh-search-bar method="get" action="<?= esc_url(home_url('/')); ?>" label-text="<?= _ex('Search', 'Search Input Label', 'hfh-theme'); ?>" submit-text="<?= _ex('All results', 'Search Submit Text', 'hfh-theme') ?>" placeholder="<?= _ex('Search &hellip;', 'Search Placeholder Text', 'hfh-theme') ?>" value="<?= get_search_query() ?>" input-name="s">
    </hfh-search-bar>
</div>