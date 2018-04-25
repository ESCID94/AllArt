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
	<h1>*Art</h1>
	<div class="saludo">
	  <?=	mostrarSaludo() ?>
	</div>

	<div class="topnav">
		<a href="#musica">Música</a>
  		<a href="#pintura">Pintura</a>
 		<a href="#videos">Videos</a>
 		<a href="#escritos">Escritos</a>
  		<a href="#patrocinadores">Patrocinadores</a>

		<input type = "text" placeholder = "Search..">
	
		<br/>
		<br/>
		<a href="#home">Home</a>
		<a href="#miperfil">Mi Perfil</a>
		<a href="#seguidos">Seguidos</a>
		<a href="#subidos">Archivos Subidos</a>
		<a href="#destacados">Mis Destacados</a>
		<a href="#compras">Mis Compras</a>

	
</div>
