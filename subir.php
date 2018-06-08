<?php
require_once __DIR__.'/includes/config.php';
?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <title>*Art</title>
</head>
<body>
<div id="contenedor">
<?php
$app->doInclude('comun/cabecera.php');
?>
    <div id="contenido">
    <?php 
        $opciones = array( 'ajax' => false, 'action' => null, 'class' => null, 'enctype' => "multipart/form-data" );
    	$formSubir = new \es\ucm\fdi\aw\FormularioSubir($opciones);
	 	$formSubir->gestiona();
	 ?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
