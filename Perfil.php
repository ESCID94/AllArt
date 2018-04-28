<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
  <title>Perfil</title>
</head>
<body>
<div id="contenedor">
<?php
$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">
    	<?php		
			echo "<img src='$_SESSION[imgPerfil]' border='0' width='100' height='100'>";
			echo "</br>";
			echo "Nombre: " . "$_SESSION[username]";
			echo "</br>";
			echo "Email: " . "$_SESSION[email]";
			echo "</br>";
			echo "Descripcion: " . "$_SESSION[descripcion]";
			echo "</br>";
			echo '<input type="button" value="Modificar perfil" onclick="location.href=http:/modPerfil.php"/>';
		?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
