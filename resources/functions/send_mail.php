<?php

/**
 * Normalize emails "ACF repeater" field
 */
function normalize_emails_array($array)
{
	$new_array = array();
	foreach ($array as $item) {
		$new_array[] = $item['email'];
	}
	return $new_array;
}

/**
 * Render Email template
 *
 * @param array $data
 * @return void
 */
function renderEmailTemplate($data)
{
	$html = <<<HTMLCONTENT
    <!doctype html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
            html,
            body {
				font-family: Verdana, sans-serif;
				font-size: 14px;
				background: #efefef;
				color: #003351;
			}
			.wrapper {
				max-width: 720px;
				padding: 15px;
				background: #efefef;
			}
			.title {
				font-size: 1.5rem;
				color: #5e7188;
			}
			.table {
				width: 100%;
				margin: 0 auto;
				overflow: auto;
				background: #fff;
				box-shadow: 0 3px 15px -5px rgba(0, 0, 0, .1);
				border-collapse: collapse;
			}
			.column {
				border: 1px solid #efefef;
				padding: 10px;
				overflow: hidden;
				max-height: 200px;
			}
			.column img {
                width: 100%;
                max-width: 150px;
                max-height: 150px;
			}
			.column--strong {
				font-weight: 700;
				color: #003351;
			}
		</style>
    </head>
	<body>
		<div class="wrapper">
			<h2 class="title">{$data['title']}</h2>
			<div class="content">{$data['content']}</div>
		</div>
    </body>
    </html>
HTMLCONTENT;

	return $html;
}

/**
 * Render html table for array data
 */
function renderHTMLTableForArray($array, $title = "Данные")
{
	$htmlTable = "<table class='table'><thead><tr><td class='column column--strong' colspan='2'>$title</td></tr></thead><tbody>";

	foreach ($array as $key => $value) {
		$htmlTable .= "<tr>";
		$htmlTable .= "<td class='column'>$key</td>";
		$htmlTable .= "<td class='column column--strong'>$value</td>";
		$htmlTable .= "</tr>";
	}

	$htmlTable .= "</tbody></table>";

	return $htmlTable;
}

/**
 * Filter the item
 */
function filterItem($item)
{
	// ... Код для фильтрации $item
	return $item;
}

/**
 * Render html table from ONE item
 */
function renderHTMLTableForItem($item)
{
	$item = filterItem($item);
	$htmlTable = "<tr>";

	foreach ($item as $key => $value) {
		$htmlTable .= "<td class='column'>{$value}</td>";
	}

	$htmlTable .= "</tr>";

	return $htmlTable;
}

/**
 * Render html table from items
 */
function renderHTMLTableForItems($items)
{
	$htmlTable = '';
	if (!empty($items)) {
		$item = reset($items);
		$countOfColumns = count($item);
		$htmlTable .= '<table class="table"><thead>';
		$htmlTable .= "<tr><td class='column column--strong' colspan='{$countOfColumns}'>Товары:</td></tr><tr>";

		foreach ($item as $key => $value) {
			$htmlTable .= "<td class='column column--strong'>{$key}:</td>";
		}

		$htmlTable .= '</tr></thead><tbody>';
		foreach ($items as $item) {
			$htmlTable .= renderHTMLTableForItem($item);
		}
		$htmlTable .= "</tbody></table>";
	}

	return $htmlTable;
}

/**
 * Send user 'direct delivery' request to email (ajax action)
 */
add_action('wp_ajax_send_direct_delivery_request', __NAMESPACE__ . '\\sendDirectDeliveryRequest');
add_action('wp_ajax_nopriv_send_direct_delivery_request', __NAMESPACE__ . '\\sendDirectDeliveryRequest');
function sendDirectDeliveryRequest()
{
	try {
		// Валидация
		if (empty($_POST['user_phone'])) {
			throw new Exception('Заполните все обязательные поля отмеченные звездочкой*.');
		}

		if (!empty($_POST['user_email']) && !is_email($_POST['user_email'])) {
			throw new Exception('Указан некорректный email адрес');
		}

		// Подготовка email параметров
		$recipients_emails = normalize_emails_array(get_field('recipients_emails', 'options'));
		$site_url = get_site_url();
		$site_name = get_bloginfo('name');
		$subject = "Новая заявка на 'прямую поставку от производителя' с сайта '{$site_name}' [{$site_url}]";
		$headers = array('content-type: text/html');

		// Подготовка HTML кода email сообщения
		$userdataTable = renderHTMLTableForArray(array(
			"Номер телефона" => $_POST['user_phone'],
			"Email" => !empty($_POST['user_email']) ? $_POST['user_email'] : 'Не был указан',
		), "Отправитель: ");

		$body = renderEmailTemplate(array(
			title => $subject,
			content => $userdataTable,
		));

		// Отправка email сообщения
		if (wp_mail($recipients_emails, $subject, $body, $headers)) {
			echo json_encode(array('status' => 'success', 'message' => "Ваша заявка успешно отправлена"));
			exit;
		} else {
			throw new Exception("Во время отправки запроса произошла внутренняя ошибка, попробуйте еще раз позднее.");
		}
	} catch (Exception $e) {
		echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		exit;
	}
	wp_die();
}

/**
 * Send user call request to email (ajax action)
 */
add_action('wp_ajax_send_callrequest', __NAMESPACE__ . '\\sendCallrequest');
add_action('wp_ajax_nopriv_send_callrequest', __NAMESPACE__ . '\\sendCallrequest');
function sendCallrequest()
{
	try {
		// Валидация
		if (empty($_POST['user_name']) || empty($_POST['user_phone'])) {
			throw new Exception('Заполните все обязательные поля отмеченные звездочкой*.');
		}

		// Подготовка email параметров
		$recipients_emails = normalize_emails_array(get_field('recipients_emails', 'options'));
		$site_url = get_site_url();
		$site_name = get_bloginfo('name');
		$subject = "Новая заявка на обратный звонок с сайта '{$site_name}' [{$site_url}]";
		$headers = array('content-type: text/html');

		// Подготовка HTML кода email сообщения
		$userdataTable = renderHTMLTableForArray(array(
			"Имя" => $_POST['user_name'],
			"Номер телефона" => $_POST['user_phone']
		), "Отправитель: ");

		$body = renderEmailTemplate(array(
			title => $subject,
			content => $userdataTable,
		));

		// Отправка email сообщения
		if (wp_mail($recipients_emails, $subject, $body, $headers)) {
			echo json_encode(array('status' => 'success', 'message' => "Ваша заявка успешно отправлена"));
			exit;
		} else {
			throw new Exception("Во время отправки запроса произошла внутренняя ошибка, попробуйте еще раз позднее.");
		}
	} catch (Exception $e) {
		echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		exit;
	}
	wp_die();
}

/**
 * Send user message to email (ajax action)
 */
add_action('wp_ajax_send_message', __NAMESPACE__ . '\\sendMessage');
add_action('wp_ajax_nopriv_send_message', __NAMESPACE__ . '\\sendMessage');
function sendMessage()
{
	try {
		// Валидация
		if (empty($_POST['user_name']) || empty($_POST['user_phone'])) {
			throw new Exception('Заполните все обязательные поля отмеченные звездочкой*.');
		}

		if (!empty($_POST['user_email']) && !is_email($_POST['user_email'])) {
			throw new Exception('Указан некорректный email адрес');
		}

		// Подготовка email параметров
		$recipients_emails = normalize_emails_array(get_field('recipients_emails', 'options'));
		$site_url = get_site_url();
		$site_name = get_bloginfo('name');
		$subject = "Новое сообщение от пользователя с сайта '{$site_name}' [{$site_url}]";
		$headers = array('content-type: text/html');

		// Подготовка HTML кода email сообщения
		$userdataTable = renderHTMLTableForArray(array(
			"Имя" => $_POST['user_name'],
			"Номер телефона" => $_POST['user_phone'],
			"Email" => $_POST['user_email'] ?? 'Не указан',
			"Сообщение" => $_POST['user_message'] ?? 'Не указано'
		), "Отправитель: ");

		$body = renderEmailTemplate(array(
			title => $subject,
			content => $userdataTable,
		));

		// Отправка email сообщения
		if (wp_mail($recipients_emails, $subject, $body, $headers)) {
			echo json_encode(array('status' => 'success', 'message' => "Ваша сообщение успешно отправлена"));
			exit;
		} else {
			throw new Exception("Во время отправки запроса произошла внутренняя ошибка, попробуйте еще раз позднее.");
		}
	} catch (Exception $e) {
		echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		exit;
	}
	wp_die();
}

/**
 * Send user order request to email (ajax action)
 */
// add_action('wp_ajax_send_order', __NAMESPACE__ . '\\sendOrder');
// add_action('wp_ajax_nopriv_send_order', __NAMESPACE__ . '\\sendOrder');
// function sendOrder()
// {
// 	try {
//         // Валидация
// 		if (empty($_POST['user_name']) || empty($_POST['user_phone'])) {
// 			throw new Exception('Заполните все обязательные поля отмеченные звездочкой*.');
// 		}

// 		if (!empty($_POST['user_email']) && !is_email($_POST['user_email'])) {
// 			throw new Exception('Указан некорректный email адрес');
// 		}

//   	// Подготовка email параметров
// 		$recipients_emails = normalize_emails_array(get_field('recipients_emails', 'options'));
// 		$site_url = get_site_url();
// 		$site_name = get_bloginfo('name');
// 		$subject = "Новый заказ с сайта '{$site_name}' [{$site_url}]";
// 		$headers = array('content-type: text/html');

// 		// Подготовка HTML кода email сообщения
// 		$dataTable = renderHTMLTableForArray(array(
// 			"Имя" => $_POST['user_name'],
// 			"Номер телефона" => $_POST['user_phone'],
// 			"Email" => $_POST['user_email'] ?? 'Не указан',
// 			"Сообщение" => $_POST['user_message'] ?? 'Не указано',
// 		), "Данные заказа: ");


// 		$items = [];
// 		if (isset($_POST['order']) && !empty($_POST['order'])) {
// 			$order = json_decode(str_replace("\\", "", $_POST['order']));

// 			if ($order) {
// 				foreach ($order as $item) {
// 					$ids = explode('_', $item->obj->id);
// 					$post = get_post(intval($ids[0]));
// 					if ($post) {
// 						$name = get_the_title($post);
// 						$link = get_the_permalink($post);

// 						$items[] = [
// 							'Название' => "<a href='$link'>$name</a>",
// 							'Сторона' => isset($ids[1]) ? $ids[1] : ' ',
// 							'Ссылка' => $link,
// 						];
// 					}
// 				}
// 			}
// 		}

// 		$itemsTable = renderHTMLTableForItems($items);

// 		$body = renderEmailTemplate(array(
// 			title => $subject,
// 			content => $dataTable . $itemsTable,
// 		));

//         // Отправка email сообщения
// 		if (wp_mail($recipients_emails, $subject, $body, $headers)) {
// 			echo json_encode(array('status' => 'success', 'message' => "Ваша заявка успешно отправлена"));
// 			exit;
// 		} else {
// 			throw new Exception("Во время отправки запроса произошла внутренняя ошибка, попробуйте еще раз позднее.");
// 		}
// 	} catch (Exception $e) {
// 		echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
// 		exit;
// 	}
// 	wp_die();
// }
