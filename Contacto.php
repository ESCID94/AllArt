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
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">

<p>
Contacto:
	</br>#Enrique Salazar del Cid: enrisala@ucm.es </br>#Carlos Amat Fernández: caramat@ucm.es </br>#Sara Núñez Sánchez: sanune01@ucm.es </br>#Cosmin Mihai Dragomir: cosdrago@ucm.es </br>#Álvaro Antón García: alvant01@ucm.es
</p>

	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
