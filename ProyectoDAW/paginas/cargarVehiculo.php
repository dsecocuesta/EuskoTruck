<?php include('../c/c.php'); 

$cv=""; $cc=""; $gasolina=""; $marchas=""; $cambio=""; $precio="";

if(isset($_GET['i'])) { 
	$marca=$_GET["i"];	?>	
	
		<select style='width: 400px' name=cbovehiculo id=cbovehiculo onChange="cargarVehiculo('cbovehiculo'); ">

		<?php	 $db = new MySQL();
				 $consulta = $db->consulta("SELECT DISTINCT marca FROM vehiculos");
				 if($db->num_rows($consulta)>0)
				 {
					  echo "<option value='0'>Seleccione Vehículo</option>"; 
						 while($resultados = $db->fetch_array($consulta)){
								if ($resultados[0]==$marca){
									echo "<option selected value=".$resultados[0].">".$resultados[0]."</option>\n";
								}				
								if ($resultados[0]!=$marca){
									echo "<option value=".$resultados[0].">".$resultados[0]."</option>\n"; 
								}
							}		 
							 
				  }
				  $db->closeMySQL();
			echo "</select>"; 		?>

		<select style='width: 400px' name=cbovehiculomodelo id=cbovehiculomodelo onChange="cargarModeloVehiculo('cbovehiculomodelo'); "><br><br>"; 

		<?php	 $db = new MySQL();
				 $consulta = $db->consulta("SELECT id, modelo FROM vehiculos WHERE marca ='".$marca."'");
				 if($db->num_rows($consulta)>0)
				 {
					  echo "<option value='0'>Seleccione Modelo</option>"; 
						 while($resultados = $db->fetch_array($consulta)){

							echo "<option value=".$resultados[0].">".$resultados[1]."</option>\n"; 
								
						}		 
							 
				  }
				  $db->closeMySQL();
			echo "</select>"; 

}else{
		$id=$_GET["m"]; 
				$db = new MySQL();
				$consulta = $db->consulta("SELECT * FROM vehiculos WHERE id ='".$id."'");
				if($db->num_rows($consulta)>0)
				{
					$resultados1 = $db->fetch_array($consulta);

				}
				$db->closeMySQL();		?>	
				
		<select style='width: 400px' name=cbovehiculo id=cbovehiculo onChange="cargarVehiculo('cbovehiculo'); ">

		<?php	 $db = new MySQL();
				 $consulta = $db->consulta("SELECT DISTINCT marca FROM vehiculos");
				 if($db->num_rows($consulta)>0)
				 {
					  echo "<option value='0'>Seleccione Vehículo</option>"; 
						 while($resultados = $db->fetch_array($consulta)){
								if ($resultados[0]==$resultados1[1]){
									echo "<option selected value=".$resultados[0].">".$resultados[0]."</option>\n";
								}				
								if ($resultados[0]!=$resultados1[1]){
									echo "<option value=".$resultados[0].">".$resultados[0]."</option>\n"; 
								}
							}		 
							 
				  }
				  $db->closeMySQL();
			echo "</select>"; 		?>
		
		<select style='width: 400px' name=cbovehiculomodelo id=cbovehiculomodelo onChange="cargarModeloVehiculo('cbovehiculomodelo'); "><br><br>"; 

		<?php	 $db = new MySQL();
				 $consulta = $db->consulta("SELECT id, modelo FROM vehiculos WHERE marca ='".$resultados1[1]."'");
				 if($db->num_rows($consulta)>0)
				 {
						 while($resultados = $db->fetch_array($consulta)){
								if ($resultados[0]==$resultados1[0]){
									echo "<option selected value=".$resultados[0].">".$resultados[1]."</option>\n";
								}				
								if ($resultados[0]!=$resultados1[0]){
									echo "<option value=".$resultados[0].">".$resultados[1]."</option>\n"; 
								}
								
						}		 
							 
				  }
				  $db->closeMySQL();
			echo "</select>"; 

$cv=$resultados1[3]; $cc=$resultados1[4]; $gasolina=$resultados1[5]; $marchas=$resultados1[6]; $cambio=$resultados1[7]; $precio=$resultados1[8];}?>




<p><table align="center"><tr><td></td><th>C.V.</th><th>C.C.</th><th>Gasolina</th><th>Cambio</th><th>Marchas</th><th>Precio</th></tr>

<tr><td></td><td><input type='text' class="tipo04" name='txtcv' id='txtcv' value='<?php echo utf8_encode ($cv); ?>' ></td><td><input type='text' class="tipo04"  name='txtcc' id='txtcc' value='<?php echo utf8_encode ($cc); ?>' ></td><td><input type='text' class="tipo04" name='txtgasolina' id='txtgasolina' value='<?php echo utf8_encode ($gasolina); ?>' ></td><td><input class="tipo04" name='txtcambio' id='txtcambio' type='text' value='<?php echo utf8_encode ($cambio); ?>' ></td><td><input class="tipo04" type='text' name='txtmarchas' id='txtmarchas' value='<?php echo utf8_encode ($marchas); ?>'></td><td><input class="tipo04" type='text' name='txtpreciotable' id='txtpreciotable' value='<?php echo utf8_encode ($precio); ?>' ></td></tr></table></p>

	<h2>Precio</h2>
				<table align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<th>Base</th>
						<th>Descuento %</th>
						<th>Total</th>

				   </tr>
				   <tr>
						<td><label name="txtprecio" id="txtprecio"><?php echo utf8_encode ($precio); ?></label><input type="hidden" id="txtpreciohidden" name="txtpreciohidden" value="<?php echo utf8_encode ($precio); ?>"/></td>
									<td><input STYLE='text-align: center;' class="tipo001" name="txtdescuento" id="txtdescuento" oninput="calcularDescuento()" type="text" value=""> </td>
									<td><label for="button" name="txttotal" id="txttotal"><?php echo utf8_encode ($precio); ?></label></td>
									<input type="hidden" id="txttotalhidden" name="txttotalhidden" value="<?php echo utf8_encode ($precio); ?>"/>
				   </tr>
			   </table>