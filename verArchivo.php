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
$idArchivo=htmlspecialchars(trim(strip_tags($_GET['archivo'])));

$archivo=archivo::buscaArchivo($idArchivo);
?>
	<div id="contenido">
    	<?php
			echo "<img src= '" . $archivo->ruta() . "'>";
			echo "</br>";
			echo 'Nombre: ' . $archivo->nombre();
			echo "</br>";
			echo "Autor: " . $archivo->autor();
			echo "</br>";
			echo "Descripción: " . $archivo->descripcion();
			echo "</br>";
			echo "Puntuacion: " . $archivo->puntuacion();
			echo "</br>";
			echo "Precio: " . $archivo->precio();
			echo "</br>";
			?>
     		<p> 
			<FORM NAME="miFormu" ACTION="comentarios.php" METHOD="post"> 
				<?php
					$id_Arch  = $archivo->id();
				?>
			<INPUT TYPE="hidden" NAME="id" VALUE="<?= $id_Arch ?>">
				<?php
					$userComment  = $_SESSION['username'];
				?>
			<INPUT TYPE="hidden" NAME="user" VALUE = "<?= $userComment ?>">
			Comentario: <INPUT TYPE="text" NAME="comentario" SIZE=100 MAXLENGTH=500> 
			<BR> 
			<INPUT TYPE="submit" CLASS="boton" VALUE="Comentar"> 
			</FORM>

			<?php 
			$ID = $archivo->id();

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
				echo "error";
			}



			?>

		
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>