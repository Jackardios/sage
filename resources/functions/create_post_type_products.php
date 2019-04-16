<?php

/**
 * Создние нового типа поста "Продукция"
 */
add_action('init', 'create_post_type_products');
function create_post_type_products()
{
    $labels = array(
        'name' => _x('Продукция', 'Продукция', 'sage'),
        'singular_name' => _x('Продукт', 'Продукт', 'sage'),
        'menu_name' => _x('Продукция', 'Продукция', 'sage'),
        'name_admin_bar' => _x('Продукция', 'Добавить новый продукт', 'sage'),
        'add_new' => __('Добавить новый', 'sage'),
        'add_new_item' => __('Добавить новый продукт', 'sage'),
        'new_item' => __('Новый продукция', 'sage'),
        'edit_item' => __('Изменить продукт', 'sage'),
        'view_item' => __('Посмотреть продукт', 'sage'),
        'all_items' => __('Все продукты', 'sage'),
        'search_items' => __('Найти продукты', 'sage'),
        'parent_item_colon' => __('Родительские продукты:', 'sage'),
        'not_found' => __('Продукты не найдены.', 'sage'),
        'not_found_in_trash' => __('Продукты в корзине не найдены.', 'sage'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'products'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-cart',
        'supports' => array('title', 'editor', 'comments'),
        'show_in_rest' => true,
        'rest_base' => 'products',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type('products', $args);
}

/**
 * Создние таксономии "Категории" для типа поста "Продукция"
 */
add_action('init', 'create_products_categories', 0);
function create_products_categories()
{
    $labels = array(
        'name' => _x('Категории продуктов', 'Категории продуктов', 'sage'),
        'singular_name' => _x('Категория продуктов', 'Категория продуктов', 'sage'),
        'search_items' => __('Найти категории продуктов', 'sage'),
        'all_items' => __('Все категории продуктов', 'sage'),
        'parent_item' => __('Родительская категория', 'sage'),
        'parent_item_colon' => __('Родительская категория:', 'sage'),
        'edit_item' => __('Изменить категорию', 'sage'),
        'update_item' => __('Обновить категорию', 'sage'),
        'add_new_item' => __('Добавить новую категорию', 'sage'),
        'new_item_name' => __('Название новой категории', 'sage'),
        'menu_name' => __('Категории', 'sage'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'has_archive' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'products_categories'),
        'show_in_rest' => true,
        'rest_base' => 'products_categories',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy('products_categories', array('products'), $args);
}

/**
 * Создние таксономии "Размеры" для типа поста "Продукция"
 */
add_action('init', 'create_products_sizes', 0);
function create_products_sizes()
{
    $labels = array(
        'name' => _x('Размеры продуктов', 'Размеры продуктов', 'sage'),
        'singular_name' => _x('Размер продуктов', 'Размер продуктов', 'sage'),
        'search_items' => __('Найти размеры продуктов', 'sage'),
        'all_items' => __('Все размеры продуктов', 'sage'),
        'parent_item' => __('Родительский размер', 'sage'),
        'parent_item_colon' => __('Родительский размер:', 'sage'),
        'edit_item' => __('Изменить размер', 'sage'),
        'update_item' => __('Обновить размер', 'sage'),
        'add_new_item' => __('Добавить новый размер', 'sage'),
        'new_item_name' => __('Название нового размера', 'sage'),
        'menu_name' => __('Размеры', 'sage'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'has_archive' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'products_sizes'),
        'show_in_rest' => true,
        'rest_base' => 'products_sizes',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy('products_sizes', array('products'), $args);
}

/**
 * Создние таксономии "Состав" для типа поста "Продукция"
 */
add_action('init', 'create_products_consists', 0);
function create_products_consists()
{
    $labels = array(
        'name' => _x('Составы продуктов', 'Составы продуктов', 'sage'),
        'singular_name' => _x('Состав продуктов', 'Состав продуктов', 'sage'),
        'search_items' => __('Найти составы продуктов', 'sage'),
        'all_items' => __('Все составы продуктов', 'sage'),
        'parent_item' => __('Родительский состав', 'sage'),
        'parent_item_colon' => __('Родительский состав:', 'sage'),
        'edit_item' => __('Изменить состав', 'sage'),
        'update_item' => __('Обновить состав', 'sage'),
        'add_new_item' => __('Добавить новый состав', 'sage'),
        'new_item_name' => __('Название нового состава', 'sage'),
        'menu_name' => __('Составы', 'sage'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'has_archive' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'products_consists'),
        'show_in_rest' => true,
        'rest_base' => 'products_consists',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy('products_consists', array('products'), $args);
}

// /**
//  * Фильтрация и поиск продукции
//  *
//  * @param [WP_Query] $query
//  * @return void
//  */
// add_action('pre_get_posts', 'products_filter', 1000000, 1);
// function products_filter($query)
// {
//     if (($query->get('post_type') != 'products') or is_admin() or !$query->is_main_query()) return;

//     $tax_query = array('relation' => 'AND');

//     // !временно: выводит все продукты
//     // $query->set('nopaging', true);

//     /* Фильтрация по категории */
//     if (isset($_GET['category'])) {
//         $category_id = intval($_GET['category']);
//         if (!empty($category_id)) {
//             $tax_query[] = array(
//                 'taxonomy' => 'products_categories',
//                 'field' => 'id',
//                 'terms' => array($category_id),
//                 'operator' => 'IN'
//             );
//         }
//     }

//     /* Фильтрация по размеру */
//     if (isset($_GET['sizes'])) {
//         $size_id = intval($_GET['size']);
//         if (!empty($size_id)) {
//             $tax_query[] = array(
//                 'taxonomy' => 'products_sizes',
//                 'field' => 'id',
//                 'terms' => array($size_id),
//                 'operator' => 'IN'
//             );
//         }
//     }

//     /* Фильтрация по составу */
//     if (isset($_GET['consists'])) {
//         $consist_id = intval($_GET['consists']);
//         if (!empty($consist_id)) {
//             $tax_query[] = array(
//                 'taxonomy' => 'products_consists',
//                 'field' => 'id',
//                 'terms' => array($consist_id),
//                 'operator' => 'IN'
//             );
//         }
//     }

//     $query->set('tax_query', $tax_query);

//     /* Поиск */
//     if (isset($_GET['search'])) {
//         $search_query = htmlspecialchars(strtolower($_GET['search']));
//         if (!empty($search_query)) {
//             $query->set('s', $search_query);
//         }
//     }
// }

function get_products_price_range()
{
    $min_price = get_field('min_price', 'options');
    $max_price = get_field('max_price', 'options');

    $min_price = !empty($min_price) && !empty($max_price) ? $min_price : 0;
    $max_price = !empty($max_price) ? $max_price : 0;
    return ['min_price' => $min_price, 'max_price' => $max_price];
}

add_action(
    'rest_api_init',
    function () {
        register_rest_route('wp/v2', '/products_price_range', array(
            'methods' => 'GET',
            'callback' => 'get_products_price_range',
        ));
    }
);

// This enables the orderby=menu_order for Posts
add_filter('rest_products_collection_params', 'filter_add_rest_orderby_params', 10, 1);
/**
 * Add menu_order to the list of permitted orderby values
 */
function filter_add_rest_orderby_params($params)
{
    $params['orderby']['enum'] = array_merge($params['orderby']['enum'], ['new', 'popular', 'price', 'rating']);
    return $params;
}

add_filter('rest_products_query', function ($args) {

    $min_price = (isset($_GET['min_price']) && !empty($_GET['min_price'])) ? floatval($_GET['min_price']) : null;
    $max_price = (isset($_GET['max_price']) && !empty($_GET['max_price'])) ? floatval($_GET['max_price']) : null;
    $orderby = (isset($_GET['orderby']) && !empty($_GET['orderby'])) ? $_GET['orderby'] : null;
    $order = (isset($_GET['order']) && !empty($_GET['order'])) ? $_GET['order'] : null;
    $args['meta_query'] = array(
        'relation' => 'AND',
    );
    if ($min_price) {
        $args['meta_query'][] = array(
            'key' => 'max_price', // 66999
            'value' => $min_price, // 80000
            'compare' => '>=',
            'type' => 'NUMERIC'
        );
    }

    if ($max_price) {
        $args['meta_query'][] = array(
            'key' => 'min_price', // 112899
            'value' => $max_price, // 119900
            'compare' => '<=',
            'type' => 'NUMERIC'
        );
    }


    if ($orderby && in_array($orderby, ['new', 'popular', 'price', 'rating'])) {
        if ($orderby === 'new') {
            $args['orderby'] = 'date';
            $args['order'] = 'desc';
        } else if ($orderby === 'popular') {
            $args['meta_key'] = 'popularity';
            $args['order'] = $order ? $order : 'desc';
            $args['orderby'] = 'meta_value_num';
        } else if ($orderby === 'rating') {
            $args['meta_key'] = 'rating';
            $args['order'] = $order ? $order : 'desc';
            $args['orderby'] = 'meta_value_num';
        } else if ($orderby === 'price') {
            $order = $order ? $order : 'desc';
            if ($order === 'asc') {
                $args['meta_key'] = 'min_price';
            } else {
                $args['meta_key'] = 'max_price';
            }

            $args['order'] = $order;
            $args['orderby'] = 'meta_value_num';
        }
    }

    return $args;
});

function update_catalog_min_max_prices()
{
    $min_price_result = $GLOBALS['wpdb']->get_results("SELECT MIN(CAST(meta_value AS decimal(14, 2))) AS min_price FROM wp_postmeta WHERE meta_key = 'min_price'");
    $max_price_result = $GLOBALS['wpdb']->get_results("SELECT MAX(CAST(meta_value AS decimal(14, 2))) AS max_price FROM wp_postmeta WHERE meta_key = 'max_price'");

    if (!empty($min_price_result)) {
        update_field('min_price', $min_price_result[0]->min_price, 'options');
    }
    if (!empty($max_price_result)) {
        update_field('max_price', $max_price_result[0]->max_price, 'options');
    }
}

function update_product_min_max_prices()
{
    global $post;

    if (get_post_type($post) === 'products') {
        $sizes_prices = get_field('sizes_prices', $post->ID);

        if (!empty($sizes_prices)) {
            $min_price = $sizes_prices[0]['price'];
            $max_price = $sizes_prices[0]['price'];
            foreach ($sizes_prices as $size_price) {
                if ($size_price['price'] < $min_price) {
                    $min_price = $size_price['price'];
                }
                if ($size_price['price'] > $max_price) {
                    $max_price = $size_price['price'];
                }
            }

            update_field('min_price', $min_price, $post);
            update_field('max_price', $max_price, $post);
        }
        update_catalog_min_max_prices();

        $popularity = get_field('popularity', $post->ID);
        $popularity = empty($popularity) || !is_numeric($popularity) ? 0 : intval($popularity);
        if (empty($popularity)) {
            update_field('popularity', 0, $post);
        }
    }
}

add_action('save_post', 'update_product_min_max_prices');
add_action('delete_post', 'update_catalog_min_max_prices');

function update_product_rating($comment_id)
{
    $comment = get_comment($comment_id);
    update_field('rating', get_field('rating', $comment_id), $comment_id);
    update_field('experience', get_field('experience', $comment_id), $comment_id);
    $post = $comment->comment_post_ID;
    if (get_post_type($post) === 'products') {
        $overall_rating = 0;
        $comments_count = 0;
        $comments = get_comments(array(
            'post_id' => $post,
            'post_type' => 'products',
            'fields' => 'ids'
        ));

        foreach ($comments as $comment_id) {
            $status = wp_get_comment_status($comment_id);
            if ($status == "approved") {
                $comment_rating = get_field('rating', "comment_$comment_id");
                $comment_rating = !empty($comment_rating) && is_numeric($comment_rating) ? floatval($comment_rating) : 0;
                if (!empty($comment_rating)) {
                    $overall_rating += (($comment_rating > 0) && ($comment_rating <= 5)) ? $comment_rating : 0;
                    $comments_count++;
                }
            }
        }

        $average_rating = $overall_rating / $comments_count;
        $average_rating = !is_nan($average_rating) ? $average_rating : 0;

        update_field('rating', $average_rating, $post);
    }
}


add_action('comment_post', 'update_product_rating');
add_action('edit_comment', 'update_product_rating');
add_action('wp_set_comment_status', 'update_product_rating');
add_action('deleted_comment', 'update_product_rating');

function filter_rest_allow_anonymous_comments()
{
    return true;
}
add_filter('rest_allow_anonymous_comments', 'filter_rest_allow_anonymous_comments');


/**
 * Перенаправление со страницы с точкой на карту(архив)
 *
 */
add_action('template_redirect', 'redirect_from_single_points');
function redirect_from_single_points()
{

    if (!is_post_type_archive('products')) {
        if (is_tax('products_categories')) {
            $url = get_post_type_archive_link('products') . '?' . 'categories=' . get_queried_object()->term_id;
            wp_redirect($url, 301);
            exit;
        } else if (is_tax('products_sizes')) {
            $url = get_post_type_archive_link('products') . '?' . 'sizes=' . get_queried_object()->term_id;
            wp_safe_redirect($url, 301);
            exit();
        } else if (is_tax('products_consists')) {
            $url = get_post_type_archive_link('products') . '?' . 'consists=' . get_queried_object()->term_id;
            wp_safe_redirect($url, 301);
            exit();
        }
    }

    return;
}

// /**
//  * Перенаправление с архива категорий продукций на архив продукций
//  *
//  */
// add_filter('template_redirect', 'products_categories_redirect_filter', 10, 3);
// function products_categories_redirect_filter() {
//     if ( is_tax( 'products_categories' ) ) {
//         $url = get_post_type_archive_link( 'products' );
//         wp_safe_redirect( $url, 301 );
//         exit();
//     }
