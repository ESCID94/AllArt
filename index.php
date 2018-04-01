<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/formLogin.php';

session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ejemplo 6 para incluir token CSRF en los formularios (Seguridad+Detección de doble envío de formularios)</title>
	</head>
  <body>
    <p>Para evitar la advertencia de recarga de formulario, es necesario que tras procesar el formulario, en caso se éxito,
    se fuerce al navegador a cargar otra URL (mediante una redirección).</p>
    
    <p>Toda la gestión del token CRSF está en <code>includes/formlib.php</code>, el resto del código no cambia !.</p>
    
<?php
  $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
  if ( $user ) :
?>
    <h1>Hola <?= $user ?></h1>
    <a href="logout.php">Logout</a>
<?php
  else :
    formularioLogin();
  endif;
?>
  </body>
</html>