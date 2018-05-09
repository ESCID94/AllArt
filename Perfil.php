<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
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
            $URLPassMod =  $app->resuelve('/modImagen.php');
			echo '<input type="button" value="Modificar imagen de perfil" onclick="location.href=\'' . $URLPassMod . '\'"/>';
            echo "</br>";
			echo "Nombre: " . "$_SESSION[username]";
			echo "</br>";
			echo "Email: " . "$_SESSION[email]";
			echo "</br>";
			echo "Descripción: " . "$_SESSION[descripcion]";
			echo "</br>";
			echo "Fecha nacimiento: " . " $_SESSION[fechaNac]";
			echo "</br>";

			$URLMod =  $app->resuelve('/modPerfil.php');
			echo '<input type="button" value="Modificar perfil" onclick="location.href=\'' . $URLMod . '\'"/></br>';
            
            $URLPassMod =  $app->resuelve('/modPass.php');
			echo '<input type="button" value="Modificar contraseña" onclick="location.href=\'' . $URLPassMod . '\'"/>';

            
		?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
