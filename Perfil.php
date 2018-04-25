<?php

//Inicio del procesamiento
session_start();


require_once __DIR__.'/includes/config.php';

?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/estilo.css') ?>" />
  <title>Perfil</title>
</head>
<body>
<div id="contenedor">
<?php
$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">
		<h1>Acceso al sistema</h1>
		<p> Hola </p>
    <?php		
			echo "$_SESSION[username]";
			//echo "\n";
			echo "$_SESSION[email]";
			//echo "\n";
			echo "$_SESSION[descripcion]";
	?>



	</div>
<?php
$app->doInclude('comun/sidebarDer.php');
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
