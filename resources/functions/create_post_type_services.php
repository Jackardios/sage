<?php

/**
 * Создние нового типа поста "Услуги"
 */
add_action('init', 'create_post_type_services');
function create_post_type_services()
{
    $labels = array(
        'name' => _x('Услуги', 'Услуги', 'sage'),
        'singular_name' => _x('Услуга', 'Услуга', 'sage'),
        'menu_name' => _x('Услуги', 'Услуги', 'sage'),
        'name_admin_bar' => _x('Услуги', 'Добавить новую услугу', 'sage'),
        'add_new' => __('Добавить новую', 'sage'),
        'add_new_item' => __('Добавить новую услугу', 'sage'),
        'new_item' => __('Новая услуга', 'sage'),
        'edit_item' => __('Изменить услугу', 'sage'),
        'view_item' => __('Посмотреть услугу', 'sage'),
        'all_items' => __('Все услуги', 'sage'),
        'search_items' => __('Найти услуги', 'sage'),
        'parent_item_colon' => __('Родительские услуги:', 'sage'),
        'not_found' => __('Услуги не найдены.', 'sage'),
        'not_found_in_trash' => __('Услуги в корзине не найдены.', 'sage'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'services'),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 7,
        'menu_icon' => 'dashicons-cart',
        'supports' => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('services', $args);
}

/**
 * Фильтрация и поиск услуг
 *
 * @param [WP_Query] $query
 * @return void
 */
add_action('pre_get_posts', 'services_filter');
function services_filter($query)
{
    if (($query->get('post_type') != 'services') or is_admin()) return;
	/* Поиск */
    $query->set('orderby', 'date');
    $query->set('order', 'ASC');
    if (isset($_GET['search'])) {
        $search_query = htmlspecialchars(strtolower($_GET['search']));
        if (!empty($search_query)) {
            $query->set('s', $search_query);
        }
    }
}

// function services_archive_redirect()
// {
//     if (is_post_type_archive('services')) {
//         wp_redirect(home_url('/services/'), 301);
//         exit();
//     }
// }
// add_action('template_redirect', 'services_archive_redirect');