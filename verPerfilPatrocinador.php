<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';


?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <title>Perfil</title>
</head>
<body>
<div id="contenedor">
<?php

$nombreUsuario=htmlspecialchars(trim(strip_tags($_GET['usuario'])));

$usuario=Usuario::buscaUsuario($nombreUsuario);

$app->doInclude('comun/cabecera.php');
//$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">
    	<?php
	    echo "<h2>Patrocinador:</h2>";
		echo "<img src= '" . $usuario->imgPerfil() . "' border='0' width='100' height='100'>";
		echo "</br>";
		echo 'Nombre: ' . $usuario->username();
		echo "</br>";
		echo "Email: " . $usuario->email();
		echo "</br>";
		echo "Descripcion: " . $usuario->descripcion();
		echo "</br></br><h2>Usuarios patrocinados:</h2>";
		

                $usuarios = Usuario::buscaUsuariosPatrocinados($usuario->id());
			    if ($usuarios !== FALSE)
			    {
				    foreach($usuarios as $usu)
				    {
					    $usuario = Usuario::buscaUsuarioById($usu);
					    if($usuario!=false) {
                            $mostradorUsuario = new \es\ucm\fdi\aw\MostradorUsuario($usuario);
                            echo $mostradorUsuario->mostrar() . "</br>";
                        }
				    }
			    } 


			
		?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
