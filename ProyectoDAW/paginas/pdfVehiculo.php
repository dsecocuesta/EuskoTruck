<?php

include('../c/c.php');
require('../pdf/fpdf.php');


if(isset($_GET['v'])) { 		
			$v=$_GET["v"];
			$db = new MySQL();
		 	$consulta = $db->consulta("SELECT * FROM vehiculos where id=".$v);
		 	if($db->num_rows($consulta)>0)
		 	{
				$resultados = $db->fetch_array($consulta);
			}
			$db->closeMySQL();
			
			if(strcmp ( $resultados[1], 'Man') == 0){
				$imagen='../img/1/1.jpg';
			}else if(strcmp ( $resultados[1], 'Scania') == 0){
				$imagen='../img/2/1.jpg';
			}else{
				$imagen='../img/3/1.jpg';
			}			
				
			 $db1 = new MySQL();
			 $consulta1 = $db1->consulta("SELECT * from usuarios where id='".$_GET["u"]."'");
			 $resultados1 = $db1->fetch_array($consulta1);
			 $sql1="INSERT INTO log (`idusuario`,`usuario`, `alias`, `descripcion`, `fecha`) VALUES('".$_GET["u"]."','".$resultados1[7]." " .$resultados1[8]."','".$resultados1[1]."','Creo el PDF del vehiculo $v','".$fechareg."')";
			 $consulta2 = $db1->consulta($sql1);
			 $db1->closeMySQL();	
			
}			

class PDF extends FPDF
{
function Footer()
{

    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'EuskoTruck S.L.',0,0,'C');
}
}

$pdf = new PDF();
$pdf->AddPage();


    $pdf->Image('../img/logopdf.jpg',10,8,43);
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(60);
    $pdf->Cell(70,10,'Ficha Técnica del vehículo',0,0,'C');
    $pdf->Ln(20);
	
	
$pdf->Ln(20);	
$pdf->Cell(45);
$pdf->Cell(100,10,$resultados[1]. ' ' .$resultados[2],1,0,'C');
$pdf->SetFont('Times','',16);
$pdf->Ln(15);
$pdf->Cell(45);
$pdf->Cell(49,10,'Potencia (CV)',1,0,'C');
$pdf->Cell(2);
$pdf->Cell(49,10,$resultados[3],1,0,'C');
$pdf->Ln(15);
$pdf->Cell(45);
$pdf->Cell(49,10,'Cilindrada (CC)',1,0,'C');
$pdf->Cell(2);
$pdf->Cell(49,10,$resultados[4],1,0,'C');
$pdf->Ln(15);
$pdf->Cell(45);
$pdf->Cell(49,10,'Gasolina',1,0,'C');
$pdf->Cell(2);
$pdf->Cell(49,10,$resultados[5],1,0,'C');
$pdf->Ln(15);
$pdf->Cell(45);
$pdf->Cell(49,10,'Cambio',1,0,'C');
$pdf->Cell(2);
$pdf->Cell(49,10,$resultados[6],1,0,'C');
$pdf->Ln(15);
$pdf->Cell(45);
$pdf->Cell(49,10,'Nº Marchas',1,0,'C');
$pdf->Cell(2);
$pdf->Cell(49,10,$resultados[7],1,0,'C');
$pdf->Ln(15);
$pdf->Cell(45);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(100,10,$resultados[8] .'€',1,0,'C');

$pdf->Ln(25);
$pdf->Image($imagen,55,160,100);	



	
$pdf->Output();
?>
