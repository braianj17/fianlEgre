<?php
require('fpdf/fpdf.php');
ob_clean();
	$nombre=$_GET['a1'];
	$instituto=$_GET['a2'];
	$id= $_GET['a3'];
			$pdf = new FPDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$y=$pdf->GetY();
			$x=$pdf->GetX();
			$pdf->Image('img/gafete.jpg',10,10,90,120,'jpg');
			$pdf->Image('http://chart.googleapis.com/chart?chs=100x100&cht=qr&chl='.$id.'&.png',77,81,15,15);
			$pdf->Cell(90,120,'',1,1,'C');//PRINCIPAL
			$pdf->SetXY($x+90,$y);
			$pdf->Ln();
			$pdf->SetXY($x,$y+28);
			$pdf->Ln(63);
				if (strlen ($instituto) > 28)
					{
						$tama = 10;
					}
						else
							{
								$tama=12;
							}
						$pdf->SetTextColor(0,0,0);
						$pdf->SetFont('ARIAL','B',$tama);
						$pdf->Cell(90,6,utf8_decode($nombre),0,0,'C');
						$pdf->Ln(7);//si lo pones vacio, jala el ancho de l�a ultima elda impresa
						$pdf->SetFont('Arial','','8');
						$pdf->SetXY($x,$y+50);
						$pdf->Ln(45);
						$pdf->SetFont('ARIAL','B',$tama);
						$pdf->Cell(90,6,utf8_decode($instituto),0,0,'C');
			  			$pdf->Ln(6);//si lo pones vacio, jala el ancho de la ultima celda impresa
			  			$pdf->SetFont('Arial','','8');
			  			$pdf->Ln(40);
			  			$pdf->Ln(1);
			  			$pdf->Output();
?>
