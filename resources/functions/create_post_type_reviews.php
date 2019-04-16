<?php

/**
 * Создние нового типа поста "Отзывы"
 */
add_action('init', 'create_post_type_reviews');
function create_post_type_reviews()
{
    $labels = array(
        'name' => _x('Отзывы', 'Отзывы', 'sage'),
        'singular_name' => _x('Отзыв', 'Отзыв', 'sage'),
        'menu_name' => _x('Отзывы', 'Отзывы', 'sage'),
        'name_admin_bar' => _x('Отзывы', 'Добавить новый отзыв', 'sage'),
        'add_new' => __('Добавить новый', 'sage'),
        'add_new_item' => __('Добавить новый отзыв', 'sage'),
        'new_item' => __('Новый отзыв', 'sage'),
        'edit_item' => __('Изменить отзыв', 'sage'),
        'view_item' => __('Посмотреть отзыв', 'sage'),
        'all_items' => __('Все отзывы', 'sage'),
        'search_items' => __('Найти отзывы', 'sage'),
        'parent_item_colon' => __('Родительские отзывы:', 'sage'),
        'not_found' => __('Отзывы не найдены.', 'sage'),
        'not_found_in_trash' => __('Отзывы в корзине не найдены.', 'sage'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'reviews'),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 7,
        'menu_icon' => 'dashicons-admin-comments',
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
        'rest_base' => 'reviews',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type('reviews', $args);
}