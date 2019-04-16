<?php

/**
 * Создние нового типа поста "Документы"
 */
add_action('init', 'create_post_type_documents');
function create_post_type_documents()
{
    $labels = array(
        'name' => _x('Документы', 'Документы', 'sage'),
        'singular_name' => _x('Документ', 'Документ', 'sage'),
        'menu_name' => _x('Документы', 'Документы', 'sage'),
        'name_admin_bar' => _x('Документы', 'Добавить новый документ', 'sage'),
        'add_new' => __('Добавить новый', 'sage'),
        'add_new_item' => __('Добавить новый документ', 'sage'),
        'new_item' => __('Новый продукция', 'sage'),
        'edit_item' => __('Изменить документ', 'sage'),
        'view_item' => __('Посмотреть документ', 'sage'),
        'all_items' => __('Все документы', 'sage'),
        'search_items' => __('Найти документы', 'sage'),
        'parent_item_colon' => __('Родительские документы:', 'sage'),
        'not_found' => __('Документы не найдены.', 'sage'),
        'not_found_in_trash' => __('Документы в корзине не найдены.', 'sage'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'documents'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-media-default',
        'supports' => array('title'),
    );

    register_post_type('documents', $args);
}

/**
 * Создние таксономии "Категории" для типа поста "Документы"
 */
add_action('init', 'create_documents_categories', 0);
function create_documents_categories()
{
    $labels = array(
        'name' => _x('Категории документов', 'Категории документов', 'sage'),
        'singular_name' => _x('Категория документов', 'Категория документов', 'sage'),
        'search_items' => __('Найти категории документов', 'sage'),
        'all_items' => __('Все категории документов', 'sage'),
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
        'rewrite' => array('slug' => 'documents_categories'),
    );

    register_taxonomy('documents_categories', array('documents'), $args);
}

/**
 * Фильтрация и поиск продукции
 *
 * @param [WP_Query] $query
 * @return void
 */
add_action('pre_get_posts', 'documents_filter', 1000000, 1);
function documents_filter($query)
{
    if (($query->get('post_type') != 'documents') or is_admin() or !$query->is_main_query()) return;

    $tax_query = array('relation' => 'AND');

    /* Фильтрация по категории */
    if (isset($_GET['category'])) {
        $category_id = intval($_GET['category']);
        if (!empty($category_id)) {
            $tax_query[] = array(
                'taxonomy' => 'documents_categories',
                'field' => 'id',
                'terms' => array($category_id),
                'operator' => 'IN'
            );
        }
    }

    $query->set('tax_query', $tax_query);
    $query->set('posts_per_page', 8);

    /* Поиск */
    if (isset($_GET['search'])) {
        $search_query = htmlspecialchars(strtolower($_GET['search']));
        if (!empty($search_query)) {
            $query->set('s', $search_query);
        }
    }
}

// /**
//  * Перенаправление с архива категорий продукций на архив продукций
//  *
//  */
// add_filter('template_redirect', 'documents_categories_redirect_filter', 10, 3);
// function documents_categories_redirect_filter() {
//     if ( is_tax( 'documents_categories' ) ) {
//         $url = get_post_type_archive_link( 'documents' );
//         wp_safe_redirect( $url, 301 );
//         exit();
//     }
// }