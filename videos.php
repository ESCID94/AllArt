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
		<!-https://www.w3schools.com/html/html5_video.asp ->
		<p> Video Test </p>
			<video width="320" height="240" controls>
 			 <source src="uploads/mov_bbb.mp4" type="video/mp4">
			  <source src="uploads/mov_bbb.ogg" type="video/ogg">
			Your browser does not support the video tag.
			</video>
		
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
