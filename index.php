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
		<div class="row">
  		<div class="column">
   			 <img src="img/pintura.jpg" onclick="openModal();currentSlide(1)" class="hover-shadow">
  		</div>
		</div>

	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
