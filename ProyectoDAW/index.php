<?php  session_start();
include('c/c.php');

$error =""; $_SESSION['idusu']=''; $_SESSION['nombre'] = '';
    
if (isset($_POST["acceder"])){		
	$usuario = $_POST["usuario"];  $password = $_POST["password"];  
	$password1=crypt($password,$pkpalabra);
	$db = new MySQL();
 	$consulta = $db->consulta("SELECT * FROM usuarios where alias='".$usuario."' and pass='".$password1."' and borrado=0");
 	if($db->num_rows($consulta)>0) {
	    $resultados = $db->fetch_array($consulta);
		if($resultados[9]==0){
			 $error ="<p>Vaya.. Usuario sin acceso. Consulte con el Administrador!</p>";
			 $db1 = new MySQL();
				 $sql="INSERT INTO log (`idusuario`,`usuario`,`alias`, `descripcion`, `fecha`) VALUES('".$resultados[0]."','".$resultados[7]." " .$resultados[8]."','".$resultados[1]."','Identificado correctamente, acceso denegado','".$fechareg."')";
				 $consulta1 = $db->consulta($sql);
				 $db1->closeMySQL();
			 
		}else{
		 	$_SESSION['idusu']=$resultados[0];
			$_SESSION['nombre'] = $resultados[7]." ".$resultados[8];
		 	echo "<noscript>Para continuar con el proceso de Identificación pinche en el siguiente enlace:  <a href='paginas/menu.php' class='aRojo' target='_self'>CONTINUAR</a>.</noscript><SCRIPT LANGUAGE=\"JavaScript\">location.href='paginas/menu.php'</SCRIPT>";
			 $db1 = new MySQL();
				 $sql="INSERT INTO log (`idusuario`,`usuario`,`alias`, `descripcion`, `fecha`) VALUES('".$resultados[0]."','".$resultados[7]." " .$resultados[8]."','".$resultados[1]."','Identificado correctamente, acceso permitido','".$fechareg."')";
				 $consulta1 = $db->consulta($sql);
				 $db1->closeMySQL();
			 
		}
  } else {
	 $error ="<p>Upps!!.  Usuario o Contrase&ntilde;a Incorrectos<p>";
  }
  $db->closeMySQL();
}?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EuskoTruck | Gestión Comercial</title>

<link rel="stylesheet" href="css/estilo.css">

</head>
<body>
<div id='webContainer'>
  <div id="logo"><p><img src="img/logo.png" alt="EuskoTrunk" width="194" height="79" />
  <?php if ($_SESSION['nombre'] <> ""){ ?><?php echo "Hola ".$_SESSION['nombre']."!"; ?> | <a href="../index.php" target="_self">Cerrar Sesi&oacute;n</a><?php } ?></p></div>
  <div id='webBody'>
    <?php if ($error <> "") { 	echo '<div id="fLogError">'.$error.'</div>';}?>
    <div id="fLog">
<h1>Acceso Extranet</h1>
<form enctype="multipart/form-data" method="post" target="_self" action="index.php" class="frmLog"> 
    <p><label>Usuario: </label><br /><input name="usuario" type="text" title="Introduce el Usuario" alt="Introduce el Usuario"/></p>
    <p><label>Contrase&ntilde;a:</label><br /><input name="password" type="password" title="Introduce la Contrase&ntilde;a" alt="Introduce la Contrase&ntilde;a"/></p>
    <input name="id" type="hidden" />
    <p><input type="submit" value="Identificarse" name="acceder" class="btn" /></p>
</form> 
</div>

</div> <!---------------CIERRA DIV WEBBODY----------------------->
<?php include('paginas/inc_foot.php'); ?>
</div> <!---------------CIERRA DIV POSICION GENERAL----------------------->


</body>
</html>