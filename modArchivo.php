<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <title>Modificar Archivo</title>
</head>
<body>
<div id="contenedor">
<?php
$idArchivo=isset($_GET['archivo']) ? htmlspecialchars(trim(strip_tags($_GET['archivo']))) : null;

if($idArchivo != null){
    $archivo=archivo::buscaArchivo($idArchivo);
}
else $archivo=false;

$app->doInclude('comun/cabecera.php');
?>
	<div id="contenido">
    <?php 
        //if($archivo != false && Aplicacion::getSingleton()->usuarioLogueado() && $archivo->autor() == Usuario::buscaUsuario($_SESSION['username'])->id()) {
        	$formModArchivo = new \es\ucm\fdi\aw\FormularioModArchivo($idArchivo);
	     	$formModArchivo->gestiona();
        /*}
        else {
                echo "No se ha encontrado el archivo o no puedes modificarlo";
        }*/
	 ?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
