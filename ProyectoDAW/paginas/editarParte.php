<?php include('inc_ses.php'); 
if ($_SESSION['pedidos'] <> 1) {
	echo "<noscript>Para continuar con el proceso de Identificación pinche en el siguiente enlace:  <a href='../index.php' class='aRojo' target='_self'>CONTINUAR</a>.</noscript><SCRIPT LANGUAGE=\"JavaScript\">location.href='index.php'</SCRIPT>";	die(); //header("Location: index.php");
}

include('../c/c.php');
$error =""; $ok ="";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EuskoTruck | Gestión Comercial</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
	<script type="text/javascript" src="../js/tcal.js"></script> 
	<link rel="stylesheet" type="text/css" href="../css/tcal.css" />

<script>
function calcularDescuento() {
	
	 var precio = document.getElementById('txtprecio').textContent;
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

<body>
<div id='webContainer'>
<?php include('inc_head.php'); ?>

<div id='webBody'>


<div id='tablaPartes'>
<h1>Modificar Pedido</h1>



<?php
$error =""; $ok ="";
if(isset($_GET['p'])) { 		
			$p=$_GET["p"];
			$db = new MySQL();
		 	$consulta = $db->consulta("SELECT * FROM ventas where id=".$p);
		 	if($db->num_rows($consulta)>0)
		 	{
				$resultados = $db->fetch_array($consulta);
			}
			$db->closeMySQL();
			
			$estado=$resultados[8];
			$preciobase=$resultados[5];
			$descuento=$resultados[6];
			$total=$resultados[7]; 
			$comentarios =$resultados[9]; 
				
			$fecha1=utf8_decode ($resultados[1]); 
			$fecha1 = explode('-', $fecha1);
			$fecha=$fecha1[2].'/'.$fecha1[1].'/'.$fecha1[0];

}else{
	
		$id=$_GET["id"];
		$fecha=utf8_decode ($_GET["txtfecha"]);
		$estado=$_GET["cboestado"];
		$preciobase=$_GET["txtpreciohidden"];
		$descuento=$_GET["txtdescuento"];
		$total=$_GET["txttotalhidden"];
		$comentarios=$_GET["txtobservaciones"];
		

			$fechaSubir = explode('/', $fecha);
			$fecha2=$fechaSubir[2].'-'.$fechaSubir[1].'-'.$fechaSubir[0];
			
		$db = new MySQL();
			$sql="UPDATE ventas SET fecha='".$fecha2."',descuento='".$descuento."',preciototal='".$total."', estado='".$estado."', comentarios='".$comentarios."'  WHERE id=".$id;
			
					$consulta = $db->consulta($sql);		
						$ok = "<p>Perfecto!. Venta actualizada con &eacute;xito.<br /><br /></p>";
								  $db1 = new MySQL();
									 $consulta1 = $db1->consulta("SELECT * from usuarios where id='".$_SESSION['idusu']."'");
									 $resultados1 = $db1->fetch_array($consulta1);
									 $sql1="INSERT INTO log (`idusuario`,`usuario`, `alias`, `descripcion`, `fecha`) VALUES('".$_SESSION['idusu']."','".$resultados1[7]." " .$resultados1[8]."','".$resultados1[1]."','Modifico el pedido numero $id','".$fechareg."')";
									 $consulta2 = $db1->consulta($sql1);
									 $db1->closeMySQL();
					
					$db->closeMySQL();	}	?>
    
    <?php if ($error <> "") { 	echo '<div id="fLogError">'.$error.'</div>';	}?>
    <?php if ($ok <> "") { 		echo '<div id="fLogOk">'.$ok.'</div>';	}?>
    
	
    <div id="gesParte">
		<form class="frmUsu" method='GET'><input name="id" id="id" type="hidden" value="<?php echo $p;?>" />
        <h2></h2> 
		<div id="fechaEditarParte"><p><h3>Fecha Inicio:</h3><input readonly name='txtfecha' id='txtfecha' STYLE='text-align: center;' type='text' size='10' class='tcal tipo01' value='<?php echo utf8_encode ($fecha); ?>' ></div>
        <div id="estadoEditarParte"><p><h3>Estado:</h3> <?php 	 $db1 = new MySQL();
				 $consulta1 = $db1->consulta("SELECT * FROM estado");
				 echo"<select style='width: 200px' name=cboestado id=cboestado >"; 
				 if($db1->num_rows($consulta1)>0)
				 {
						 while($resultados1 = $db1->fetch_array($consulta1)){
							 if($resultados1[0]==$estado){echo utf8_decode("<option selected value=".$resultados1[0].">".htmlentities($resultados1[1])."</option>"); }
							 if($resultados1[0]!=$estado){echo utf8_decode("<option value=".$resultados1[0].">".htmlentities($resultados1[1])."</option>"); }
							 }
				  }
				  echo "</select>";
				  $db1->closeMySQL();

				  ?>	</div></p>
				  
				  <div id="dPrecio">
							<h3>Precio</h3>
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<th>Base</th>
									<th>Descuento %</th>
									<th>Total</th>

							   </tr>
							   <tr>
									<td><label name="txtprecio" id="txtprecio"><?php echo utf8_encode ($preciobase); ?></label><input type="hidden" id="txtpreciohidden" name="txtpreciohidden" value="<?php echo utf8_encode ($preciobase); ?>"/></td>
									<td><input STYLE='text-align: center;' name="txtdescuento" id="txtdescuento" oninput="calcularDescuento()" type="text" value="<?php echo utf8_encode ($descuento);?>"> </td>
									<td><label for="button" name="txttotal" id="txttotal"><?php echo utf8_encode ($total); ?></label></td>
									<input type="hidden" id="txttotalhidden" name="txttotalhidden" value="<?php echo utf8_encode ($total); ?>"/>
							   </tr>
						   </table>
					   </div>
		
		 <div id="observacionesEditarParte"><p>	<h3>Observaciones: </h3><input name="txtobservaciones" id="txtobservaciones" type="text"  value="<?php echo utf8_encode ($comentarios);?>"> </div>
            <input name="button" id="button" type='submit' class="btn" value='Guardar' name='registrar'>
        </form> 
        <p class="cerrar"><a href="partes.php" target="_self"><br>X Cerrar Formulario</a></p>           
	  </div>
        
          
</div>


</div> <!---------------CIERRA DIV WEBBODY----------------------->

<?php include('inc_foot.php'); ?>

</div> <!---------------CIERRA DIV POSICION GENERAL----------------------->

</body>
</html>