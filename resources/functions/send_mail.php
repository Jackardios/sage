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
		$htmlTable .= "<tr><td class='column column--strong' colspan='{$countOfColumns}'>Выбранные услуги:</td></tr><tr>";

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

function userfiles_upload($field_name = 'user_files')
{
	if (wp_verify_nonce($_POST['fileup_nonce'], $field_name)) {

		if (!function_exists('wp_handle_upload'))
			require_once(ABSPATH . 'wp-admin/includes/file.php');

		$files = &$_FILES[$field_name];
		$movefiles = [];
		$overrides = ['test_form' => false];
		foreach ($files['name'] as $key => $value) {
			if ($files['name'][$key]) {
				$file = array(
					'name'     => $files['name'][$key],
					'type'     => $files['type'][$key],
					'tmp_name' => $files['tmp_name'][$key],
					'error'    => $files['error'][$key],
					'size'     => $files['size'][$key]
				);
				$movefile = wp_handle_upload($file, $overrides);
				if (!empty($movefile['error'])) {
					throw new Exception($movefile['error']);
					return false;
				}
				$movefiles[] = $movefile['file'];
			}
		}

		return $movefiles;
	}
	return false;
}

function remove_files($files)
{
	foreach ($files as $file) {
		unlink($file);
	}
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
			$response_message = '<div class="font-700 text-lg text-primary-500">Ваша заявка на обратный звонок успешно отправлена.</div><div class="text-gray-600 mt-4">Наш менеджер свяжется с вами в ближайшее время</div>';
			echo json_encode(array('status' => 'success', 'message' => $response_message));
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
	$files = [];
	try {
		// Валидация
		if (empty($_POST['user_contact'])) {
			throw new Exception('Заполните все обязательные поля отмеченные звездочкой*.');
		}

		// Подготовка email параметров
		$recipients_emails = normalize_emails_array(get_field('recipients_emails', 'options'));
		$site_url = get_site_url();
		$site_name = get_bloginfo('name');
		$subject = "Новое сообщение от пользователя с сайта '{$site_name}' [{$site_url}]";
		$headers = array('content-type: text/html');
		$files = userfiles_upload();

		if ($files === false) {
			throw new Exception("Не удалось загрузить прикрепленные файлы.");
		}

		// Подготовка HTML кода email сообщения
		$userdataTable = renderHTMLTableForArray(array(
			"Имя" => $_POST['user_name'],
			"Номер телефона/Email" => $_POST['user_contact'],
			"Сообщение" => $_POST['user_message'] ?? 'Не указано'
		), "Отправитель: ");


		$itemsTable = isset($_POST['order']) && !empty($_POST['order']) ? renderHTMLTableForItems(getItemsFromOrder($_POST['order'])) : '';

		$body = renderEmailTemplate(array(
			title => $subject,
			content => $userdataTable . $itemsTable,
		));

		// Отправка email сообщения
		if (wp_mail($recipients_emails, $subject, $body, $headers, $files)) {
			$response_message = '<div class="font-700 text-lg text-primary-500">Ваше сообщение успешно отправлено.</div><div class="text-gray-600 mt-4">Наш менеджер свяжется с вами в ближайшее время</div>';
			echo json_encode(array('status' => 'success', 'message' => $response_message));
		} else {
			throw new Exception("Во время отправки запроса произошла внутренняя ошибка, попробуйте еще раз позднее.");
		}
	} catch (Exception $e) {
		echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
	} finally {
		remove_files($files);
	}
	wp_die();
}

/**
 * Send user order request to email (ajax action)
 */
add_action('wp_ajax_send_order', __NAMESPACE__ . '\\sendOrder');
add_action('wp_ajax_nopriv_send_order', __NAMESPACE__ . '\\sendOrder');
function sendOrder()
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
		$subject = "Новый заказ с сайта '{$site_name}' [{$site_url}]";
		$headers = array('content-type: text/html');

		// Подготовка HTML кода email сообщения
		$dataTable = renderHTMLTableForArray(array(
			"Имя" => $_POST['user_name'],
			"Номер телефона" => $_POST['user_phone'],
			"Email" => $_POST['user_email'] ?? 'Не указан',
			"Сообщение" => $_POST['user_message'] ?? 'Не указано',
		), "Данные заказа: ");

		$items = [];
		if (isset($_POST['order']) && !empty($_POST['order'])) {
			$order = json_decode(str_replace("\\", "", $_POST['order']));

			if ($order) {
				foreach ($order as $item) {
					$post = get_post(intval($item->id));
					if ($post) {
						$name = get_the_title($post);
						$link = get_the_permalink($post);
						$custom_props = (array) $item->customProps;
						$custom_props_string = '';

						foreach ($custom_props as $key => $value) {
							$custom_props_string .= "{$key}: <b>{$value}</b>;<br>";
						}
						$custom_props_string .= "Количество: <b>{$item->quantity}</b>;";
						$item_data = [
							'Услуга' => "<a href='$link'>$name</a>",
							'Выбранные опции' => $custom_props_string
						];
						$items[] = $item_data;
					}
				}
			}
		}

		$itemsTable = renderHTMLTableForItems($items);

		$body = renderEmailTemplate(array(
			title => $subject,
			content => $dataTable . $itemsTable,
		));

		// Отправка email сообщения
		if (wp_mail($recipients_emails, $subject, $body, $headers)) {
			$response_message = '<div class="font-700 text-lg text-primary-500">Ваш заказ успешно отправлен.</div><div class="text-gray-600 mt-4">Наш менеджер свяжется с вами в ближайшее время</div>';
			echo json_encode(array('status' => 'success', 'message' => $response_message));
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
