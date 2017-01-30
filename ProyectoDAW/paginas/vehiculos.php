<?php include('inc_ses.php'); 
if ($_SESSION['vehiculos'] <> 1) {
	echo "<noscript>Para continuar con el proceso de Identificación pinche en el siguiente enlace:  <a href='../index.php' class='aRojo' target='_self'>CONTINUAR</a>.</noscript><SCRIPT LANGUAGE=\"JavaScript\">location.href='index.php'</SCRIPT>";	die(); //header("Location: index.php");
}

include('../c/c.php');?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EuskoTruck | Gestión Comercial</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
<link rel="stylesheet" type="text/css" href="../css/galery.css" />
<script type="text/javascript" src="../js/galery.js"></script> 

<body>
<div id='webContainer'>
<?php include('inc_head.php'); ?>

<div id='webBody'><br>


<div id='tablaVehiculos'>
<h1>Lista de Vehículos</h1>


			<?php 
			 	$db = new MySQL();
				$consulta1 = $db->consulta("SELECT DISTINCT marca FROM `vehiculos`");
                     if($db->num_rows($consulta1)>0)
                     {
                             while($resultados = $db->fetch_array($consulta1)){ ?>


								 <div id="gesUsu">
										<h2><?php echo $resultados[0]; ?></h2> 
										<form class="frmUsu" method='GET'>
										
											  
							 
							 
							 				  <?php 
												$db = new MySQL();
												$consulta = $db->consulta("SELECT * FROM `vehiculos` where marca='".$resultados[0]."'");	
												if($db->num_rows($consulta)>0)
												 {
														 while($resultado = $db->fetch_array($consulta)){ ?>
												<div id="dEqui">
													<table border="0" cellpadding="0" cellspacing="0">
														<tr>
															<th>Modelo</th>
															<th>CV</th>
															<th>CC</th>
															<th>Gasolina</th>
															<th>Precio</th>
															<th>Ver más</th>
														</tr>
														<tr>
															<td><?php echo utf8_encode ($resultado[2]); ?></td>
															<td><?php echo utf8_encode ($resultado[3]); ?></td>
															<td><?php echo utf8_encode ($resultado[4]); ?></td>
															<td><?php echo utf8_encode ($resultado[5]); ?></td>
															<td><?php echo utf8_encode ($resultado[8]); ?> €</td>
															<td>
															<?php	if($resultados[0] == "Man"){ ?>
																<img src="../img/imagen.png" onclick="openModal1();currentSlide1(1)" class="hover-shadow" alt="imagenes" width="20" height="20" />
															<?php }else if($resultados[0] == "Scania"){ ?>
																<img src="../img/imagen.png" onclick="openModal2();currentSlide2(1)" class="hover-shadow" alt="imagenes" width="20" height="20" />
															<?php }else if($resultados[0] == "Iveco"){ ?>
																<img src="../img/imagen.png" onclick="openModal3();currentSlide3(1)" class="hover-shadow" alt="imagenes" width="20" height="20" />
																												
															<?php } ?>
															

                                <a href='pdfvehiculo.php?v=<?php echo $resultado[0];?>&u=<?php echo $_SESSION['idusu'];?>' target='_blank'><img src="../img/pdf1.jpg" width="20" height="20" alt="PDF" /></a> </td>
													   </tr>
													</table>
												</div>
											<?php  }}?>

										</form> 

									  </div>
									  <p class="table03"></p>
								<?php }	}	 ?>
				

				
<div id="myModal1" class="modal">
  <span class="close cursor" onclick="closeModal1()">&times;</span>
  <div class="modal-content">

    <div class="mySlides1">
      <div class="numbertext">1 / 4</div>
      <img src="../img/1/1.jpg" style="width:100%">
    </div>

    <div class="mySlides1">
      <div class="numbertext">2 / 4</div>
      <img src="../img/1/2.jpg" style="width:100%">
    </div>

    <div class="mySlides1">
      <div class="numbertext">3 / 4</div>
      <img src="../img/1/3.jpg" style="width:100%">
    </div>
    
    <div class="mySlides1">
      <div class="numbertext">4 / 4</div>
      <img src="../img/1/4.jpg" style="width:100%">
    </div>
    
    <a class="prev" onclick="plusSlides1(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides1(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    <div class="column">
      <img class="demo cursor" src="../img/1/1.jpg" style="width:100%" onclick="currentSlide1(1)" alt="Vehiculos MAN">
    </div>
    <div class="column">
      <img class="demo cursor" src="../img/1/2.jpg" style="width:100%" onclick="currentSlide1(2)" alt="Vehiculos MAN">
    </div>
    <div class="column">
      <img class="demo cursor" src="../img/1/3.jpg" style="width:100%" onclick="currentSlide1(3)" alt="Vehiculos MAN">
    </div>
    <div class="column">
      <img class="demo cursor" src="../img/1/4.jpg" style="width:100%" onclick="currentSlide1(4)" alt="Vehiculos MAN">
    </div>
  </div>
</div>
   

<div id="myModal2" class="modal">
  <span class="close cursor" onclick="closeModal2()">&times;</span>
  <div class="modal-content">

    <div class="mySlides2">
      <div class="numbertext">1 / 4</div>
      <img src="../img/2/1.jpg" style="width:100%">
    </div>

    <div class="mySlides2">
      <div class="numbertext">2 / 4</div>
      <img src="../img/2/2.jpg" style="width:100%">
    </div>

    <div class="mySlides2">
      <div class="numbertext">3 / 4</div>
      <img src="../img/2/3.jpg" style="width:100%">
    </div>
    
    <div class="mySlides2">
      <div class="numbertext">4 / 4</div>
      <img src="../img/2/4.jpg" style="width:100%">
    </div>
    
    <a class="prev" onclick="plusSlides2(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides2(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    <div class="column">
      <img class="demo cursor" src="../img/2/1.jpg" style="width:100%" onclick="currentSlide2(1)" alt="Vehiculos SCANIA">
    </div>
    <div class="column">
      <img class="demo cursor" src="../img/2/2.jpg" style="width:100%" onclick="currentSlide2(2)" alt="Vehiculos SCANIA">
    </div>
    <div class="column">
      <img class="demo cursor" src="../img/2/3.jpg" style="width:100%" onclick="currentSlide2(3)" alt="Vehiculos SCANIA">
    </div>
    <div class="column">
      <img class="demo cursor" src="../img/2/4.jpg" style="width:100%" onclick="currentSlide2(4)" alt="Vehiculos SCANIA">
    </div>
  </div>
</div>

<div id="myModal3" class="modal">
  <span class="close cursor" onclick="closeModal3()">&times;</span>
  <div class="modal-content">

    <div class="mySlides3">
      <div class="numbertext">1 / 4</div>
      <img src="../img/3/1.jpg" style="width:100%">
    </div>

    <div class="mySlides3">
      <div class="numbertext">2 / 4</div>
      <img src="../img/3/2.jpg" style="width:100%">
    </div>

    <div class="mySlides3">
      <div class="numbertext">3 / 4</div>
      <img src="../img/3/3.jpg" style="width:100%">
    </div>
    
    <div class="mySlides3">
      <div class="numbertext">4 / 4</div>
      <img src="../img/3/4.jpg" style="width:100%">
    </div>
    
    <a class="prev" onclick="plusSlides3(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides3(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    <div class="column">
      <img class="demo cursor" src="../img/3/1.jpg" style="width:100%" onclick="currentSlide3(1)" alt="Vehiculos IVECO">
    </div>
    <div class="column">
      <img class="demo cursor" src="../img/3/2.jpg" style="width:100%" onclick="currentSlide3(2)" alt="Vehiculos IVECO">
    </div>
    <div class="column">
      <img class="demo cursor" src="../img/3/3.jpg" style="width:100%" onclick="currentSlide3(3)" alt="Vehiculos IVECO">
    </div>
    <div class="column">
      <img class="demo cursor" src="../img/3/4.jpg" style="width:100%" onclick="currentSlide3(4)" alt="Vehiculos IVECO">
    </div>
  </div>
</div>

</div> <!---------------CIERRA DIV WEBBODY----------------------->

<?php include('inc_foot.php'); ?>

</div> <!---------------CIERRA DIV POSICION GENERAL----------------------->


</body>
</html>