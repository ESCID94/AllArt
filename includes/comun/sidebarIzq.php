<?php
use es\ucm\fdi\aw;

$app = aw\Aplicacion::getSingleton();
?>

<div id="sidebar-left">
	<h3>Ordenar por</h3>
	<ul>
		<li><a href="<?= $app->resuelve('/MayorAMenorPrecio.php')?>">Mayor a menor precio</a></li>
		<li><a href="<?= $app->resuelve('/MenorAMayorPrecio.php')?>">Menor a mayor precio</a></li>
		<li><a href="<?= $app->resuelve('/MasValorados.php')?>">Más valorados</a></li>
	</ul>
</div>
