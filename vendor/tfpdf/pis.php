<?php
//text musi byt kodovan v UTF -8, napriklad pomocí Notepad++ nebo pspad.


	require("../tfpdf/tfpdf.php");
	
	
		
	$pdf = new tFPDF();
	$pdf->AddFont('Calibri','','calibri.ttf',true);
	$pdf->SetFont('Calibri','',10);
	$pdf->AddPage();
	
			$pdf->Cell(20,10,"asdfasdfčšěřžščřžý",1);
	
	$pdf->Output();
	
	
	
?>