<?php

include('../c/c.php');
require('../pdf/fpdf.php');

$date = date("Y-m-d H:i:s");
$header = array('País', 'Capital', 'Superficie (km2)', 'Pobl. (en miles)');
$data = array('País', 'Capital', 'Superficie (km2)', 'Pobl. (en miles)');

if(isset($_GET['v'])) { 		
			$v=$_GET["v"];
			$db = new MySQL();
		 	$consulta = $db->consulta("SELECT * FROM ventas where id=".$v);
		 	if($db->num_rows($consulta)>0)
		 	{
				$resultados = $db->fetch_array($consulta);
			}
			$db->closeMySQL();
			
			$db = new MySQL();
		 	$consulta = $db->consulta("SELECT * FROM estado where id=".$resultados[8]);
		 	if($db->num_rows($consulta)>0)
		 	{
				$resultadosEst = $db->fetch_array($consulta);
			}
			$db->closeMySQL();
			
			$db = new MySQL();
		 	$consulta = $db->consulta("SELECT * FROM clientes where id=".$resultados[3]);
		 	if($db->num_rows($consulta)>0)
		 	{
				$resultadosCli = $db->fetch_array($consulta);
			}
			$db->closeMySQL();
			
			$db = new MySQL();
		 	$consulta = $db->consulta("SELECT * FROM vehiculos where id=".$resultados[4]);
		 	if($db->num_rows($consulta)>0)
		 	{
				$resultadosVeh = $db->fetch_array($consulta);
			}
			$db->closeMySQL();
			
			
			
			 $db1 = new MySQL();
			 $consulta1 = $db1->consulta("SELECT * from usuarios where id='".$_GET["u"]."'");
			 $resultados1 = $db1->fetch_array($consulta1);
			 $sql1="INSERT INTO log (`idusuario`,`usuario`, `alias`, `descripcion`, `fecha`) VALUES('".$_GET["u"]."','".$resultados1[7]." " .$resultados1[8]."','".$resultados1[1]."','Creo el PDF de la venta $v','".$fechareg."')";
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

// Logo
    $pdf->Image('../img/logopdf.jpg',160,8,43);
	
	
    $pdf->SetFont('Times','',10);
    $pdf->Cell(40,10,$date,0,0,'C');
	$pdf->SetFont('Arial','B',15);
	$pdf->Ln(5);
	$pdf->Cell(70);
	$pdf->Cell(50,10,'Informe de venta',0,0,'C');
    // Salto de línea
    $pdf->Ln(20);
	


$pdf->Ln(20);	

$pdf->Cell(20,10,'Fecha:',0,0,'C');
$pdf->SetFont('Times','',16);
$pdf->Cell(30,10,$resultados[1],0,0,'C');
$pdf->Cell(45);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(70,10,$resultadosEst[1],1,0,'C');

$pdf->Ln(20);

$pdf->Cell(22,10,'Cliente:',0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Times','',16);
$pdf->Cell(30,10,'Nombre:',0,0,'C');
$pdf->Cell(50,10,$resultadosCli[1]. ' '. $resultadosCli[2],0,0,'C');
$pdf->Cell(25);
$pdf->Cell(30,10,'DNI:',0,0,'C');
$pdf->Cell(40,10,$resultadosCli[3],0,0,'C');
$pdf->Ln(10);
$pdf->Cell(32,10,'Dirección:',0,0,'C');
$pdf->Cell(40,10,$resultadosCli[4],0,0,'C');
$pdf->Cell(35);
$pdf->Cell(30,10,'C.P.:',0,0,'C');
$pdf->Cell(40,10,$resultadosCli[5],0,0,'C');
$pdf->Ln(10);
$pdf->Cell(30,10,'Teléfono:',0,0,'C');
$pdf->Cell(40,10,$resultadosCli[7],0,0,'C');
$pdf->Cell(35);
$pdf->Cell(30,10,'Email:',0,0,'C');
$pdf->Cell(40,10,$resultadosCli[8],0,0,'C');
$pdf->Ln(20);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(26,10,'Vehículo:',0,0,'C');	
$pdf->SetFont('Times','',16);
$pdf->Ln(12);
$pdf->Cell(27,10,'Marca',1,0,'C');
$pdf->Cell(27,10,'Modelo',1,0,'C');
$pdf->Cell(27,10,'C.V.',1,0,'C');
$pdf->Cell(27,10,'C.C.',1,0,'C');
$pdf->Cell(27,10,'Gasolina',1,0,'C');
$pdf->Cell(27,10,'Cambio',1,0,'C');
$pdf->Cell(27,10,'Marchas',1,0,'C');
$pdf->Ln();
$pdf->Cell(27,10,$resultadosVeh[1],1,0,'C');
$pdf->Cell(27,10,$resultadosVeh[2],1,0,'C');
$pdf->Cell(27,10,$resultadosVeh[3],1,0,'C');
$pdf->Cell(27,10,$resultadosVeh[4],1,0,'C');
$pdf->Cell(27,10,$resultadosVeh[5],1,0,'C');
$pdf->Cell(27,10,$resultadosVeh[6],1,0,'C');
$pdf->Cell(27,10,$resultadosVeh[7],1,0,'C');
$pdf->Ln(20);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(20,10,'Precio:',0,0,'C');
$pdf->SetFont('Times','',16);
$pdf->Ln(10);	
$pdf->Cell(35,10,'Precio Base:',0,0,'C');
$pdf->Cell(35,10,$resultados[5].'€',0,0,'C');
$pdf->Ln(10);
$pdf->Cell(32,10,'Descuento:',0,0,'C');
$pdf->Cell(40,10,$resultados[6] .'%',0,0,'C');

$pdf->Ln(10);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(21,10,'Total:',0,0,'C');
$pdf->Cell(65,10,$resultados[7].'€',0,0,'C');
$pdf->Ln(20);


$pdf->Cell(40,10,'Observaciones:',0,0,'C');
$pdf->Ln(10);
$pdf->Cell(180,10,$resultados[9],0,0,'C');

	
$pdf->Output();
?>
