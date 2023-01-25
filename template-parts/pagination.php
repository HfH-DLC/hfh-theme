<?php
global $wp_query;

if ($wp_query->max_num_pages > 1) :
    $current_page = intval((get_query_var('paged')) ? get_query_var('paged') : 1);
    $total_page_count = $wp_query->max_num_pages;
    $pages = [];
    foreach (range(1, $total_page_count) as $i) {
        $pages[] = get_pagenum_link($i);
    }
    $props = wp_json_encode(['currentPageNumber' => $current_page, 'totalPageCount' => $total_page_count, 'pageLinks' => $pages]);
?>
    <div id="hfh-theme-pagination">
        <hfh-pagination v-bind='<?= $props ?>'></hfh-pagination>
    </div>
<?php
endif;
