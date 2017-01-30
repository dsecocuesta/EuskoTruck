<?php session_start(); 
if ($_SESSION['idusu']=='') {
 echo "<noscript>Para continuar con el proceso de Identificación pinche en el siguiente enlace:  <a href='../index.php' class='aRojo' target='_self'>CONTINUAR</a>.</noscript><SCRIPT LANGUAGE=\"JavaScript\">location.href='../index.php'</SCRIPT>";	//header("Location: index.php");
}?>