<?php
include_once('pdf/fpdf.php');


$pdf = new FPDF('p','mm','a4');

$pdf->AddPage();


//Sent font arial bold
$pdf->SetFont('Arial','B',14);

//Cell width, height, text, border, end line, [align]
$pdf->Cell(130 ,5,'Karin Continital ',1,0);
$pdf->Cell(59 ,5,'Invoice',1,1);

//Set font to arail
$pdf->SetFont('Arial','','12');

$pdf->Cell(130 ,5,'[Street Address] ',1,0);
$pdf->Cell(59 ,5,'',1,1);



$pdf->Cell(130 ,5,'[Street Address] ',1,0);
$pdf->Cell(59 ,5,'',1,1);// end line


$pdf->Cell(130 ,5,'[City, Country] ',1,0);
$pdf->Cell(25 ,5,'Date',1,0);
$pdf->Cell(34 ,5,'dd/mm/yyyy',1,1);//endline


$pdf->Cell(130 ,5,'Phone: ,[+93(0)729818588] ',1,0);
$pdf->Cell(25 ,5,'Invoice #',1,0);
$pdf->Cell(34 ,5,'1232434',1,1);//endline

$pdf->Cell(130 ,5,'Fax[+93(0)729818588] ',1,0);
$pdf->Cell(25 ,5,'Table No',1,0);
$pdf->Cell(34 ,5,'10',1,1);//endline


$pdf->SetFont('Arial','B',14);

$pdf->cell(89,10,'Order Name ',1,0);
$pdf->cell(40,10,'Quantity',1,0);
$pdf->cell(60,10,'Price',1,1);
$pdf->SetFont('Arial','','12');
// Emlty Celles
$pdf->cell(89,10,'Spagiti ',1,0,'center');
$pdf->cell(40,10,'5',1,0);
$pdf->cell(60,10,'120',1,1);

$pdf->cell(89,10,' ',1,0);
$pdf->cell(40,10,'',1,0);
$pdf->cell(60,10,'',1,1);



$pdf->cell(89,10,' ',1,0);
$pdf->cell(40,10,'',1,0);
$pdf->cell(60,10,'',1,1);


$pdf->cell(89,10,'',1,0);
$pdf->cell(40,10,'',1,0);
$pdf->cell(60,10,'	',1,1);

$pdf->SetFont('Arial','B','12');
$pdf->cell(189,10,'Thanks For Your Choise. Hope you be healthy every time.',1,0);



$pdf->Output();
?>






















