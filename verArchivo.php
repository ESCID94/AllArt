<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Comentario as Com;
require_once __DIR__.'/includes/config.php';


?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <title>verArchivo</title>
</head>
<body>
<div id="contenedor">
<?php

$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');

$idArchivo=isset($_GET['archivo']) ? htmlspecialchars(trim(strip_tags($_GET['archivo']))) : null;

if($idArchivo != null){
    $archivo=archivo::buscaArchivo($idArchivo);
}
else $archivo=false;
?>
	<div id="contenido">
    	<?php
            if($archivo != false) {
        		echo "<embed src= '" . $archivo->ruta() . "' width='400' height='400' autostart='true' loop='true' /> </embed>'";
			    //echo "<img src= '" . $archivo->ruta() . "'>";
			    echo "</br>";
			    echo "Nombre: " . $archivo->nombre();
			    echo "</br>";
			    echo "Autor: " . $archivo->autor();
			    echo "</br>";
			    echo "Descripción: " . $archivo->descripcion();
			    echo "</br>";
			    echo "Puntuacion: " . $archivo->puntuacion();
			    echo "</br>";
			    echo "Precio: " . $archivo->precio();
			    echo "</br>";

			    $ID = $archivo->id();
     			$formComment = new \es\ucm\fdi\aw\FormularioComentario($ID);
     			$formComment->gestiona();

			    

			    $comments = Comentario::verComentarios($ID);

			    if ($comments !== FALSE)
			    {
				    $ite = 0;
				    foreach($comments as $value)
				    {
					    $comentario = (object) $comments[$ite];
					    $ite++;

					    $autor = Usuario::buscaUsuarioById($comentario->Autor);
					    echo "</br>";
					    echo $autor->username();
					    echo $comentario->Fecha;
					    echo "</br>";
					    echo $comentario->Texto;
				    }
			    }
			    else
			    {
				    echo "No hay Comentarios. Se el primero en comentar!";
			    }
            }

            else {
                echo "No se ha encontrado el archivo";
            }
		?>
		
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
