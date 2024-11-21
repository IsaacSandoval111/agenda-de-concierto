<?php
require 'vendor/autoload.php'; // Asegúrate de que PhpSpreadsheet está instalado

use PhpOffice\PhpSpreadsheet\IOFactory;

function loadConcerts($filePath) {
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $data = [];

    foreach ($sheet->getRowIterator() as $row) {
        $concert = [];
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        
        foreach ($cellIterator as $cell) {
            $concert[] = $cell->getValue();
        }
        
        $data[] = $concert;
    }
    
    return $data;
}
?>
