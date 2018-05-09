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
    $imagen = "<img src='" . $_SESSION['imgPerfil'] . "' border='0' width='100' height='100'>";
    $saludo = "Bienvenido,<a href='${perfilUrl}'>(${nombreUsuario})</a>.<a href='${logoutUrl}'>(salir)</a>";
    $html = $imagen . $saludo;
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
	<h1><a href="/allart/index.php" id="logo"><img src="img/allartslogo.jpg"></a></h1>
	</div>	
	<div class="saludo">
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
	


<?php
    
	if($app->usuarioLogueado()) {
    $app->doInclude('comun/cabeceraPerfil.php');
	
    }else{}

?>
</div>

