<?php

require_once "../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;

$rutaArchivo = "../xlsx/consoldescarg05sept2021.xlsx";
$docInfo = IOFactory::load($rutaArchivo);

$Hojas = $docInfo->getSheetCount();
$filas10 = $docInfo->getSheet(0);

print(boolval((10<9)));
?>