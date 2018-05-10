<?php

require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <title>*Art</title>
</head>
<body>
<div id="contenedor">
<?php
$app->doInclude('comun/cabecera.php');

?>
	<div id="contenido">
            <?php
            $URLPassMod =  $app->resuelve('/subir.php');
			echo '<input type="button" value="Subir archivo" onclick="location.href=\'' . $URLPassMod . '\'"/>';
            ?>

	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
