<?php
get_header();
?>
<main id="main" class="hfh-w-container">
    <?php
    if (have_posts()) :


    ?>
        <header>
            <h1 class="hfh-sr-only">
                <?php
                if (is_front_page()) {
                    echo bloginfo('title');
                } else {
                    echo single_post_title();
                }
                ?>
            </h1>
        </header>
        <?php

        global $wp_query;

        if (get_theme_mod('hfh_show_slider')) :
        ?>
            <hfh-slider :slides='<?= wp_json_encode(hfh_get_slides()) ?>'></hfh-slider>
        <?php endif; ?>
        <posts-provider url='<?= admin_url('admin-ajax.php') ?>' :initial-posts='<?= wp_json_encode(hfh_get_teaser_data($wp_query->posts)) ?>' :initial-total-page-count='<?= $wp_query->max_num_pages ?>' v-slot='slotProps' scroll-target-id="hfh-theme-home-teasers">
            <?php if (get_theme_mod('hfh_show_category_filter')) : ?>
                <category-filter :categories='<?= hfh_get_category_filter_data() ?>' @filter-changed='slotProps.setFilter'></category-filter>
            <?php endif; ?>
            <ul id="hfh-theme-home-teasers" class="hfh-theme-teasers">
                <li v-for='post in slotProps.posts' :key='post.id'>
                    <hfh-teaser :link='post.url' :image-src='post.imageSrc' :image-alt='post.imageAlt' :pretitle='post.pretitle' :title='post.title'>
                        {{post.excerpt}}
                    </hfh-teaser>
                </li>
            </ul>
            <p v-if='slotProps.posts.length === 0' class="hfh-search__no-results">
                <?= __('Your search yielded no results.', 'hfh') ?>
            </p>
            <div id="hfh-theme-pagination">
                <hfh-pagination v-if="slotProps.totalPageCount > 1" :current-page-number='slotProps.currentPageNumber' :total-page-count='slotProps.totalPageCount' type="Button" @page-selected="slotProps.setPage"></hfh-pagination>
            </div>
        </posts-provider>
    <?php
    else :
        get_template_part('template-parts/content', 'none');
    endif;
    ?>
</main>
<?php
get_footer();
