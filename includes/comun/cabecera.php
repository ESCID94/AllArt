<?php
use es\ucm\fdi\aw;

$app = aw\Aplicacion::getSingleton();

function mostrarSaludo() {
  $html = '';
  $app = aw\Aplicacion::getSingleton();
  if ($app->usuarioLogueado()) {
    $nombreUsuario = $app->nombreUsuario();
    $logoutUrl = $app->resuelve('/logout.php');
    $perfilUrl = $app->resuelve('/Perfil.php');
    $html = "Bienvenido,<a href='${perfilUrl}'>(${nombreUsuario})</a>.<a href='${logoutUrl}'>(salir)</a>";
  } else {
    $loginUrl = $app->resuelve('/login.php');
    $RegistroUrl = $app->resuelve('/registro.php');
    $html = "Usuario desconocido. <a href='${loginUrl}'>Login</a>/<a href='${RegistroUrl}'>Registrarse</a>";
  }

  return $html;
}

?>
<div id="header">

	<div class="logo">
	<h1><a href=/allart/index.php id="logo"><img src="img/allartslogo.jpg"></a></h1>
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
	</div>
