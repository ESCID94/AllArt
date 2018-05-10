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

		<!- Reference to : https://www.w3schools.com/html/html5_audio.asp->
		<p> Audio Test: </p>
		<audio controls>
		  <source src="uploads/horse.ogg" type="audio/ogg">
		  <source src="uploads/horse.mp3" type="audio/mpeg">
		Your browser does not support the audio element.
		</audio>
		
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
