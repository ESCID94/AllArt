<?php
use es\ucm\fdi\aw;

$app = aw\Aplicacion::getSingleton();
?>

<div id="sidebar-left">
	<h3>Navegación</h3>
	<ul>
		<li><a href="<?= $app->resuelve('/index.php')?>">Inicio</a></li>
		<li><a href="<?= $app->resuelve('/contenido.php')?>">Ver contenido</a></li>
		<li><a href="<?= $app->resuelve('/admin.php')?>">Administrar</a></li>
		<li><a href="<?= $app->resuelve('/mensajes.php')?>">Mensajes</a></li>
	</ul>
</div>
