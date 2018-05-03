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


<?php
$app->doInclude('cabecera.php');
?>
<div id="header">



	<ul class="nav">
		<a href="#home">Home</a>
		<a href="#miperfil">Mi Perfil</a>
		<a href="#seguidos">Seguidos</a>
		<a href="#subidos">Archivos Subidos</a>
		<a href="#destacados">Mis Destacados</a>
		<a href="#compras">Mis Compras</a>
	</ul>

</div>