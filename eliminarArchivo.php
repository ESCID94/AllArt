<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <title>Eliminar Archivo</title>
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
            if($archivo!=false) echo "<p>Confirma la eliminación del archivo o pulsa \"Volver\"</p>";
            $formElimArchivo = new \es\ucm\fdi\aw\FormularioEliminarArchivo($idArchivo);
	     	$formElimArchivo->gestiona();
            echo "</br>";
            $mostradorArchivo = new \es\ucm\fdi\aw\MostradorArchivo($archivo);
            echo $mostradorArchivo->mostrar();
            if($archivo!=false){        	
                $URLVolver =  $app->resuelve('/verArchivo.php') . "?archivo=" . $idArchivo;
            } else {
                $URLVolver =  $app->resuelve('/home.php');
            }
            echo '<br/><input type="button" value="Volver" onclick="location.href=\'' . $URLVolver . '\'"/>';
        
	 ?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
