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
	<h1><a href="<?= $app->resuelve('/index.php')?>">*Art</a></h1>
	</div>	
	<div class="saludo">
	  <?=	mostrarSaludo() ?>
	</div>

	<ul class="nav">
		<a href="#musica">Música</a>
  		<a href="#pintura">Pintura</a>
 		<a href="#videos">Videos</a>
 		<a href="#escritos">Escritos</a>
  		<a href="#patrocinadores">Patrocinadores</a>
	
		<input type = "text" placeholder = "Search..">
	</ul>
	</div>