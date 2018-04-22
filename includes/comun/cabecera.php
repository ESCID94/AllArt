<?php
use es\ucm\fdi\aw;

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
<div id="cabecera">
	<h1>Mi gran página web</h1>
	<div class="saludo">
	  <?=	mostrarSaludo() ?>
	</div>
</div>

