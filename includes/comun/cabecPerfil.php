<?php
use es\ucm\fdi\aw;

$app = aw\Aplicacion::getSingleton();

function mostrarSaludo() {
  $html = '';
  $app = aw\Aplicacion::getSingleton();
  if ($app->usuarioLogueado()) {
     } else {
      }

  return $html;
}

?>


<div id="header">

	<div class="logo">
	<h1><a href="/allart/index.php" id="logo"><img src="img/allartslogo.jpg"></a></h1>
	</div>	
	<div class="saludo">
		<img src="img/avatar.jpg">
	  <?=mostrarSaludo() ?>
	</div>

	<ul class="topnav">
		<a href="<?= $app->resuelve('/musica.php')?>">Música</a>
		<a href="<?= $app->resuelve('/pintura.php')?>">Pintura</a>
		<a href="<?= $app->resuelve('/videos.php')?>">Videos</a>
		<a href="<?= $app->resuelve('/escritos.php')?>">Escritos</a>
		<a href="<?= $app->resuelve('/patrocinadores.php')?>">Patrocinadores</a>
  			
		<input type = "text" placeholder = "Search..">
	</ul>
	



	
	<ul class="topnav">


		<a href="<?= $app->resuelve('/home.php')?>">Home</a>
		<a href="<?= $app->resuelve('/Perfil.php')?>">Mi Perfil</a>
		<a href="<?= $app->resuelve('/seguidos.php')?>">Seguidos</a>
		<a href="<?= $app->resuelve('/subidos.php')?>">Archivos Subidos</a>
		<a href="<?= $app->resuelve('/destacados.php')?>">Mis Destacados</a>
		<a href="<?= $app->resuelve('/compras.php')?>">Mis Compras</a>
  			
		
		</ul>


</div>

