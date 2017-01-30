<?php include('inc_ses.php');
if ($_SESSION['pedidos'] <> 1) {
	echo "<noscript>Para continuar con el proceso de Identificación pinche en el siguiente enlace:  <a href='../index.php' class='aRojo' target='_self'>CONTINUAR</a>.</noscript><SCRIPT LANGUAGE=\"JavaScript\">location.href='../index.php'</SCRIPT>";	 die(); //header("Location: index.php");
}

include('../c/c.php');
$error =""; $ok="";
$horainicio=""; 
$comentarios1="";
$idestado="";$idcliente="";$idvehiculo="";$idvehiculomodelo="";
$cv=""; $cc=""; $gasolina=""; $marchas=""; $cambio=""; $precio="";
$preciobase=""; $descuento=""; $total="";

if ($_POST) { $mostrarForm = false;	 }

$fecha = strftime( "%d/%m/%Y", time() );
if(isset($_POST['butlimpiar'])) { 
		echo "<script language='JavaScript'>";
		echo "location = 'NuevoParte.php'";
		echo "</script>";
		$_SESSION["idcli"]=0;
		$_SESSION["idcom"]=0;}

if(isset($_POST['registrar'])) { 

	$fecha1=utf8_decode ($_POST['txtfecha']); 
	$fecha1 = explode('/', $fecha1);
	$fechahor=$fecha1[2].'-'.$fecha1[1].'-'.$fecha1[0];
	
	$idestado=$_POST['cboestado'];
	$idcliente=$_POST['cbocliente'];
	$idvehiculo=$_POST['cbovehiculo'];
	$idvehiculomodelo=$_POST['cbovehiculomodelo'];

	$cv=$_POST['txtcv']; 
	$cc=$_POST['txtcc']; 
	$gasolina=$_POST['txtgasolina']; 
	$marchas=$_POST['txtmarchas']; 
	$cambio=$_POST['txtcambio']; 
	$precio=$_POST['txtpreciotable']; 

	$descuento=$_POST['txtdescuento']; 
	$total=$_POST['txttotalhidden']; 
	
	$comentarios=utf8_decode ($_POST['txtcomentarios']);
	$comentarios1=addslashes($comentarios);
	
	if($_POST['cbocliente']==0 || $_POST['cboestado']==0 || $_POST['cbovehiculomodelo']==0){
		if($_POST['cboestado']==0){$error = "<p>Debes seleccionar un estado.<br /><br /></p>";}
		else if($_POST['cbocliente']==0){$error = "<p>Debes seleccionar un cliente.<br /><br /></p>";}
		else if($_POST['cbovehiculomodelo']==0){$error = "<p>Debes seleccionar un vehículo.<br /><br /></p>";}
		
	
	}else{
		
			$sql = "INSERT INTO ventas VALUES(0,'".$fechahor."','".$_SESSION['idusu']."','".$idcliente."','".$idvehiculomodelo."','".$precio."','".$descuento."','".$total."','".$idestado."','".$comentarios1."');";

			 $db = new MySQL();
			 $consulta = $db->consulta($sql);
			 if ($consulta>0){ $ok = "<p>Venta registrada con &eacute;xito.<br /><br /></p>";}
			  $db1 = new MySQL();
								  $consulta1 = $db->consulta("SELECT * from usuarios where id='".$_SESSION['idusu']."'");
								 $resultados1 = $db->fetch_array($consulta1);
								 $sql1="INSERT INTO log (`idusuario`,`usuario`, `alias`, `descripcion`, `fecha`) VALUES('".$_SESSION['idusu']."','".$resultados1[7]." " .$resultados1[8]."','".$resultados1[1]."','Vendio el vehiculo: $idvehiculomodelo','".$fechareg."')";
								 $consulta2 = $db->consulta($sql1);
								 $db1->closeMySQL();		
			 $db->closeMySQL();	
					 
			 
}
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
<script>
function calcularDescuento() {
	
	
	 var precio = document.getElementById('txtpreciohidden').value;
	 var descuento = document.getElementById('txtdescuento').value;

	 
        if (+descuento > 0) {
            var total = Number(precio) * Number(descuento) / 100;
			var preciototal = Number(precio) - Number(total);
			document.getElementById("txttotal").innerHTML = preciototal;
			document.getElementById("txttotalhidden").value = preciototal;
        }else {
            document.getElementById("txttotal").innerHTML = precio;
			document.getElementById("txttotalhidden").value = precio;
        }
    
}
</script>

</head>
 <body>
    
<div id='webContainer'>
<?php include('inc_head.php'); ?>

<div id='webBody'>
	<h1>Nuevo Parte</h1> 
     <?php if ($error <> "") { 
			echo '<div id="fLogError">'.$error.'</div>';
	}?>
    <?php if ($ok <> "") { 
			echo '<div id="fLogOk">'.$ok.'</div>';
			$ok='';
$comentarios1="";
$idestado="";$idcliente="";$idvehiculo="";$idvehiculomodelo="";
$cv=""; $cc=""; $gasolina=""; $marchas=""; $cambio=""; $precio="";
$preciobase=""; $descuento=""; $total="";

	}?>
    <?php if ($ok == "") { ?>
   	<div id="fNuevoParte">

		
			<form name='solicitud' action=" " method='POST'>
				<div id='dFecha'>
					  <p><label>Fecha:</label><input readonly name='txtfecha' id='txtfecha' type='text'  class='tcal tipo01' value='<?php echo utf8_encode ($fecha); ?>' />
                          <div id="gesCli2">
<p><label>Estado:</label> 
<?php
echo"<select style='width: 400px' name=cboestado id=cboestado ><br><br>"; 
                $db = new MySQL();
				 $consulta = $db->consulta("SELECT * FROM estado");
				 if($db->num_rows($consulta)>0)
				 {
						 while($resultados = $db->fetch_array($consulta)){
							 if($idestado!=''){
										if ($resultados[0]==$idestado) echo "<option selected='selected' value=".$resultados[0].">".htmlentities($resultados[1])."</option>\n";		
										if ($resultados[0]!=$idestado) echo "<option value=".$resultados[0].">".htmlentities($resultados[1])."</option>\n"; 
							 }else{
							 echo utf8_decode("<option value=".$resultados[0].">".htmlentities($resultados[1])."</option>\n"); 
							 }
						 }
				  }
				  $db->closeMySQL();	
echo "</select>"; 
?>   
</div>
                     </p>
				</div>
                
                
   
                <h2>Información Cliente</h2>
                
                <div id="gesCli">
                		 <p><label>Cliente</label> <select name="cbocliente" id="cbocliente" onChange="cargarCliente('cbocliente'); ">   
             			 <?php
		                // creamos las opciones del select
						 $db = new MySQL();
						 $consulta = $db->consulta("SELECT id,nombre,apellido FROM clientes order by nombre");
						 if($db->num_rows($consulta)>0) {
									echo "<option value='0' selected='selected'>Seleccione un Cliente...</option>"; 
						 			while($resultados = $db->fetch_array($consulta)){
												if($idcliente!=''){
													if ($resultados[0]==$idcliente) echo "<option selected='selected' value=".$resultados[0].">".$resultados[2]. " " .$resultados[1]."</option>\n";		
													if ($resultados[0]!=$idcliente) echo "<option value=".$resultados[0].">".$resultados[1]. " " .$resultados[2]."</option>\n"; 
												}else{echo "<option value=".$resultados[0].">".htmlentities($resultados[1]). " " .$resultados[2]."</option>\n"; 
																   }
									}	
				  		}
				  		$db->closeMySQL(); ?></select></p>
                        <p><label>Dirección:</label><input readonly="readonly" type='text' name='txtDir' class="tipo03" value='' id='txtDir'> 
						<label>Provincia:</label><input readonly="readonly" name='provincia' id='provincia' type='text'  class="tipo03" value=''>
						<label class="t03">C.P.:</label> <input readonly="readonly" name='cp' id='cp' type='text' class="tipo01" value=''></p> 	
                        <p><label>Teléfono:</label> <input readonly="readonly" name='telefono' id='telefono' type='text' class="tipo03"  value=''>
						<label>Email:</label><input name='email' id='email' readonly="readonly" type='text'  class="tipo03" value=''></p>
                </div>
                
                
                
<h2>Vehículo </h2>

 <div id="gesCli3">

	<select style='width: 400px' name=cbovehiculo id=cbovehiculo onChange="cargarVehiculo('cbovehiculo'); ">
	<?php		 $db = new MySQL();
			 $consulta = $db->consulta("SELECT DISTINCT marca FROM vehiculos");
			 if($db->num_rows($consulta)>0)
			 {
				  echo "<option value='0'>Seleccione Vehículo</option>"; 
					 while($resultados = $db->fetch_array($consulta)){
						 if($idvehiculo!=''){
							if ($resultados[0]==$idvehiculo){	echo "<option selected value=".$resultados[0].">".$resultados[0]."</option>\n";	}				
							if ($resultados[0]!=$idvehiculo){	echo "<option value=".$resultados[0].">".$resultados[0]."</option>\n"; 	}
						}else{
							echo "<option value=".$resultados[0].">".$resultados[0]."</option>\n";
						}							
					 }	 
			  }
			  $db->closeMySQL();
		echo "</select>"; 
?>

	<select style='width: 400px' name=cbovehiculomodelo id=cbovehiculomodelo onChange="cargarModeloVehiculo('cbovehiculomodelo'); "><br><br>"; 

				 <?php		 $db = new MySQL();
			 $consulta = $db->consulta("SELECT id, modelo FROM vehiculos");
			 if($db->num_rows($consulta)>0)
			 {
				  echo "<option value='0'>Seleccione Modelo</option>"; 
					 while($resultados = $db->fetch_array($consulta)){
						 if($idvehiculomodelo!=''){
							if ($resultados[0]==$idvehiculomodelo){	echo "<option selected value=".$resultados[0].">".$resultados[1]."</option>\n";	}				
							if ($resultados[0]!=$idvehiculomodelo){	echo "<option value=".$resultados[0].">".$resultados[1]."</option>\n"; }
						}else{
							echo "<option value=".$resultados[0].">".$resultados[1]."</option>\n"; 
						}							
					 }	 
			  }
			  $db->closeMySQL();
		echo "</select></p>"; 
?>
   

<p><table align="center"><tr><td></td><th>C.V.</th><th>C.C.</th><th>Gasolina</th><th>Cambio</th><th>Marchas</th><th>Precio</th></tr>

<tr><td></td><td><input readonly="readonly" type='text' class="tipo04" name='txtcv' id='txtcv' value='<?php echo utf8_encode ($cv); ?>' ></td><td><input readonly="readonly" type='text' class="tipo04"  name='txtcc' id='txtcc' value='<?php echo utf8_encode ($cc); ?>' ></td><td><input readonly="readonly" type='text' class="tipo04" name='txtgasolina' id='txtgasolina' value='<?php echo utf8_encode ($gasolina); ?>' ></td><td><input readonly="readonly" class="tipo04" name='txtcambio' id='txtcambio' type='text' value='<?php echo utf8_encode ($cambio); ?>' ></td><td><input readonly="readonly" class="tipo04" type='text' name='txtmarchas' id='txtmarchas' value='<?php echo utf8_encode ($marchas); ?>'></td><td><input readonly="readonly" class="tipo04" type='text' name='txtpreciotable' id='txtpreciotable' value='<?php echo utf8_encode ($precio); ?>' ></td></tr></table></p>

	<h2>Precio</h2>
				<table align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<th>Base</th>
						<th>Descuento %</th>
						<th>Total</th>

				   </tr>
				   <tr>
						<td><label name="txtprecio" id="txtprecio"><?php echo utf8_encode ($preciobase); ?></label><input type="hidden" id="txtpreciohidden" name="txtpreciohidden" value="<?php echo utf8_encode ($preciobase); ?>"/></td>
									<td><input STYLE='text-align: center;' name="txtdescuento" class="tipo001" id="txtdescuento" oninput="calcularDescuento()" type="text" value="<?php echo utf8_encode ($descuento);?>"> </td>
									<td><label for="button" name="txttotal" id="txttotal"><?php echo utf8_encode ($total); ?></label></td>
									<input type="hidden" id="txttotalhidden" name="txttotalhidden" value="<?php echo utf8_encode ($total); ?>"/>
				   </tr>
			   </table>
</div>

<br>
<p><h2>Comentarios </h2><textarea type='textarea' class="tipo05" name='txtcomentarios' cols='94' rows='4' value=""><?php echo utf8_encode ($comentarios1); ?></textarea></p>
<p>
<input type='submit' class='but' name="registrar" title="Guardar Proyecto" alt="Guardar Proyecto" value='Guardar Parte'>
<input type='submit' class='but' name="butlimpiar" title="limpiar" alt="Limpiar Formulario" value='Limpiar Formulario' >
</p>
</form>


<?php } //CIERRO $OK ?>



</div>

</div>

<?php include('inc_foot.php'); ?>
</div> <!---------------CIERRA DIV WEBBODY----------------------->







</div> <!---------------CIERRA DIV POSICION GENERAL----------------------->

<script type="text/javascript" language="javascript1.5">cargarCliente('cbocliente');</script>
<script type="text/javascript" language="javascript1.5">cargarVehiculo('cbovehiculo');</script>
<script type="text/javascript" language="javascript1.5">cargarModeloVehiculo('cbovehiculomodelo');</script>
    </body>
    </html>
