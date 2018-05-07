<?php
use es\ucm\fdi\aw;

$app = aw\Aplicacion::getSingleton();


?>

        <ul class='topnav'>
		
        <a href="<?= $app->resuelve('/home.php')?>">Home</a>
		<a href="<?= $app->resuelve('/Perfil.php')?>">Mi Perfil</a>
		<a href="<?= $app->resuelve('/seguidos.php')?>">Seguidos</a>
		<a href="<?= $app->resuelve('/subidos.php')?>">Archivos Subidos</a>
		<a href="<?= $app->resuelve('/destacados.php')?>">Mis Destacados</a>
		<a href="<?= $app->resuelve('/compras.php')?>">Mis Compras</a>
  			
		
		</ul>



