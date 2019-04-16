<?php

/**
 * Создние нового типа поста "F.A.Q"
 */
add_action('init', 'create_post_type_faq');
function create_post_type_faq()
{
    $labels = array(
        'name' => _x('F.A.Q', 'F.A.Q', 'sage'),
        'singular_name' => _x('F.A.Q', 'F.A.Q', 'sage'),
        'menu_name' => _x('F.A.Q', 'F.A.Q', 'sage'),
        'name_admin_bar' => _x('F.A.Q', 'Добавить новый вопрос', 'sage'),
        'add_new' => __('Добавить новый', 'sage'),
        'add_new_item' => __('Добавить новый вопрос', 'sage'),
        'new_item' => __('Новый вопрос', 'sage'),
        'edit_item' => __('Изменить вопрос', 'sage'),
        'view_item' => __('Посмотреть вопросы', 'sage'),
        'all_items' => __('Все вопросы', 'sage'),
        'search_items' => __('Найти вопросы', 'sage'),
        'parent_item_colon' => __('Родительские вопросы:', 'sage'),
        'not_found' => __('Вопросы не найдены.', 'sage'),
        'not_found_in_trash' => __('Вопросы в корзине не найдены.', 'sage'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'faq'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-editor-help',
        'supports' => array('title', 'editor'),
    );

    register_post_type('faq', $args);
}

/**
 * Создние таксономии "Категории" для типа поста "F.A.Q"
 */
add_action('init', 'create_faq_categories', 0);
function create_faq_categories()
{
    $labels = array(
        'name' => _x('Категории faq', 'Категории faq', 'sage'),
        'singular_name' => _x('Категория faq', 'Категория faq', 'sage'),
        'search_items' => __('Найти категории faq', 'sage'),
        'all_items' => __('Все категории faq', 'sage'),
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
        'rewrite' => array('slug' => 'faq-categories'),
    );

    register_taxonomy('faq_categories', array('faq'), $args);
}

/**
 * Фильтрация и поиск продукции
 *
 * @param [WP_Query] $query
 * @return void
 */
add_action('pre_get_posts', 'faq_filter', 1000000, 1);
function faq_filter($query)
{
    if (($query->get('post_type') != 'faq') or is_admin() or !$query->is_main_query()) return;

    $tax_query = array('relation' => 'AND');

    /* Фильтрация по категории */
    if (isset($_GET['category'])) {
        $category_id = intval($_GET['category']);
        if (!empty($category_id)) {
            $tax_query[] = array(
                'taxonomy' => 'faq_categories',
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
// add_filter('template_redirect', 'faq_categories_redirect_filter', 10, 3);
// function faq_categories_redirect_filter() {
//     if ( is_tax( 'faq_categories' ) ) {
//         $url = get_post_type_archive_link( 'faq' );
//         wp_safe_redirect( $url, 301 );
//         exit();
//     }
// }
