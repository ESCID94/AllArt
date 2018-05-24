<?php
require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <title>Modificar Archivo</title>
</head>
<body>
<div id="contenedor">
<?php
$idArchivo=htmlspecialchars(trim(strip_tags($_GET['archivo'])));
$app->doInclude('comun/cabecera.php');
?>
	<div id="contenido">
    <?php 
    	$formModArchivo = new \es\ucm\fdi\aw\FormularioModArchivo($idArchivo);
	 	$formModArchivo->gestiona();
	 ?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
