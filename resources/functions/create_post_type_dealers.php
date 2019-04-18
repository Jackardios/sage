<?php

/**
 * Создние нового типа поста "Дилеры"
 */
add_action('init', 'create_post_type_dealers');
function create_post_type_dealers()
{
    $labels = array(
        'name' => _x('Дилеры', 'Дилеры', 'sage'),
        'singular_name' => _x('Дилеры', 'Дилеры', 'sage'),
        'menu_name' => _x('Дилеры', 'Дилеры', 'sage'),
        'name_admin_bar' => _x('Дилеры', 'Добавить новый дилер', 'sage'),
        'add_new' => __('Добавить новый', 'sage'),
        'add_new_item' => __('Добавить новый дилер', 'sage'),
        'new_item' => __('Новый дилер', 'sage'),
        'edit_item' => __('Изменить дилер', 'sage'),
        'view_item' => __('Посмотреть дилеры', 'sage'),
        'all_items' => __('Все дилеры', 'sage'),
        'search_items' => __('Найти дилеры', 'sage'),
        'parent_item_colon' => __('Родительские дилеры:', 'sage'),
        'not_found' => __('Дилеры не найдены.', 'sage'),
        'not_found_in_trash' => __('Дилеры в корзине не найдены.', 'sage'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'dealers'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-location',
        'supports' => array('title'),
        // 'show_in_rest' => true,
        // 'rest_base' => 'dealers',
        // 'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type('dealers', $args);
}

/**
 * Создние таксономии "Категории" для типа поста "Дилеры"
 */
// add_action('init', 'create_dealers_categories', 0);
// function create_dealers_categories()
// {
//     $labels = array(
//         'name' => _x('Категории дилеров', 'Категории дилеров', 'sage'),
//         'singular_name' => _x('Категория дилеров', 'Категория дилеров', 'sage'),
//         'search_items' => __('Найти категории дилеров', 'sage'),
//         'all_items' => __('Все категории дилеров', 'sage'),
//         'parent_item' => __('Родительская категория', 'sage'),
//         'parent_item_colon' => __('Родительская категория:', 'sage'),
//         'edit_item' => __('Изменить категорию', 'sage'),
//         'update_item' => __('Обновить категорию', 'sage'),
//         'add_new_item' => __('Добавить новую категорию', 'sage'),
//         'new_item_name' => __('Название новой категории', 'sage'),
//         'menu_name' => __('Категории', 'sage'),
//     );

//     $args = array(
//         'hierarchical' => true,
//         'labels' => $labels,
//         'show_ui' => true,
//         'show_admin_column' => true,
//         'has_archive' => false,
//         'query_var' => true,
//         'rewrite' => array('slug' => 'dealers-categories'),
//     );

//     register_taxonomy('dealers_categories', array('dealers'), $args);
// }

/**
 * Фильтрация и поиск продукции
 *
 * @param [WP_Query] $query
 * @return void
 */
add_action('pre_get_posts', 'dealers_filter', 1000000, 1);
function dealers_filter($query)
{
    if (($query->get('post_type') != 'dealers') or is_admin() or !$query->is_main_query()) return;

    // $tax_query = array('relation' => 'AND');

    // /* Фильтрация по категории */
    // if (isset($_GET['category'])) {
    //     $category_id = intval($_GET['category']);
    //     if (!empty($category_id)) {
    //         $tax_query[] = array(
    //             'taxonomy' => 'dealers_categories',
    //             'field' => 'id',
    //             'terms' => array($category_id),
    //             'operator' => 'IN'
    //         );
    //     }
    // }

    // $query->set('tax_query', $tax_query);
    $query->set('posts_per_page', 8);

    /* Поиск */
    if (isset($_GET['search'])) {
        $search_query = htmlspecialchars(strtolower($_GET['search']));
        if (!empty($search_query)) {
            $query->set('s', $search_query);
        }
    }
}

/**
 * [list_searcheable_acf list all the custom fields we want to include in our search query]
 * @return [array] [list of custom fields]
 */
function list_searcheable_acf()
{
    $list_searcheable_acf = array('name');
    return $list_searcheable_acf;
}
/**
 * [advanced_custom_search search that encompasses ACF/advanced custom fields and taxonomies and split expression before request]
 * @param  [query-part/string]      $where    [the initial "where" part of the search query]
 * @param  [object]                 $wp_query []
 * @return [query-part/string]      $where    [the "where" part of the search query as we customized]
 * see https://vzurczak.wordpress.com/2013/06/15/extend-the-default-wordpress-search/
 * credits to Vincent Zurczak for the base query structure/spliting tags section
 */
function advanced_custom_search($where, $wp_query)
{
    if (($wp_query->get('post_type') != 'dealers') or is_admin() or !$wp_query->is_main_query()) return;

    global $wpdb;

    if (empty($where))
        return $where;

    // get search expression
    $terms = $wp_query->query_vars['s'];

    // explode search expression to get search terms
    $exploded = explode(' ', $terms);
    if ($exploded === false || count($exploded) == 0)
        $exploded = array(0 => $terms);

    // reset search in order to rebuilt it as we whish
    $where = '';

    // get searcheable_acf, a list of advanced custom fields you want to search content in
    $list_searcheable_acf = list_searcheable_acf();
    foreach ($exploded as $tag) :
        $where .= " 
          AND (
            (wp_posts.post_title LIKE '%$tag%')
            OR (wp_posts.post_content LIKE '%$tag%')
            OR EXISTS (
              SELECT * FROM wp_postmeta
	              WHERE post_id = wp_posts.ID
	                AND (";
        foreach ($list_searcheable_acf as $searcheable_acf) :
            if ($searcheable_acf == $list_searcheable_acf[0]) :
                $where .= " (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
            else :
                $where .= " OR (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
            endif;
        endforeach;
        $where .= ")
            )
            OR EXISTS (
              SELECT * FROM wp_comments
              WHERE comment_post_ID = wp_posts.ID
                AND comment_content LIKE '%$tag%'
            )
            OR EXISTS (
              SELECT * FROM wp_terms
              INNER JOIN wp_term_taxonomy
                ON wp_term_taxonomy.term_id = wp_terms.term_id
              INNER JOIN wp_term_relationships
                ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
              WHERE (
          		taxonomy = 'post_tag'
            		OR taxonomy = 'category'          		
            		OR taxonomy = 'myCustomTax'
          		)
              	AND object_id = wp_posts.ID
              	AND wp_terms.name LIKE '%$tag%'
            )
        )";
    endforeach;
    return $where;
}

add_filter('posts_search', 'advanced_custom_search', 500, 2);

// /**
//  * Перенаправление с архива категорий продукций на архив продукций
//  *
//  */
// add_filter('template_redirect', 'dealers_categories_redirect_filter', 10, 3);
// function dealers_categories_redirect_filter() {
//     if ( is_tax( 'dealers_categories' ) ) {
//         $url = get_post_type_archive_link( 'dealers' );
//         wp_safe_redirect( $url, 301 );
//         exit();
//     }
// }
