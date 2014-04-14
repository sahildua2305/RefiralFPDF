<?php
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Hello World !', 1);
$pdf->Ln();
$pdf->Cell(100, 100, 'Powered by Refiral', 'T', 0, 'R', false);

$pdf->Output();
?>