<?php

namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';


?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <title>verArchivo</title>
</head>
<body>
<div id="contenedor">
<?php

$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
//$idArchivo=htmlspecialchars(trim(strip_tags($_GET['archivo'])));
$idArchivo = '1';
$archivo=archivo::buscaArchivo($idArchivo);
?>
	<div id="contenido">
    	<?php
			echo "<img src= '" . $archivo->ruta() . "'>";
			echo "</br>";
			echo 'Nombre: ' . $archivo->nombre();
			echo "</br>";
			echo "Autor: " . $archivo->autor();
			echo "</br>";
			echo "Descripción: " . $archivo->descripcion();
			echo "</br>";
			echo "Puntuacion: " . $archivo->puntuacion();
			echo "</br>";
			echo "Precio: " . $archivo->precio();
			echo "</br>";
		?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>