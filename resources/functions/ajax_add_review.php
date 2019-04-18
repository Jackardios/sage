<?php

/**
 * Add user review(comment) (ajax action)
 */
add_action('wp_ajax_add_review', __NAMESPACE__ . '\\addReview');
add_action('wp_ajax_nopriv_add_review', __NAMESPACE__ . '\\addReview');
function addReview()
{
  try {
    // Валидация
    if (empty($_POST['user_name']) || empty($_POST['user_email']) || empty($_POST['user_experience']) || empty($_POST['user_review'])) {
      throw new Exception('Заполните все обязательные поля отмеченные звездочкой*.');
    }

    if (!empty($_POST['user_email']) && !is_email($_POST['user_email'])) {
      throw new Exception('Указан некорректный email адрес');
    }

    // Подготовка данных
    $data = [
      'comment_author' => $_POST['user_name'],
      'comment_author_email' => $_POST['user_email'],
      'comment_content' => $_POST['user_review'],
      'comment_post_ID' => $_POST['post_id'],
      'comment_approved' => 0,
      'comment_meta' => [
        'rating' => !empty($_POST['user_rating']) ? floatval($_POST['user_rating']) : 0,
        'experience' => !empty($_POST['user_experience']) ? $_POST['user_experience'] : '',
      ]
    ];

    // Сохранение отзыва
    if (wp_insert_comment($data)) {
      echo json_encode(array('status' => 'success', 'message' => "Ваш отзыв успешно отправлен на модерацию"));
      exit;
    } else {
      throw new Exception("Во время сохранения отзыва произошла внутренняя ошибка, попробуйте еще раз позднее.");
    }
  } catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
    exit;
  }
  wp_die();
}
