<?php 
include('inc_ses.php');
include('../c/c.php');  
$_SESSION['usuarios']=''; $_SESSION['pedidos']=''; $_SESSION['vehiculos']=''; $_SESSION['clientes']='';
$usuarios = 0; $pedidos = 0; $vehiculos = 0; $clientes = 0;

$db = new MySQL();
$consulta = $db->consulta("SELECT pass, usuarios, clientes, pedidos, vehiculos FROM usuarios where activo = 1 and id='".$_SESSION['idusu']."'  and borrado=0");
if($db->num_rows($consulta)>0)
{
	 $resultados = $db->fetch_array($consulta);
		 if($resultados["usuarios"]==1){
			 $usuarios = 1; $_SESSION['usuarios'] = 1;
		 }
		 if($resultados["pedidos"]==1){
			 $pedidos = 1;  $_SESSION['pedidos'] = 1;
		 }
		 if($resultados["vehiculos"]==1){
			 $vehiculos = 1;  $_SESSION['vehiculos'] = 1;
		 }
		 if($resultados["clientes"]==1){
			 $clientes = 1;  $_SESSION['clientes'] = 1;
		 }
}
$db->closeMySQL(); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EuskoTruck | Gestión Comercial</title>
 	<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function(){
				$("body").animate({
					opacity: 1
				})
			},300)
		});
	</script>
	
</head>

<body style="opacity: 0;">
<div id='webContainer'>
<?php include('inc_head.php'); ?>


<div id='webBody'>
	<div id="fMen">
	<h1>Menu Principal</h1>
    <p>
	 <?php if ($clientes == 1) { ?>
      	<a href="clientes.php" target="_self"><img src="../img/opcCl0.png" width="217" height="277" alt="Gestión de clientes" /></a>
	<?php } else {  ?>
    	<img src="../img/opcCl1.png" width="217" height="277" alt="Gestión de clientes" />
    <?php } ?>
	<?php if ($pedidos == 1) { ?>
      	<a href="partes.php" target="_self"><img src="../img/opcVe0.png" width="217" height="277" alt="Gestión pedidos Visita" /></a>
<?php } else {  ?>
    	<img src="../img/opcVe1.png" width="217" height="277" alt="Gestión pedidos Visita" />
    <?php } ?>
	<?php if ($vehiculos == 1) { ?>
      	<a href="vehiculos.php" target="_self"><img src="../img/opcVeh0.png" width="217" height="277" alt="Gestión de Vehiculos" /></a>
<?php } else {  ?>
    	<img src="../img/opcVeh1.png" width="217" height="277" alt="vehiculos" />
    <?php } ?>
    
    </p>
    </div>

	<?php if ($usuarios == 1) { ?>
      	<div id="modificarVenta"><a href="usuarios.php" target="_self"><h1>USUARIOS</h1></a></div>
	<?php }?>


</div> <!---------------CIERRA DIV WEBBODY----------------------->

<?php include('inc_foot.php'); ?>

</div> <!---------------CIERRA DIV POSICION GENERAL----------------------->

</body>
</html>