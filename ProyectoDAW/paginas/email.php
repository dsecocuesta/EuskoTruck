<?php include('inc_ses.php'); 
if ($_SESSION['clientes'] <> 1) {
	echo "<noscript>Para continuar con el proceso de Identificación pinche en el siguiente enlace:  <a href='../index.php' class='aRojo' target='_self'>CONTINUAR</a>.</noscript><SCRIPT LANGUAGE=\"JavaScript\">location.href='../index.php'</SCRIPT>";	die(); //header("Location: index.php");
}

require '../PHPMailer/PHPMailerAutoload.php';
include('../c/c.php');
$error =""; $ok ="";?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EuskoTruck | Gestión Comercial</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css" />


<body>
<div id='webContainer'>
<?php include('inc_head.php'); ?>

<div id='webBody'>


<div id='tablaEmail'>
<h1>Enviar Email</h1>



<?php
$error =""; $ok ="";
if(isset($_GET['c'])) { 		
			$c=$_GET["c"];
			$db = new MySQL();
		 	$consulta = $db->consulta("SELECT * FROM clientes where id=".$c);
		 	if($db->num_rows($consulta)>0)
		 	{
				$resultados = $db->fetch_array($consulta);
			}
			$db->closeMySQL();
			
			$nombre=$resultados[1] . " ".$resultados[2];
			$email=$resultados[8];
			$mensaje = '';
				
			

}else{


		$nombre=$_GET["txtnombre"];
		$email=$_GET["txtemail"];
		$mensaje=utf8_decode ($_GET["txtcomentarios"]);

		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Set who the message is to be sent from
		$mail->setFrom('director@davidproyectodaw.esy.es', 'EuskoTruck Comercial');
		//Set who the message is to be sent to
		$mail->addAddress($email, $nombre);

		//Set the subject line
		$mail->Subject = 'EuskoTruck Email';

		$cabecera = '<h1>Este es un email generado desde la web EuskoTruck.</h1>';
		$cabecera .= "<h4>Nombre: ".$nombre."<br>"."<h4>E-mail: ".$email."</h4><br><br><h5>".$mensaje."</h5>";
			
		$mail->Body = $cabecera;

		//$mail->Body = '<h1>Este es un email generado desde la web EuskoTruck.</h1>';
		$mail->IsHTML(true);

		//send the message, check for errors
		if (!$mail->send()) {
			$error = "<p>Mailer Error!. ". $mail->ErrorInfo." <br /><br /></p>";
		} else {
			$ok = "<p>Perfecto!. Email enviado con &eacute;xito.<br /><br /></p>";
								  $db1 = new MySQL();
									 $consulta1 = $db1->consulta("SELECT * from usuarios where id='".$_SESSION['idusu']."'");
									 $resultados1 = $db1->fetch_array($consulta1);
									 $sql1="INSERT INTO log (`idusuario`,`usuario`, `alias`, `descripcion`, `fecha`) VALUES('".$_SESSION['idusu']."','".$resultados1[7]." " .$resultados1[8]."','".$resultados1[1]."','Envio un mensaje al cliente $id','".$fechareg."')";
									 $consulta2 = $db1->consulta($sql1);
									 $db1->closeMySQL();
		}			
	}	?>
    
    <?php if ($error <> "") { 	echo '<div id="fLogError">'.$error.'</div>';	}?>
    <?php if ($ok <> "") { 		echo '<div id="fLogOk">'.$ok.'</div>';	}?>
    
	
    <div id="gesParte">
		<form class="frmUsu" method='GET'><input name="id" id="id" type="hidden" value="<?php echo $p;?>" />
        <h2></h2> 
		<p><label>Cliente:</label><input name='txtnombre' id='txtnombre' type='text' value='<?php echo utf8_encode ($nombre); ?>' ></p><p><label>Email: </label><input name="txtemail" id="txtemail" type="text"  value="<?php echo utf8_encode ($email);?>"></p>

		 <p><h2>Mensaje: </h2><textarea type='textarea' name='txtcomentarios' cols='94' rows='4' value=""><?php echo utf8_encode ($mensaje); ?></textarea></p>
            <input name="button" id="button" type='submit' class="btn" value='Enviar' name='registrar'>
        </form>         
	  </div>
     
          
</div>


</div> <!---------------CIERRA DIV WEBBODY----------------------->

<?php include('inc_foot.php'); ?>

</div> <!---------------CIERRA DIV POSICION GENERAL----------------------->

</body>
</html>
