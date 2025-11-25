<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crear un archivo Excel simple
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hola');
$sheet->setCellValue('B1', 'Mundo');

$writer = new Xlsx($spreadsheet);
$writer->save('prueba.xlsx');

echo "Archivo Excel creado con éxito: prueba.xlsx";
?>
