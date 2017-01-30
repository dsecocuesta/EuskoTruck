<header>
<div id="logo"><p><a href="menu.php" target="_self"><img src="../img/logo.png" alt="EuskoTrunk" width="194" height="79" /></a> 
<?php if ($_SESSION['nombre'] <> ""){ ?><?php echo "Hola ".$_SESSION['nombre']."!"; ?> | <a href="../index.php" target="_self">Cerrar Sesi&oacute;n</a><?php } ?></p></div>
</header>