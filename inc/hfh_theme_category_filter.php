<?php

class HfH_Theme_Category_Filter
{

    static $instance = false;

    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new self;
        return self::$instance;
    }

    public function get_data($category_ids, $restricted_by)
    {
        $result = array();

        if ($category_ids) {
            $selection = array_merge(array(
                'parent' => 0,
            ));
            $top_categories = get_categories($selection);

            /** Sort in according to position in category_ids */
            usort(
                $top_categories,
                function ($u1, $u2) use ($category_ids) {
                    return array_search($u1->term_id, $category_ids) >= array_search($u2->term_id, $category_ids) ? 1 : -1;
                }
            );
        } else {
            $selection = array(
                'parent' => 0,
            );
            $top_categories = get_categories($selection);
        }

        $allowed_ids = null;
        if ($restricted_by) {
            $allowed_ids = $this->get_allowed_ids($restricted_by);
        }

        $result = array_map(function ($category) use ($allowed_ids) {
            return $this->get_category_data($category, $allowed_ids);
        }, $top_categories);

        return wp_json_encode($result);
    }

    private function get_category_data($category, $allowed_ids)
    {
        return array(
            'id' => $category->term_id,
            'name' => $category->name,
            'children' => $this->get_subcategories($category, $allowed_ids)
        );
    }

    private function get_allowed_ids($restricted_by)
    {
        $query = new WP_Query(
            array(
                'posts_per_page' => -1,
                'fields'         => 'ids',
                'post_type'      => 'any',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'term_id',
                        'terms'    => $restricted_by,
                    ),
                ),
            )
        );
        return $query->posts;
    }

    private function get_subcategories($category, $allowed_ids)
    {


        $selection = array(
            'parent' => $category->term_id,
        );
        if ($allowed_ids) {
            $selection['include'] = $allowed_ids;
        }
        $subcategories = get_categories(
            $selection
        );

        $result = array();
        foreach ($subcategories as $category) {
            $result[] = $this->get_category_data($category, $allowed_ids);
        }
        return $result;
    }
}

HfH_Theme_Category_Filter::getInstance();
