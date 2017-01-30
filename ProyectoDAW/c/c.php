<?php

class MySQL{
    private $conexion;
    private $total_consultas;


    public function MySQL()
    {
		


if(!isset($this->conexion))
        {
				
            $this->conexion = (mysql_connect($server, $username, $password)) or die(mysql_error());
            mysql_select_db($database,$this->conexion) or die(mysql_error());
           
        }
    }


            
    public function consulta($consulta)
    {
        $this->total_consultas++;
        $resultado = mysql_query($consulta,$this->conexion);
        if(!$resultado)
        {
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }
        return $resultado;
    }
   
    public function fetch_array($consulta){  return mysql_fetch_array($consulta); }
	
	 public function fetch_row($consulta){  return mysql_fetch_row($consulta); }
   
    public function num_rows($consulta){  return mysql_num_rows($consulta); }
   
    public function getTotalConsultas(){ return $this->total_consultas; }
   
    public function closeMySQL () { mysql_close($this->conexion); }
}

function array2csv(array &$array)
{
	   if (count($array) == 0) {
		 return null;
	   }
	   ob_start();
	   $df = fopen("php://output", 'w');
	   fputcsv($df, array_keys(reset($array)));
	   foreach ($array as $row) {
		  fputcsv($df, $row);
	   }
	   fclose($df);
	   return ob_get_clean();
}

function download_send_headers($filename) {
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");

		// force download  
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");

		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
}

$pkpalabra = "Pr0X#2013PhP"; 
$numRegistrosMostrar = 5; 
$fechareg=date("Y-m-d H:i:s");

?>



