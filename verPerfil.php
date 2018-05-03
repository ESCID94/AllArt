<?php

namespace es\ucm\fdi\aw;
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
$nombreUsuario=htmlspecialchars(trim(strip_tags($_GET['usuario'])));
$usuario=Usuario::buscaUsuario($nombreUsuario);
$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">
    	<?php
			echo "<img src= '" . $usuario->imgPerfil() . "' border='0' width='100' height='100'>";
			echo "</br>";
			echo 'Nombre: ' . $usuario->username();
			echo "</br>";
			//echo "Email: " . "$usuario->email()";
			//echo "</br>";
			echo "Descripción: " . $usuario->descripcion();
			echo "</br>";
			echo "Fecha nacimiento: " . $usuario->fechaNac();
			echo "</br>";

			$id = $usuario->id();

			$img = archivo::buscarImagenDest($id);

			$ruta = $img->ruta();

			echo "Imagen destacada: ";

			echo "<img src= '" . $ruta . "' border='0' width='300' height='300'>";


			
		?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
