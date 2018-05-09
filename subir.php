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
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">
		<div class="upload-btn-wrapper">
		<form enctype="multipart/form-data" action="uploader.php" method="POST">
		<input name="uploadedfile" class="btn" type="file" />
		<input type="submit" class="btn" value="Subir archivo" />
		</form>
		</div>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
