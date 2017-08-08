<?php if ( !defined('BASEPATH')) exit();
class Barcode
{
    function __construct()
    {
        require_once APPPATH.'/libraries/barcode/class/BCGColor.php';
        require_once APPPATH.'/libraries/barcode/class/BCGFontFile.php';
        require_once APPPATH.'/libraries/barcode/class/BCGDrawing.php';
        require_once APPPATH.'/libraries/barcode/class/BCGcode39.barcode.php';
    }

    function buat($kode=null)
    {
    	$kode==''?$kode='000000':$kode=$kode;
    	$font = new BCGFontFile(APPPATH.'/libraries/barcode/font/Arial.ttf', 18);
		$colorFront = new BCGColor(0, 0, 0);
		$colorBack = new BCGColor(255, 255, 255);

		// Barcode Part
		$code = new BCGcode39();
		$code->setScale(1);
		$code->setThickness(30);
		$code->setForegroundColor($colorFront);
		$code->setBackgroundColor($colorBack);
		$code->setFont($font);
		$code->setChecksum(false);
		$code->parse($kode);
		$code->clearLabels();

		// Drawing Part
		$drawing = new BCGDrawing('', $colorBack);
		$drawing->setFilename('template/assets/barcode/'.$kode.'.png');
		$drawing->setBarcode($code);
		$drawing->draw();

		// // Barcode Part
		// $code = new BCGcode128();
		// $code->setScale(2); // Resolution
		// $code->setThickness(30); // Thickness
		// $code->setForegroundColor($colorFront); // Color of bars
		// $code->setBackgroundColor($colorBack); // Color of spaces
		// $code->setFont($font); // Font (or 0)
		// $code->parse($kode); // Text
		// $code->clearLabels();

		// // Drawing Part
		// $drawing = new BCGDrawing('', $colorBack);
		// $drawing->setFilename('template/assets/barcode/'.$kode.'.png');
		// $drawing->setBarcode($code);
		// $drawing->draw();
		$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
    }
    
   	
}