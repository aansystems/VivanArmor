<?php

require_once "bootstrap.php";
/*use \vendor\PhpOffice\PhpWord\src\PhpWord\IOFactory;*/



$objReader =\PhpOffice\PhpWord\IOFactory::createReader('Word2007');

$phpWord = $objReader->load("test.docx");
//print_r($phpWord);
//die();

$rendererName =\PhpOffice\PhpWord\Settings::PDF_RENDERER_TCPDF;

$rendererLibrary= 'tcpdf';
$rendererLibraryPath = '' . $rendererLibrary;

if(!\PhpOffice\PhpWord\Settings::setPdfRenderer(
$rendererName,
$rendererLibraryPath
	)){

}

$rendererLibraryPath = '' . $rendererLibrary;

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');


$objWriter->save("test.pdf");
