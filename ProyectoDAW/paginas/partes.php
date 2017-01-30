<?php include('inc_ses.php'); 
if ($_SESSION['pedidos'] <> 1) {
	echo "<noscript>Para continuar con el proceso de Identificación pinche en el siguiente enlace:  <a href='../index.php' class='aRojo' target='_self'>CONTINUAR</a>.</noscript><SCRIPT LANGUAGE=\"JavaScript\">location.href='../index.php'</SCRIPT>";	die();//header("Location: index.php"); 
}
include('../c/c.php'); 

$sql='SELECT * FROM ventas ORDER BY `fecha` desc';
		 
$fechainicio='';
$fechafin='';
$idgestor='';
$idcli='';
$id=1;
$sinresultado=0;

if(isset($_POST['contestacion_x'])) { 
$fechainicio=$_POST['txtfechainicio'];
$fechafin=$_POST['txtfechafin'];
$idgestor=$_POST['cbogestor'];
$idcli=$_POST['cbocliente'];
if(strlen($fechainicio)>6){
$fecha1=utf8_decode ($_POST['txtfechainicio']); 
$fecha1 = explode('/', $fecha1);
$fechahorinicio=$fecha1[2].'-'.$fecha1[1].'-'.$fecha1[0];}
if($fechafin!=''){
$fecha1=utf8_decode ($_POST['txtfechafin']); 
$fecha1 = explode('/', $fecha1);
$fechahorfin=$fecha1[2].'-'.$fecha1[1].'-'.$fecha1[0];}
if($fechainicio!='' && $fechafin!='' && $idgestor!=0 && $idcli!=0){$sql="SELECT * FROM ventas WHERE `fecha` BETWEEN '$fechahorinicio' and '$fechahorfin' and idusuario='$idgestor' and idcliente='$idcli' ORDER BY `fecha` desc";}
elseif($fechainicio!='' && $fechafin!='' && $idgestor!=0){$sql="SELECT * FROM ventas WHERE `fecha` BETWEEN '$fechahorinicio' and '$fechahorfin' and idusuario='$idgestor' ORDER BY `fecha` desc";}
elseif($fechainicio!='' && $fechafin!='' && $idcli!=0){$sql="SELECT * FROM ventas WHERE `fecha` BETWEEN '$fechahorinicio' and '$fechahorfin' and idcliente='$idcli' ORDER BY `fecha` desc";}
elseif($idgestor!=0 && $idcli!=0){$sql="SELECT * FROM ventas WHERE idusuario='$idgestor' and idcliente='$idcli' ORDER BY `fecha` desc ";}
elseif($fechainicio!='' && $fechafin!=''){$sql="SELECT * FROM ventas WHERE `fecha` BETWEEN '$fechahorinicio' and '$fechahorfin' ORDER BY `fecha` desc";	}
elseif($idgestor!=0){$sql="SELECT * FROM ventas WHERE idusuario='$idgestor' ORDER BY `fecha` desc";	}
elseif($idcli!=0){$sql="SELECT * FROM ventas WHERE idcliente='$idcli' ORDER BY `fecha` desc";	}
else{$sql="SELECT * FROM ventas  ORDER BY `fecha` desc";	}
} 

if(isset($_POST['butprimero_x']) || isset($_POST['butultimo_x']) || isset($_POST['butsiguiente_x']) || isset($_POST['butatras_x'])){
$fechainicio=$_POST['txtfechainicio'];
$fechafin=$_POST['txtfechafin'];
$idgestor=$_POST['cbogestor'];
$idcli=$_POST['cbocliente'];
if(strlen($fechainicio)>6){
$fecha1=utf8_decode ($_POST['txtfechainicio']); 
$fecha1 = explode('/', $fecha1);
$fechahorinicio=$fecha1[2].'-'.$fecha1[1].'-'.$fecha1[0];}
if($fechafin!=''){
$fecha1=utf8_decode ($_POST['txtfechafin']); 
$fecha1 = explode('/', $fecha1);
$fechahorfin=$fecha1[2].'-'.$fecha1[1].'-'.$fecha1[0];}
$sql=$_POST['sql'];


}

$db = new MySQL();
	 $consulta = $db->consulta($sql);

if (isset($_POST['butprimero_x'])) { 
	$id=1;
	}		

if (isset($_POST['butultimo_x'])) { 
	$id=$db->num_rows($consulta);}	

if (isset($_POST['butsiguiente_x'])) { 
	$id=utf8_decode ($_POST['id']);
	if($id==$db->num_rows($consulta)){}else{$id++;}		
}

elseif (isset($_POST['butatras_x'])) { 
	$id=utf8_decode ($_POST['id']);	
	if($id==1){}else{$id--;}		
}
	
	 if($db->num_rows($consulta)>0)
	 {
			 
			  	   for ($i = 1; $i <= $id; $i++) {
			$resultabla = $db->fetch_row($consulta);
				}

	  }else{
		  $sinresultado=1;
		  $id=0;

		  }
	  $db->closeMySQL();

//echo $sql;
$total= $db->num_rows($consulta);
if($sinresultado==0){
$fecha1 = explode('-', $resultabla[1]);
$fechahor=$fecha1[2].'/'.$fecha1[1].'/'.$fecha1[0];

}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EuskoTruck | Gestión Comercial</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../js/nord.js"></script>   
	<script type="text/javascript" src="../js/tcal.js"></script> 
	<link rel="stylesheet" type="text/css" href="../css/tcal.css" />
<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
</head>


<body>

<div id="webContainer">
<?php include('inc_head.php'); ?>
<div id="webBody">


	<div id="partesH">
		<h1>Gestión Ventas</h1>
		<p>Si desea crear un nuevo parte pinche el siguiente enlace: <a href="nuevoParte.php">NUEVO PARTE</a></p>
	</div>
    
	  <div class="partesN">
	<form name='solicitud' action='' enctype='multipart/form-data' method='POST'>    
    <p><label>Fecha Inicio:</label><input readonly name='txtfechainicio' id='txtfechainicio' STYLE='text-align: center;' type='text' size='10' class='tcal tipo01' value='<?php echo utf8_encode ($fechainicio); ?>' >
    <label>Fecha Fin:</label><input readonly name='txtfechafin' id='txtfechafin' STYLE='text-align: center;' type='text' size='10' class='tcal tipo01' value='<?php echo utf8_encode ($fechafin); ?>' >
    
    <?php  
				 $resultados = $db->fetch_array($consulta);
				 
                 $db1 = new MySQL();
				 $consulta1 = $db1->consulta("SELECT * FROM usuarios");
				 echo"<select style='width: 200px' name=cbogestor id=cbogestor >"; 
				 echo "<option value='0'>Todos los Comerciales</option>"; 
				 if($db1->num_rows($consulta1)>0)
				 {
						 while($resultados1 = $db1->fetch_array($consulta1)){
							 if($resultados1[0]==$idgestor){echo utf8_decode("<option selected value=".$resultados1[0].">".htmlentities($resultados1[7])." ".htmlentities($resultados1[8])."</option>"); }
							 if($resultados1[0]!=$idgestor){echo utf8_decode("<option value=".$resultados1[0].">".htmlentities($resultados1[7])." ".htmlentities($resultados1[8])."</option>"); }
							 }
				  }
				  echo "</select>";
				  $db1->closeMySQL();	
 
		 
		?>	 
        <select style='width: 200px' name=cbocliente id=cbocliente>
        <option value='0'>Todos los Clientes</option><?php
        $db = new MySQL();
		 $consulta = $db->consulta("SELECT * FROM clientes");
		 if($db->num_rows($consulta)>0)
		 {
				 while($resultados = $db->fetch_array($consulta)){
					 if($resultados[0]==$idcli){echo utf8_decode("<option selected value=".$resultados[0].">".htmlentities($resultados[1])."</option>\n"); }
					 if($resultados[0]!=$idcli){echo utf8_decode("<option value=".$resultados[0].">".htmlentities($resultados[1])."</option>\n"); } }
		  }
		  $db->closeMySQL();     
  ?>      
      </select>     
	<input src="../img/buscar.png" class='butbuscar' name='contestacion' type="image" onclick="form.solicitud.submit();" width='40'></p>	
	
	</div>

	<input readonly type='hidden' hidden name='id' value="<?php echo utf8_encode ($id);?>" size='25'>
    <input readonly type='hidden' hidden name='sql' value="<?php echo utf8_encode ($sql);?>" size='25'>
	
	
	
    <div class="partesN1">
	  <p><input name="butprimero" Value='Primero' img src="../img/mov01.png" width="49" height="30" type="image"/>	
      <input name="butatras" Value='Atras'  img src="../img/mov02.png" width="49" height="30" type="image"/>	
		<span><?php echo $id." / ".$total; ?></span>
       <input name="butsiguiente" id="butsiguiente" Value='Siguiente' img src="../img/mov03.png" width="49" height="30" type="image"/>	
       <input name="butultimo" Value='Ultimo' img src="../img/mov04.png" width="49" height="30" type="image"/></p>
    </div>
   <?php if($sinresultado==0){ ?>
    <div id="partesB">
    		<div id="dFecha">
            	<p><label>Fecha:</label><?php echo $fechahor; ?> <div id="modificarVenta" align="right"><a class="modCli"  href="editarParte.php?p=<?php echo $resultabla[0];?>">Modificar Datos</a> </div></p>
            </div>
            
			<div id="dVisita">
            	<h3>Estado del pedido:</h3><label> <?php 
			 	$db = new MySQL();
			 	$consulta = $db->consulta("SELECT * FROM `estado` where id='".$resultabla[8]."'");	
			 	$resultados = $db->fetch_array($consulta);
			 	echo htmlentities($resultados[1]); 
				?>
			</div>
			
            <div id="gesCli">
            	<h3>Información Cliente</h3> 
      			<p><label>Cliente:</label><?php 
			 	$db = new MySQL();
				$consulta = $db->consulta("SELECT * FROM clientes where id='".$resultabla[3]."'");	
			 	$resultados = $db->fetch_array($consulta);
			 	echo utf8_decode(htmlentities($resultados[1]));?>
				<label>DNI:</label><?php echo utf8_encode ($resultados[3]);?></p>
                <p><label>Dirección:</label><?php echo utf8_encode ($resultados[4]); ?> 
                	<label>Provincia:</label><?php echo utf8_encode ($resultados[6]); ?> </p>
                <p> <label>Teléfono:</label><?php echo utf8_encode ($resultados[7]); ?>
                    <label>Email:</label><?php echo utf8_encode ($resultados[8]); ?></p>
				<?php //$db->closeMySQL(); ?>
            </div>	
            
            
			
			<div id="dEqui">
				  <h3>Vehículo</h3>
				  <?php 
			 	$db = new MySQL();
			 	$consulta = $db->consulta("SELECT * FROM `vehiculos` where id='".$resultabla[4]."'");	
			 	$resultados = $db->fetch_array($consulta);?>
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<th></th>
							<th>Modelo</th>
							<th>CV</th>
							<th>CC</th>
							<th>Gasolina</th>
							<th>Cambio</th>
							<th>Nº Marchas</th>
						</tr>
						<tr>
							<td class="lit"><?php echo utf8_encode ($resultados[1]); ?></td>
							<td><?php echo utf8_encode ($resultados[2]); ?></td>
							<td><?php echo utf8_encode ($resultados[3]); ?></td>
							<td><?php echo utf8_encode ($resultados[4]); ?></td>
							<td><?php echo utf8_encode ($resultados[5]); ?></td>
							<td><?php echo utf8_encode ($resultados[6]); ?></td>
							<td><?php echo utf8_encode ($resultados[7]); ?></td>
					   </tr>
					</table>
			</div>
            
            
			<div id="dPrecio">
							<h3>Precio</h3>
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<th>Base</th>
									<th>Descuento</th>
									<th>Total</th>

							   </tr>
							   <tr>
									<td><?php echo utf8_encode ($resultabla[5] . " " . "&#8364"); ?></td>
									<td><?php echo utf8_encode ($resultabla[6] . " %"); ?></td>
									<td><?php echo utf8_encode ($resultabla[7] . " " . "&#8364"); ?></td>

							   </tr>
						   </table>
					   </div>
          
          <div id="dComent">
          		<p><label>Comentarios:</label></p>
				<p><?php echo utf8_encode ($resultabla[9]); ?></p>
          </div>
          <div id="pdf" align="right">
		   <a href='pdfventa.php?v=<?php echo $resultabla[0];?>&u=<?php echo $_SESSION['idusu'];?>' target='_blank'><img src="../img/pdf.png" width="50" height="50" alt="PDF" /></a><br><br>
		   </div>

    </div>

	<?php $db->closeMySQL(); ?>   
	<div class="partesN1">
  <p><input name="butprimero" Value='Primero' img src="../img/mov01.png" width="49" height="30" type="image"/>	
      <input name="butatras" Value='Atras'  img src="../img/mov02.png" width="49" height="30" type="image"/>	
<span><?php echo $id." / ".$total; ?></span>
       <input name="butsiguiente" id="butsiguiente" Value='Siguiente' img src="../img/mov03.png" width="49" height="30" type="image"/>	
       <input name="butultimo" Value='Ultimo' img src="../img/mov04.png" width="49" height="30" type="image"/></p>
    </div>
      <?php }else{ ?>
        <div class="partesN">
        <p><label>Sin Resultados...</label></p>
        </div>
        <?php } ?>
 </form>

</div> <!---------------CIERRA DIV WEBBODY----------------------->

<?php include('inc_foot.php'); ?>

</div> <!---------------CIERRA DIV POSICION GENERAL----------------------->


</body>
</html>