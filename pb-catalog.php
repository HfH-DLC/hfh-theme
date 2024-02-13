<?php

if (!defined('ABSPATH')) {
    exit;
}

use Pressbooks\Catalog as PB_Catalog;

// -------------------------------------------------------------------------------------------------------------------
// Helpers
// -------------------------------------------------------------------------------------------------------------------

/**
 * Try to get the height of cover using the image name
 * Ie. http://blah/foobar-225x126.jpg would return 126
 *
 * @param string $cover_url
 *
 * @return int
 */
function _cover_height($cover_url)
{

    $cover_height = 300;

    if (preg_match('/x(\d+)(?=\.(jp?g|png|gif)$)/i', $cover_url, $matches)) {
        $new_cover_height = (int) $matches[1];
        if ($new_cover_height < 100) {
            $new_cover_height = $cover_height;
        } elseif ($new_cover_height > $cover_height) {
            $new_cover_height = $cover_height;
        }
    }

    return isset($new_cover_height) ? $new_cover_height : $cover_height;
}


/**
 * Get book data
 * Sort by featured DESC, title ASC
 *
 * @param PB_Catalog $catalog
 *
 * @return array
 */
function _books(PB_Catalog $catalog)
{

    $books = $catalog->getAggregate();

    foreach ($books as $key => $val) {

        // Deleted
        if ($val['deleted']) {
            unset($books[$key]);
            continue;
        }

        // Calculate cover height
        $books[$key]['cover_height'] = _cover_height($val['cover_url']['pb_cover_medium']);
    }

    return wp_list_sort($books, array(
        'featured' => 'desc',
        'title' => 'asc',
    ));
}

// -------------------------------------------------------------------------------------------------------------------
// Variables
// -------------------------------------------------------------------------------------------------------------------

$pb_user_id = get_user_by('login', get_query_var('pb_catalog_user'))->ID;
$catalog = new PB_Catalog(absint($pb_user_id)); // Note: $pb_user_id is set in PB_Catalog::loadTemplate()
$profile = $catalog->getProfile();
$books = _books($catalog);

// -------------------------------------------------------------------------------------------------------------------
// HTML
// -------------------------------------------------------------------------------------------------------------------
?>
<?php
get_header();
?>
<main id="main">
    <!-- Books -->
    <div id="hfh-theme-catalog" class="hfh-w-container">
        <?php
        $booksInfos = [];
        foreach ($books as $b) {
            $booksInfos[] = [
                'link' => get_home_url($b['blogs_id']),
                'imageSrc' => $b['cover_url']['full'],
                'imageAlt' => '',
                'pretitle' => $b['author'],
                'title' => $b['title'],
                'excerpt' => wp_trim_words(strip_tags(pb_decode($b['about'])), 50, '...'),
                'tags1' => $b['tag_1'],
                'tags2' => $b['tag_2'],
            ];
        }
        $tags1 = wp_json_encode($catalog->getTags(1, false));
        $tags2 = wp_json_encode($catalog->getTags(2, false));
        $tag1Name = (!empty($profile["pb_catalog_tag_1_name"])) ? esc_html(strip_tags($profile["pb_catalog_tag_1_name"])) : __('Tag', 'pressbooks') . " 1";
        $tag2Name = (!empty($profile["pb_catalog_tag_2_name"])) ? esc_html(strip_tags($profile["pb_catalog_tag_2_name"])) : __('Tag', 'pressbooks') . " 2";
        ?>
        <books-provider :initial-books='<?= wp_json_encode($booksInfos) ?>' v-slot='slotProps'>

            <h1 class="hfh-w-container"><?php _e('Catalog', 'pressbooks'); ?></h1>
            <div class="hfh-theme-catalog">
                <div>
                    <tag-filter class="hfh-theme-catalog__tag-filter" tag-1-name='<?= $tag1Name ?>' :tags1='<?= $tags1 ?>' tag-2-name='<?= $tag2Name ?>' :tags2='<?= $tags2 ?>' @tags-changed='slotProps.setTags'></tag-filter>
                </div>
                <div>
                    <book-grid :books='slotProps.books' class="hfh-theme-catalog__book-grid">
                        <?php echo wp_trim_words(strip_tags(pb_decode($b['about'])), 50, '...'); ?>
                    </book-grid>
                </div>
            </div>
        </books-provider>
    </div>
</main>
<?php
get_footer()
?>