<?php
use es\ucm\fdi\aw;

$app = aw\Aplicacion::getSingleton();
?>
<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
<div id="footer">	
	<ul class="nav">

	<a href="<?= $app->resuelve('/Contacto.php')?>">Contacto</a>
	<a href="<?= $app->resuelve('/AcercaDe.php')?>">Acerca de</a>
	<a href="<?= $app->resuelve('/PoliticaDePrivacidad.php')?>">Politica de Privacidad</a>
	<a href="<?= $app->resuelve('/TerminosYCondiciones.php')?>">Terminos y Condiciones</a>
	</ul>
</div>