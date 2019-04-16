<?php

/**
 * Создние нового типа поста "Проекты"
 */
add_action('init', 'create_post_type_projects');
function create_post_type_projects()
{
    $labels = array(
        'name' => _x('Портфолио', 'Портфолио', 'sage'),
        'singular_name' => _x('Проект', 'Проект', 'sage'),
        'menu_name' => _x('Портфолио', 'Портфолио', 'sage'),
        'name_admin_bar' => _x('Портфолио', 'Добавить новый проект', 'sage'),
        'add_new' => __('Добавить новый', 'sage'),
        'add_new_item' => __('Добавить новый проект', 'sage'),
        'new_item' => __('Новый продукция', 'sage'),
        'edit_item' => __('Изменить проект', 'sage'),
        'view_item' => __('Посмотреть проект', 'sage'),
        'all_items' => __('Все проекты', 'sage'),
        'search_items' => __('Найти проекты', 'sage'),
        'parent_item_colon' => __('Родительские проекты:', 'sage'),
        'not_found' => __('Проекты не найдены.', 'sage'),
        'not_found_in_trash' => __('Проекты в корзине не найдены.', 'sage'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'portfolio'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title'),
        'show_in_rest' => true,
        'rest_base' => 'projects',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type('projects', $args);
}

/**
 * Создние таксономии "Категории" для типа поста "Проекты"
 */
add_action('init', 'create_projects_categories', 0);
function create_projects_categories()
{
    $labels = array(
        'name' => _x('Категории проектов', 'Категории проектов', 'sage'),
        'singular_name' => _x('Категория проектов', 'Категория проектов', 'sage'),
        'search_items' => __('Найти категории проектов', 'sage'),
        'all_items' => __('Все категории проектов', 'sage'),
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
        'rewrite' => array('slug' => 'projects_categories'),
        'show_in_rest' => true,
        'rest_base' => 'projects_categories',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy('projects_categories', array('projects'), $args);
}

/**
 * Фильтрация и поиск продукции
 *
 * @param [WP_Query] $query
 * @return void
 */
add_action('pre_get_posts', 'projects_filter', 1000000, 1);
function projects_filter($query)
{
    if (($query->get('post_type') != 'projects') or is_admin() or !$query->is_main_query()) return;

    $tax_query = array('relation' => 'AND');

    // !временно: выводит все проекты
    $query->set('nopaging', true);

    /* Фильтрация по категории */
    if (isset($_GET['category'])) {
        $category_id = intval($_GET['category']);
        if (!empty($category_id)) {
            $tax_query[] = array(
                'taxonomy' => 'projects_categories',
                'field' => 'id',
                'terms' => array($category_id),
                'operator' => 'IN'
            );
        }
    }

    $query->set('tax_query', $tax_query);

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
// add_filter('template_redirect', 'projects_categories_redirect_filter', 10, 3);
// function projects_categories_redirect_filter() {
//     if ( is_tax( 'projects_categories' ) ) {
//         $url = get_post_type_archive_link( 'projects' );
//         wp_safe_redirect( $url, 301 );
//         exit();
//     }
