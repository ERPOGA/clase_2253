<h1>PDF</h1>

<?php
	/*
	require 'vendor/autoload.php';

	$phpWord = new \PhpOffice\PhpWord\PhpWord();

	$section = $phpWord->addSection();
	// Adding Text element to the Section having font styled by default...
	$section->addText(
		'"Learn from yesterday, live for today, hope for tomorrow. '
			. 'The important thing is not to stop questioning." '
			. '(Albert Einstein)'
	);

	$section->addText(
		'"Great achievement is usually born of great sacrifice, '
			. 'and is never the result of selfishness." '
			. '(Napoleon Hill)',
		array('name' => 'Tahoma', 'size' => 10)
	);

	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
	$objWriter->save('helloWorld.html');
	*/

	use Fpdf\Fpdf;
	require 'vendor/autoload.php';

	ob_start();
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Hello World!');
    $pdf->Output();
    ob_end_flush(); 


?>