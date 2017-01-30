<?php include('inc_ses.php'); 
if ($_SESSION['usuarios'] <> 1) {
	echo "<noscript>Para continuar con el proceso de Identificación pinche en el siguiente enlace:  <a href='../index.php' class='aRojo' target='_self'>CONTINUAR</a>.</noscript><SCRIPT LANGUAGE=\"JavaScript\">location.href='index.php'</SCRIPT>";	die(); //header("Location: index.php");
}

include('../c/c.php');


if(isset($_GET['exportData'])) { 
	if ($_GET['exportData'] == "u") {
		$fp = fopen('usuarios.csv', 'w');
		$results = array();
		$db = new MySQL();
			 $consulta = $db->consulta("SELECT * FROM USUARIOS");
			 while($row = mysql_fetch_assoc($consulta))
			{
				$results[] = $row;
			}

		foreach ($results as $fields) {
			fputcsv($fp, $fields);
		}

		fclose($fp);
		download_send_headers("usuarios.csv");
		echo array2csv($results);
		die();

	}elseif($_GET['exportData'] == "c") {
		$fp = fopen('clientes.csv', 'w');
		$results = array();
		$db = new MySQL();
			 $consulta = $db->consulta("SELECT * FROM CLIENTES");
			 while($row = mysql_fetch_assoc($consulta))
			{
				$results[] = $row;
			}

		foreach ($results as $fields) {
			fputcsv($fp, $fields);
		}

		fclose($fp);
		download_send_headers("clientes.csv");
		echo array2csv($results);
		die();
	}elseif($_GET['exportData'] == "v") {
		$fp = fopen('vehiculos.csv', 'w');
		$results = array();
		$db = new MySQL();
			 $consulta = $db->consulta("SELECT * FROM VEHICULOS");
			 while($row = mysql_fetch_assoc($consulta))
			{
				$results[] = $row;
			}

		foreach ($results as $fields) {
			fputcsv($fp, $fields);
		}

		fclose($fp);
		download_send_headers("vehiculos.csv");
		echo array2csv($results);
		die();
	}else{
		$fp = fopen('log.csv', 'w');
		$results = array();
		$db = new MySQL();
			 $consulta = $db->consulta("SELECT * FROM log");
			 while($row = mysql_fetch_assoc($consulta))
			{
				$results[] = $row;
			}

		foreach ($results as $fields) {
			fputcsv($fp, $fields);
		}

		fclose($fp);
		download_send_headers("log.csv");
		echo array2csv($results);
		die();	
	}
}




$error =""; $ok ="";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EuskoTruck | Gestión Comercial</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
</head>

<body>
<div id='webContainer'>
<?php include('inc_head.php'); ?>

<div id='webBody'>


<div id='tablaUsuarios'>
<h1>Gestión Usuarios</h1>
<p>Si desea crear un nuevo usuario pinche el siguiente enlace: <a href="usuarios.php?a=n">NUEVO USUARIO</a></p>


<?php
$a = ""; $i= ""; $tit ="";
if(isset($_GET['a'])) { 
	if ($_GET['a'] == "n") {
			$a = "n2";
			$i = "";
			$tit = "Nuevo Usuario";
			$btn = "Crear Usuario";
			$nombre="";
			$apellido="";
			$alias="";
			$pass="";
			$cliente=0; $usuario = 0; $pedido = 0; $vehiculo = 0; $activo = 1;
	} elseif ($_GET['a'] == "n2") {
			$a = "n2";
			$i = "";
			$tit = "Nuevo Usuario";
			$btn = "Crear Usuario";
			$nombre=$_GET["txtNombre"];
			$apellido=$_GET["txtApellido"];
			$alias=$_GET["txtAlias"];
			$pass=$_GET["txtPass"];
			if (isset($_GET['checkcl'])){$cliente=1;}else{$cliente=0;}
			if (isset($_GET['checkusu'])){$usuario=1;}else{$usuario=0;}
			if (isset($_GET['checkpart'])){$pedido=1;}else{$pedido=0;}
			if (isset($_GET['checkinf'])){$vehiculo=1;}else{$vehiculo=0;}
			if (isset($_GET['checkact'])){$activo=1;}else{$activo=0;}
			
			
			if ($alias =="" || $pass =="") {
					$error = "<p>Introduzca el Alias y la Contraseña del Usuario.<br /><br /></p>";
			} else {
					$pass1=crypt($pass,$pkpalabra);
					$db = new MySQL();
					$consulta = $db->consulta("SELECT * FROM usuarios WHERE borrado = 0 and alias='".$alias."'");
					if($db->num_rows($consulta)>0){
						$error = "<p>Alias ya existente en la base de datos.<br /><br /></p>";
					} else {
						$sql = "INSERT INTO usuarios VALUES (0,'".$alias."','".$pass1."',".$usuario.",".$cliente.",".$pedido.",".$vehiculo.",'".$nombre."','".$apellido."',".$activo.",0);";
						$consulta = $db->consulta($sql);		
						$ok = "<p>Muy bien!. Usuario registrado con &eacute;xito.<br /><br /></p>";
						$db1 = new MySQL();
								 $consulta1 = $db->consulta("SELECT * from usuarios where id='".$_SESSION['idusu']."'");
								 $resultados1 = $db->fetch_array($consulta1);
								 $sql1="INSERT INTO log (`idusuario`,`usuario`, `alias`, `descripcion`, `fecha`) VALUES('".$_SESSION['idusu']."','".$resultados1[7]." " .$resultados1[8]."','".$resultados1[1]."','Registro al usuario: $nombre $apellido','".$fechareg."')";
								 $consulta2 = $db->consulta($sql1);
								 $db1->closeMySQL();	
					}
					$db->closeMySQL();	
			}
			
			
	
	} elseif ($_GET['a'] == "e" || $_GET['a'] == "b") {
			$i=$_GET["i"];
			$a = $_GET["a"];
			$db = new MySQL();
		 	$consulta = $db->consulta("SELECT alias, pass, clientes, usuarios, pedidos, vehiculos, nombre, apellido, activo FROM usuarios where id=".$i);
		 	if($db->num_rows($consulta)>0)
		 	{
				$resultados = $db->fetch_array($consulta);
				if ($_GET['a'] == "e") {
					$tit = "Editar Usuario";
					$btn = "Editar Usuario";
					$a = "e2";
				} elseif ($_GET['a'] == "b") {
					$tit = "Eliminar Usuario";
					$btn = "Eliminar Usuario";
					$a ="b2";
				}
				$nombre=$resultados[6];
				$apellido=$resultados[7];
				$alias=$resultados[0];
				$pass=$resultados[1];
				$cliente=$resultados[2]; 
				$usuario =$resultados[3]; 
				$pedido = $resultados[4]; 
				$vehiculo = $resultados[5]; 
				$activo = $resultados[8];
				
			}
			$db->closeMySQL();
			
			
	} elseif ($_GET['a'] == "b2") {
			$a = "b2";
			$i = $_GET["i"];
			$db1 = new MySQL();
		$consulta2 = $db1->consulta("SELECT * from usuarios where id='".$i."'");
		 $resultados2 = $db1->fetch_array($consulta2);
		 $nombreborrado=$resultados2[7];
		 $apellidoborrado=$resultados2[8];
		 $db1->closeMySQL();
		 
		 
		 $db1 = new MySQL();
		 $consulta1 = $db1->consulta("SELECT * from usuarios where id='".$_SESSION['idusu']."'");
		 $resultados1 = $db1->fetch_array($consulta1);
		 $sql1="INSERT INTO log (`idusuario`,`usuario`, `alias`, `descripcion`, `fecha`) VALUES('".$_SESSION['idusu']."','".$resultados1[7]." " .$resultados1[8]."','".$resultados1[1]."','Borro al usuario: $nombreborrado  $apellidoborrado','".$fechareg."')";
		 $consulta2 = $db1->consulta($sql1);
		 $db1->closeMySQL();
		 
			$db = new MySQL();
			$consulta = $db->consulta("UPDATE usuarios set borrado = 1 where id = ".$i);
			$ok = "<p>Realizado!. Usuario eliminado con &eacute;xito.<br /><br /></p>";
			
			
			$db->closeMySQL();	

	} elseif ($_GET['a'] == "e2") {
			$a = "e2";
			$i = $_GET["i"];
			$tit = "Editar Usuario";
			$btn = "Editar Usuario";
			$nombre=$_GET["txtNombre"];
			$apellido=$_GET["txtApellido"];
			$alias=$_GET["txtAlias"];
			$pass=$_GET["txtPass"];
			if (isset($_GET['checkcl'])){$cliente=1;}else{$cliente=0;}
			if (isset($_GET['checkusu'])){$usuario=1;}else{$usuario=0;}
			if (isset($_GET['checkpart'])){$pedido=1;}else{$pedido=0;}
			if (isset($_GET['checkinf'])){$vehiculo=1;}else{$vehiculo=0;}
			if (isset($_GET['checkact'])){$activo=1;}else{$activo=0;}
			
			
			if ($alias =="") {
					$error = "<p>Introduzca el Alias del Usuario.<br /><br /></p>";
			} else {
					$pass1=crypt($pass,$pkpalabra);
					$db = new MySQL();
					$consulta = $db->consulta("SELECT * FROM usuarios WHERE borrado = 0 and alias='".$alias."' and id <> ".$i);
					if($db->num_rows($consulta)>0){
						$error = "<p>Alias ya existente en la base de datos.<br /><br /></p>";
					} else {
						if($pass=='') {
							$sql="UPDATE usuarios SET nombre='".$nombre."',apellido='".$apellido."', alias='".$alias."', clientes='".$cliente."', usuarios='".$usuario."', pedidos='".$pedido."', vehiculos='".$vehiculo."', activo='".$activo."' WHERE id=".$i;
						} else{ 
							$pass1=crypt($pass,$pkpalabra);
							$sql="UPDATE usuarios SET nombre='".$nombre."',apellido='".$apellido."',alias='".$alias."', pass='".$pass1."', clientes='".$cliente."', usuarios='".$usuario."', pedidos='".$pedido."', vehiculos='".$vehiculo."', activo='".$activo."'  WHERE id=".$i;
						}
						$consulta = $db->consulta($sql);		
						$ok = "<p>Perfecto!. Usuario actualizado con &eacute;xito.<br /><br /></p>";
								 $db1 = new MySQL();
								 $consulta1 = $db->consulta("SELECT * from usuarios where id='".$_SESSION['idusu']."'");
								 $resultados1 = $db->fetch_array($consulta1);
								 $sql1="INSERT INTO log (`idusuario`,`usuario`, `alias`, `descripcion`, `fecha`) VALUES('".$_SESSION['idusu']."','".$resultados1[7]." " .$resultados1[8]."','".$resultados1[1]."','Modifico datos del usuario: $nombre $apellido','".$fechareg."')";
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
        <p id="colum"><label for="txtNombre">Nombre: </label><input name="txtNombre" id="txtNombre" type="text" value="<?php echo utf8_encode ($nombre);?>">
        	<label for="txtApell">Apellidos: </label><input name="txtApellido" id="txtApellido" type="text" value="<?php echo utf8_encode ($apellido);?>"></p>
        <p id="colum"><label for="txtAlias">Alias: </label><input name="txtAlias" id="txtAlias" type="text" value="<?php echo utf8_encode ($alias);?>"> 
            <label for="txtPass">Contrase&ntilde;a: </label><input name="txtPass" id="txtPass" type="txtA" value=""> <?php if ($a <> "n" && $a<>"n2") { ?><span>En blanco si no se desea modificar la contraseña.</span><?php } ?></p>
        <p><label for="checkAct">Activo: </label><input type='checkbox' class="chk" name='checkact' id='checkact' value='' <?php if ($activo=='1') { echo ' checked'; } ?>></p>
        <h3>Perfiles</h3>
        <p>
          <label for="checkUsu">Usuario: </label><input type='checkbox' class="chk" name='checkusu' id='checkusu' value='' <?php if ($usuario=='1') { echo ' checked'; } ?>>
		  <label for="checkclmin">Clientes.: </label><input type='checkbox' class="chk" name='checkcl' id='checkcl' value='' <?php if ($cliente=='1') { echo ' checked'; } ?>>
          <label for="checkPart">Pedidos: </label><input type='checkbox' class="chk" name='checkpart' id='checkpart' value='' <?php if ($pedido=='1') { echo ' checked'; } ?>>
          <label for="checkInf">Vehículos: </label><input type='checkbox' class="chk" name='checkinf' id='checkinf' value='' <?php if ($vehiculo=='1') { echo ' checked'; } ?>></p>
        <p><input type='submit' class="btn" value='<?php echo $btn;?>' name='registrar'><input type='reset' class="btn2" value='Restablecer' name='borrar'></p>                
        </form> 
        <p class="cerrar"><a href="usuarios.php" target="_self"><br>X Cerrar Formulario</a></p>           
	  </div>
        
        <?php } ?> 
		
<?php }?>

<p class="table01"></p>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th rowspan="2">&nbsp;</th>
    <th rowspan="2" class="nombre">Nombre</th>
	<th rowspan="2" class="nombre">Apellidos</th>
    <th rowspan="2" class="nombre">Alias</th>
    <th colspan="4">Permisos</th>
    <th rowspan="2" class="permisos">Activo</th>
    <th rowspan="2"></th>
  </tr>
  <tr><th  class="permisos">Usuarios</th><th class="permisos">Clientes</th><th class="permisos">Pedidos</th><th class="permisos">Vehículos</th></tr>
            <?php
                     $db = new MySQL();
                     $consulta = $db->consulta("SELECT * FROM usuarios where  borrado=0 order by activo desc, nombre, apellido");
                     if($db->num_rows($consulta)>0)
                     {
                             while($resultados = $db->fetch_array($consulta)){ ?>
                                 <tr>
                                   <td class="vac">&nbsp;</td>
                                   <td class="permisos"><?php echo $resultados[7];?></td>
								   <td class="permisos"><?php echo $resultados[8];?></td>
                                   <td class="permisos"><?php echo $resultados[1];?></td>
                                   <td class="permisos"><?php if($resultados[3]==1){echo "<img src='../img/si.png' /> ";}else{echo "<img src='../img/no.png' />"; } ?></td>
                                   <td class="permisos"><?php if($resultados[4]==1){echo "<img src='../img/si.png' />";}else{echo "<img src='../img/no.png' />"; }?></td>
                                   <td class="permisos"><?php if($resultados[5]==1){echo "<img src='../img/si.png' />";}else{echo "<img src='../img/no.png' />"; }?></td>
                                   <td class="permisos"><?php if($resultados[6]==1){echo "<img src='../img/si.png' />";}else{echo "<img src='../img/no.png'/>"; }?></td>
                                   <td class="permisos"><?php if($resultados[9]==1){echo "<img src='../img/si.png' />";}else{echo "<img src='../img/acceso0.png'/>"; }?></td>
                                   <td class="acciones"><?php  if($resultados[0]!=$_SESSION['idusu']){ ?>
                                <a href="usuarios.php?i=<?php echo $resultados[0];?>&a=e"><img src="../img/editar.png" alt="Editar Usuario" width="20" height="20" /></a>
                                <a href="usuarios.php?i=<?php echo $resultados[0];?>&a=b"><img src="../img/borrar.png" width="20" height="20" alt="Borrar Usuario" /></a> <?php } ?>
                                
                                  </td></tr>
                                <?php 
								  }
                      }
                      $db->closeMySQL();?>
            </table>
		<p class="table04"></p>

		<div id="export">
		<h1>Exportar Datos</h1>
		<form class="frmExport" method='GET'><input name="exportData" type="hidden" value="u" />
		<input type="image" src="../img/opcUs0.png" alt="Submit Form" />    
        </form> 
		
		<form class="frmExport" method='GET'><input name="exportData" type="hidden" value="c" />
		<input type="image" src="../img/opcCl0.png" alt="Submit Form" />    
        </form> 
		
		<form class="frmExport" method='GET'><input name="exportData" type="hidden" value="v" />
		<input type="image" src="../img/opcVeh0.png" alt="Submit Form" />    
        </form> 
		
		<form class="frmExport" method='GET'><input name="exportData" type="hidden" value="l" />
		<input type="image" src="../img/logicon.png" alt="Submit Form" />    
        </form> 

		</div>
</div>





</div> <!---------------CIERRA DIV WEBBODY----------------------->

<?php include('inc_foot.php'); ?>

</div> <!---------------CIERRA DIV POSICION GENERAL----------------------->

</body>
</html>