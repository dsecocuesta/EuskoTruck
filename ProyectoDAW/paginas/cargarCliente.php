<?php include('../c/c.php'); ?>
<?php $id=$_GET["i"]; 	
if  ($id == 0) {
	die();	
} else {
	 $db = new MySQL();
	 $consulta = $db->consulta("select * from clientes where id = ".$id);
	 if($db->num_rows($consulta)>0)  {
			$resultados1 = $db->fetch_array($consulta);
 ?>
	 
     
    
<p><label>Cliente</label> <select name="cbocliente" id="cbocliente" onChange="cargarCliente('cbocliente'); ">   
<?php
// creamos las opciones del select
 $db = new MySQL();
 $consulta = $db->consulta("SELECT id,nombre, apellido FROM clientes order by nombre");
 if($db->num_rows($consulta)>0) {
            while($resultados = $db->fetch_array($consulta)){
                    echo "<option value=".$resultados[0];
					if ($resultados[0] == $id) echo ' selected="selected"';
					echo ">".htmlentities($resultados[1] . " " . $resultados[2]). "</option>\n";
            }	
} ?></select></p>
<p><label>Dirección:</label><input readonly="readonly" type='text' name='txtDir' class="tipo03" value='<?php echo utf8_encode ($resultados1[4]); ?>' id='txtDir'> 
<label>Provincia:</label><input readonly="readonly" name='provincia' id='provincia' type='text'  class="tipo03" value='<?php echo $resultados1[6]; ?>'>
<label class="t03">C.P.:</label> <input readonly="readonly" name='cp' id='cp' type='text' class="tipo01" value='<?php echo $resultados1[5]; ?>'></p>	
<p><label>Teléfono:</label> <input readonly="readonly" name='telefono' id='telefono' type='text' class="tipo03"  value='<?php echo $resultados1[7]; ?>'> 
<label>Email:</label><input name='email' id='email' readonly="readonly" type='text'  class="tipo03" value='<?php echo $resultados1[8]; ?>'></p>

     
<?php
      }
      $db->closeMySQL();
}?>