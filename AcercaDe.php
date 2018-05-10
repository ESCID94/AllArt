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

<p>AllArt</br>

All rights and ideas belong to AllArt creators and programmers: </br>

#Enrique Salazar del Cid: enrisala@ucm.es #Carlos Amat Fernández: caramat@ucm.es #Sara Núñez Sánchez: sanune01@ucm.es #Cosmin Mihai Dragomir: cosdrago@ucm.es #Álvaro Antón García: alvant01@ucm.es </br>

Art is a way of interacting with other people and being able to share and show the world, in a free way, your own creations.</br>
</p>

	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
