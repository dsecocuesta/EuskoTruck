<?php include('inc_ses.php'); 
if ($_SESSION['clientes'] <> 1) {
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
<script type="text/javascript">
function nif(dni) {
  numero = dni.substr(0,dni.length-1);
  let = dni.substr(dni.length-1,1);
  numero = numero % 23;
  letra='TRWAGMYFPDXBNJZSQVHLCKET';
  letra=letra.substring(numero,numero+1);
  if (letra!=let) 
    alert('Dni incorrecto');
}
</script>

<body>
<div id='webContainer'>
<?php include('inc_head.php'); ?>

<div id='webBody'>


<div id='tablaUsuarios'>
<h1>Lista de Clientes</h1>
<p>Si desea crear un nuevo cliente pinche el siguiente enlace: <a href="clientes.php?a=n">NUEVO CLIENTE</a></p>


<?php

$a = ""; $i= ""; $tit ="";
if(isset($_GET['a'])) { 
	if ($_GET['a'] == "n") {
			$a = "n2";
			$i = "";
			$tit = "Nuevo Cliente";
			$btn = "Crear Cliente";
			$nombre="";
			$apellido="";
			$dni="";
			$direccion="";
			$provincia="";
			$cp="";
			$telefono="";
			$email="";

	} elseif ($_GET['a'] == "n2") {
			$a = "n2";
			$i = "";
			$tit = "Nuevo Cliente";
			$btn = "Crear Cliente";
			$nombre=$_GET["txtNombre"];
			$apellido=$_GET["txtApellido"];
			$dni=$_GET["txtDNI"];
			$direccion=$_GET["txtDireccion"];
			$provincia=$_GET["txtProvincia"];
			$cp=$_GET["txtCP"];
			$telefono=$_GET["txtTelefono"];
			$email=$_GET["txtEmail"];

			
			
			if ($dni =="" || $nombre =="") {
					$error = "<p>Introduzca el Nombre y el DNI del cliente.<br /><br /></p>";
			} else {
					$db = new MySQL();
					$consulta = $db->consulta("SELECT * FROM clientes WHERE dni='".$dni."'");
					if($db->num_rows($consulta)>0){
						$error = "<p>DNI ya existente en la base de datos.<br /><br /></p>";
					} else {
						$sql = "INSERT INTO clientes VALUES (0,'".$nombre."','".$apellido."','".$dni."','".$direccion."',".$cp.",'".$provincia."',".$telefono.",'".$email."');";
						$consulta = $db->consulta($sql);		
						$ok = "<p>Muy bien!. Cliente registrado con &eacute;xito.<br /><br /></p>";
						$db1 = new MySQL();
								 $consulta1 = $db->consulta("SELECT * from usuarios where id='".$_SESSION['idusu']."'");
								 $resultados1 = $db->fetch_array($consulta1);
								 $sql1="INSERT INTO log (`idusuario`,`usuario`, `alias`, `descripcion`, `fecha`) VALUES('".$_SESSION['idusu']."','".$resultados1[7]." " .$resultados1[8]."','".$resultados1[1]."','Registro al cliente: $nombre $apellido','".$fechareg."')";
								 $consulta2 = $db->consulta($sql1);
								 $db1->closeMySQL();	
					}
					$db->closeMySQL();	
			}
			
			
	
	} elseif ($_GET['a'] == "e" || $_GET['a'] == "b") {
			$i=$_GET["i"];
			$a = $_GET["a"];
			$db = new MySQL();
		 	$consulta = $db->consulta("SELECT * FROM clientes where id=".$i);
		 	if($db->num_rows($consulta)>0)
		 	{
				$resultados = $db->fetch_array($consulta);
				if ($_GET['a'] == "e") {
					$tit = "Editar Cliente";
					$btn = "Editar Cliente";
					$a = "e2";
				} 
				$nombre=$resultados[1];
				$apellido=$resultados[2];
				$dni=$resultados[3];
				$direccion=$resultados[4];
				$provincia=$resultados[6];
				$cp=$resultados[5];
				$telefono=$resultados[7];
				$email=$resultados[8];
				
			}
			$db->closeMySQL();

	} elseif ($_GET['a'] == "e2") {
			$a = "e2";
			$i = $_GET["i"];
			$tit = "Editar Usuario";
			$btn = "Editar Usuario";
			$nombre=$_GET["txtNombre"];
			$apellido=$_GET["txtApellido"];
			$dni=$_GET["txtDNI"];
			$direccion=$_GET["txtDireccion"];
			$provincia=$_GET["txtProvincia"];
			$cp=$_GET["txtCP"];
			$telefono=$_GET["txtTelefono"];
			$email=$_GET["txtEmail"];
			
			
			if ($dni =="" || $nombre =="") {
					$error = "<p>Introduzca el Nombre y el DNI del cliente.<br /><br /></p>";
			} else {
					$db = new MySQL();
					$consulta = $db->consulta("SELECT * FROM clientes WHERE dni='".$dni."' and id <> ".$i);
					if($db->num_rows($consulta)>0){
						$error = "<p>DNI ya existente en la base de datos.<br /><br /></p>";
					} else {

							$sql="UPDATE clientes SET nombre='".$nombre."',apellido='".$apellido."',dni='".$dni."', direccion='".$direccion."', cp='".$cp."', provincia='".$provincia."', telefono='".$telefono."', email='".$email."' WHERE id=".$i;
						
						$consulta = $db->consulta($sql);		
						$ok = "<p>Perfecto!. Cliente actualizado con &eacute;xito.<br /><br /></p>";
								 $db1 = new MySQL();
								 $consulta1 = $db->consulta("SELECT * from usuarios where id='".$_SESSION['idusu']."'");
								 $resultados1 = $db->fetch_array($consulta1);
								 $sql1="INSERT INTO log (`idusuario`,`usuario`, `alias`, `descripcion`, `fecha`) VALUES('".$_SESSION['idusu']."','".$resultados1[7]." " .$resultados1[8]."','".$resultados1[1]."','Modifico datos del cliente: $nombre $apellido','".$fechareg."')";
								 $consulta2 = $db->consulta($sql1);
								 $db1->closeMySQL();	
					}
					$db->closeMySQL();	
			}
			
			
	}
	
	
	
	?>
    
    <?php if ($error <> "") { 
			echo '<div id="fLogError">'.$error.'</div>';
	}?>
    <?php if ($ok <> "") { 
			echo '<div id="fLogOk">'.$ok.'</div>';
	}?>
    
    <?php if ($ok == "") { ?>
	
    <div id="gesUsu">
		<h2><?php echo $tit; ?></h2> 
		<form class="frmUsu" method='GET'><input name="a" type="hidden" value="<?php echo $a;?>" /><input name="i" type="hidden" value="<?php echo $i;?>" />
        <p  id="colum"><label for="txtNombre">Nombre: </label><input name="txtNombre" id="txtNombre" type="text" value="<?php echo utf8_encode ($nombre);?>">
        	<label for="txtApell">Apellidos: </label><input name="txtApellido" id="txtApellido" type="text" value="<?php echo utf8_encode ($apellido);?>">
			<label for="txtDNI">DNI: </label><input name="txtDNI" id="txtDNI" type="text" onblur="nif(this.value)" maxlength="9" value="<?php echo utf8_encode ($dni);?>"></p>
        <p  id="colum"><label for="txtDirec">Dirección: </label><input name="txtDireccion" id="txtAlias" type="text" value="<?php echo utf8_encode ($direccion);?>"> 
            <label for="txtCP">C.P.: </label><input name="txtCP" id="txtCP" type="text" maxlength="5" value="<?php echo utf8_encode ($cp);?>"> 
			<label for="txtProvin">Provincia: </label><input name="txtProvincia" id="txtProvincia" type="text" value="<?php echo utf8_encode ($provincia);?>"> </p>
        <p  id="colum">
			<label for="txtTel">Teléfono: </label><input name="txtTelefono" id="txtApellido" type="text" maxlength="9" value="<?php echo utf8_encode ($telefono);?>">
			<label for="txtEmail">Email: </label><input name="txtEmail" id="txtEmail" type="text" value="<?php echo utf8_encode ($email);?>"></p>
   
          
        <p><input type='submit' class="btn" value='<?php echo $btn;?>' name='registrar'><input type='reset' class="btn2" value='Restablecer' name='borrar'></p>                
        </form> 
        <p class="cerrar"><a href="clientes.php" target="_self"><br>X Cerrar Formulario</a></p>           
	  </div>
        
        <?php } 
		
			}
                     $db = new MySQL();
                     $consulta = $db->consulta("SELECT * FROM CLIENTES");
                     if($db->num_rows($consulta)>0)
                     {
                             while($resultados = $db->fetch_array($consulta)){ ?>
								 <div id="partesB">	
									<div id="gesCli">
										<p><label>Cliente:</label><?php 
										echo utf8_decode(htmlentities($resultados[1] . " " . $resultados[2]));?> <label>DNI:</label><?php echo utf8_encode ($resultados[3]); ?>  <a class="modCli" href="clientes.php?i=<?php echo $resultados[0];?>&a=e">Modificar Datos</a> </p>
										<p><label>Dirección:</label><?php echo utf8_encode ($resultados[4]); ?> 
											<label>C.P.:</label> <?php echo utf8_encode ($resultados[5]); ?></p>
										<p>	<label>Provincia:</label><?php echo utf8_encode ($resultados[6]); ?> 
											<label>Teléfono:</label><?php echo utf8_encode ($resultados[7]); ?>
											<label>Email:</label><?php echo utf8_encode ($resultados[8]); ?>
											<a href='email.php?c=<?php echo $resultados[0];?>'><img src="../img/email.png" width="20" height="20" alt="email" /></a></p>
											 
										
						
										<?php //$db->closeMySQL(); ?>
									</div>	
									<p class="table03"></p>	
									</div>
								
                                <?php 
								  }
                      }
                      $db->closeMySQL();?>






</div> <!---------------CIERRA DIV WEBBODY----------------------->

<?php include('inc_foot.php'); ?>

</div> <!---------------CIERRA DIV POSICION GENERAL----------------------->

</body>
</html>