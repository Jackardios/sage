<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

define('CHARS', array('A', 'B', 'C', 'D', 'E', 'F', 'J', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'));

function generateExcelFileLinkFromData($data)
{
    $uploadDir = wp_upload_dir();
    $fileName = uniqid($data['prefix'] . '_') . '.xlsx';
    $uploadPath = $uploadDir['path'] . '/' . $fileName;
    $uploadUrl = $uploadDir['url'] . '/' . $fileName;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $arHeadStyle = array(
        'font' => array(
            'name' => 'Arial',
            'size' => 8,
            'bold' => true,
            'italic' => true,
        )
    );

    $sheet->getColumnDimension('A')->setWidth(18);
    $sheet->getColumnDimension('B')->setWidth(80);
    $sheet->getColumnDimension('C')->setWidth(5);
    $sheet->getColumnDimension('D')->setWidth(16);
    $sheet->getColumnDimension('E')->setWidth(16);
    $sheet->getColumnDimension('F')->setWidth(12);
    $sheet->getColumnDimension('G')->setWidth(16);
    $sheet->getColumnDimension('H')->setWidth(13);
    $sheet->getColumnDimension('I')->setWidth(20);
    $sheet->getColumnDimension('J')->setWidth(20);
    $sheet->getColumnDimension('K')->setWidth(20);
    $sheet->getColumnDimension('L')->setWidth(4);
    $sheet->getColumnDimension('M')->setWidth(16);
    $sheet->getColumnDimension('N')->setWidth(16);
    $sheet->getColumnDimension('O')->setWidth(16);
    $sheet->getColumnDimension('P')->setWidth(16);
    $sheet->getColumnDimension('Q')->setWidth(16);
    $sheet->getColumnDimension('R')->setWidth(16);
    $sheet->getColumnDimension('S')->setWidth(16);

    $l = 0;
    foreach ($data['titles'] as $title) {
        $sheet->setCellValue(CHARS[$l] . "1", $title); // Заполняем первую строку заголовками
        $sheet->getStyle(CHARS[$l] . "1")->applyFromArray($arHeadStyle);
        $l = $l + 1;
    }

    $i = 1;
    foreach ($data['fields'] as $field) {
        $j = 0;
        $i = $i + 1;
        foreach ($field as $value) {
            if (preg_match("@^http://@i", $value) or preg_match("@^https://@i", $value)) {
                $sheet->setCellValue(CHARS[$j] . $i, "Ссылка");
                $sheet->getCell(CHARS[$j] . $i)->getHyperlink()->setUrl($value);
            } else {
                $val = strip_tags($value);
                $sheet->setCellValue(CHARS[$j] . $i, $val); // Заполнение полей параметрами    
            }


            $j = $j + 1;
        }
    }

    $sheet->setTitle("Корзина k-media.ru");

    $writer = new Xlsx($spreadsheet);
    $writer->save($uploadPath);

    return $uploadUrl;
}


/**
 * Generates excel file by data
 */
add_action('wp_ajax_generate_excel', __NAMESPACE__ . '\\generateExcel');
add_action('wp_ajax_nopriv_generate_excel', __NAMESPACE__ . '\\generateExcel');
function generateExcel()
{
    try {
        if (!isset($_POST['data']) || empty($_POST['data'])) {
            throw new Exception("Не были переданы данные для создания excel файла!");
        }

        $xls_link = generateExcelFileLinkFromData($_POST['data']);

        if (!empty($xls_link)) {
            echo json_encode(array('status' => 'success', 'message' => "<a href='{$xls_link}'>{$xls_link}</a>"));
            exit;
        } else {
            throw new Exception("Во время отправки запроса произошла внутренняя ошибка, пожалуйста попробуйте еще раз позднее");
        }
    } catch (Exception $e) {
        echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        exit;
    }
    wp_die();
}