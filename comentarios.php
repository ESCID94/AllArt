<?php
require_once __DIR__.'/includes/config.php';

use es\ucm\fdi\aw\Comentario as Com;

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <title>*Art:comentar</title>
</head>
<body>
<div id="contenedor">
<?php
$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">
    <?php 

      $idArch = $_POST["id"];
      
      $autor = $_POST['user'];
     
      $comentario = $_POST['comentario'];
  	
      $com = Com::crearComentario($autor, $comentario, $idArch);
	 ?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
