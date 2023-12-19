<?php
get_header();
global $wp_query;
?>
<main id="main" class="hfh-w-container">
    <?php
    if (have_posts()) :
    ?>
        <header>
            <h1><?php the_archive_title(); ?></h1>
        </header>
        <div id="hfh-theme-archive-posts">
            <posts-provider url='<?= admin_url('admin-ajax.php') ?>' :initial-posts='<?= wp_json_encode(hfh_get_teaser_data($wp_query->posts)) ?>' :initial-total-page-count='<?= $wp_query->max_num_pages ?>' v-slot='slotProps' scroll-target-id="hfh-theme-home-teasers">
                <ul id="hfh-theme-home-teasers" class="hfh-theme-teasers">
                    <li v-for='post in slotProps.posts' :key='post.id'>
                        <hfh-teaser :link='post.url' :image-src='post.imageSrc' :image-alt='post.imageAlt' :pretitle='post.pretitle' :title='post.title'>
                            {{post.excerpt}}
                        </hfh-teaser>
                    </li>
                </ul>
                <p v-if='slotProps.posts.length === 0' class="hfh-search__no-results">
                    Die Suche lieferte keine Ergebnisse.
                </p>
                <div class="hfh-theme-pagination">
                    <hfh-pagination v-if="slotProps.totalPageCount > 1" :current-page-number='slotProps.currentPageNumber' :total-page-count='slotProps.totalPageCount' type="Button" @page-selected="slotProps.setPage"></hfh-pagination>
                </div>
            </posts-provider>
        </div>
    <?php
    else :
        get_template_part('template-parts/content', 'none');
    endif;
    ?>
</main>
<?php
get_footer();
