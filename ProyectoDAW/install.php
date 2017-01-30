<?php
session_start();


$id = 3;
if(isset($_GET['id'])) { 
	$id=$_GET["id"];
	if($id == 0){
		$filename = "ProyectoDAW.rar";
		$filepath = getcwd();

		$winRAR = '"C:\Program Files\WinRAR\UnRAR.exe"';
		$file="ProyectoDAW.rar";
		$do ="$winRAR x $file $filepath";
		exec("$winRAR /?");
		exec($do,$aOut); 
		
	}else if($id == 1){
		$close='";';
		
		$_SESSION['server'] = $_GET["txtServer"];
		$_SESSION['username'] = $_GET["txtName"];
		$_SESSION['password'] = $_GET["txtPass"];
		$_SESSION['database'] = $_GET["txtDB"];
		
		$server='server="'.$_GET["txtServer"].$close; 
		$username='username="'.$_GET["txtName"].$close; 
		$password='password="'.$_GET["txtPass"].$close; 
		$database='database="'.$_GET["txtDB"].$close; 

		$filecontent=file_get_contents('c/c.php');

		$pos=strpos($filecontent, 'if(!isset($this->conexion))');
		$filecontent=substr($filecontent, 0, $pos)."\r\n$".$server."\r\n$".$username."\r\n$".$password."\r\n$".$database."\r\n\r\n".substr($filecontent, $pos);
		file_put_contents("c/c.php", $filecontent);
		
	}else if($id == 2){
		
		$filename = 'euskotruck.sql';

		$enlace = mysql_connect($_SESSION['server'], $_SESSION['username'], $_SESSION['password']);
		if (!$enlace) {
			die('No pudo conectarse: ' . mysql_error());
		}

		$sql = 'CREATE DATABASE '.$_SESSION['database'];
		if (mysql_query($sql, $enlace)) {
			//echo "La base de datos mi_bd se creó correctamente\n";
		} else {
			echo 'Error al crear la base de datos: ' . mysql_error() . "\n";
		}

		mysql_connect($_SESSION['server'], $_SESSION['username'], $_SESSION['password']) or die('Error connecting to MySQL server: ' . mysql_error());
		mysql_select_db($_SESSION['database']) or die('Error selecting MySQL database: ' . mysql_error());


		$templine = '';
		$lines = file($filename);
		foreach ($lines as $line)
		{
		// Skip it if it's a comment
		if (substr($line, 0, 2) == '--' || $line == '')
			continue;

		// Add this line to the current segment
		$templine .= $line;
		// If it has a semicolon at the end, it's the end of the query
		if (substr(trim($line), -1, 1) == ';')
		{
			// Perform the query
			mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
			// Reset temp variable to empty
			$templine = '';
		}
		}
		 //echo "Tables imported successfully";
		
	}
	
	

}






?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EuskoTruck | Instalador</title>
<style>
html, body {    height: 100%;	text-align: center;}
html {    display: table;    margin: auto;}
body {    display: table-cell;    vertical-align: middle;}
#webContainer {padding:10px; border-radius:15px;}
button {    background-color: #4CAF50; /* Green */    border: none;    color: white;    padding: 15px 32px;    text-align: center;    text-decoration: none;    display: inline-block;    font-size: 16px;    margin: 4px 2px;    cursor: pointer;    -webkit-transition-duration: 0.4s; /* Safari */    transition-duration: 0.4s;	 border-radius:15px;	 outline: none;}
button:hover {    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);}
#header{  font-size: 17px;  font-weight: bold;  background-color: rgba(255,255,255,0.8);  padding-top:15px;padding-bottom:15px;  border-radius:15px;}
input[type=text] {    border: none;    border-bottom: 2px solid #04B404;	 background: transparent;  text-align: center;  outline: none;}
img{width:220px; height:100px;padding:20px;}
</style>

<body>
<img src="logo.png" alt="logo">
<div id='webContainer'>
<?php if ($id == 0){ ?>
		<style>
		#webContainer {background: #C9DBBA;}
		</style>
		<div id="header">
				Configuración base de datos
		</div>
		<p>Rellene la información necesaria para conectar a tu base de datos:</p>
		<form method='GET'><input name="id" type="hidden" value="1" />
        <p> <input name="txtServer" id="txtServer" type="text" value="" placeholder="Servidor"></p>
        <p>	<input name="txtName" id="txtName" type="text" value="" placeholder="Nombre">	</p>
        <p> <input name="txtPass" id="txtPass" type="text" value="" placeholder="Contraseña"> </p>
        <p> <input name="txtDB" id="txtDB" type="text" value="" placeholder="Base de datos">  </p>    
		<p><button type='submit' name='registrar'>Siguiente</button><button type='reset' value='Restablecer'>Restablecer</button></p>    		
        </form> 

<?php }else if ($id == 1){ ?>
		<style>
		#webContainer {background: #FAA381;}
		</style>
		<div id="header">
				Importar datos
		</div>
		<p>A continuación importaremos los datos necesarios a tu base de datos:</p>
		<p>Usaremos el archivo <b>Euskotruck.sql</b> y debido al volumen de datos puede tardar unos segundos.</p>
		<form method='GET'><input name="id" type="hidden" value="2" />
		<p><button type='submit' name='registrar'>Siguiente</button></p>    		
        </form> 
<?php }else if ($id == 2){ ?>
		<style>
		#webContainer {background: #C5FFFD;}
		</style>
		<div id="header">
				Instalación finalizada
		</div>
		<p>Hemos instalado la web de EuskoTruck correctamente</p>
		<p>Recuerde borrar los archivos de la instalación</p>
		<form method='GET'  action="index.php">
		<p><button type='submit' name='registrar'>Finalizar</button></p>    		
        </form> 
		
<?php }else{ ?>
		<style>
		#webContainer {background: #C5FFFD;}
		</style>
		<div id="header">
				Descomprimir archivos
		</div>
		<p>Bienvenido al instalador de la web EuskoTruck.</p>
		<p>Vamos a descomprimir los archivos para aplicar la configuración necesaria.</p> 
		<p><b>Esto puede llevar unos segundos.</b></p><br>
		
		<form method='GET'><input name="id" type="hidden" value="0" />
		<p><button type='submit' name='registrar'>Siguiente</button></p>    		
        </form> 
<?php } ?>

</div>
</body>
</html>