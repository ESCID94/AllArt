<?php

namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';


?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/style.css') ?>" />
  <title>Perfil</title>
</head>
<body>
<div id="contenedor">
<?php
$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">
    	<?php
    		$username = $_SESSION['username'];
    		$user = Usuario::buscaUsuario($username);
    		$idFollow = Usuario::buscarFollows($user->id());
    		if ($idFollow !== NULL)
    		{
    			$ite = 0;
    			foreach ($idFollow as $key => $value) {
    				$id = $idFollow[$key]['idFollow'];
    				$usuarioFollow = Usuario::buscaUsuarioById("$id");
    				$ite++;
	  				echo "<img src= '" . $usuarioFollow->imgPerfil() . "' border='0' width='100' height='100'>";
					//echo 'Nombre: ' . $usuarioFollow->username(); <a href='${perfilUrl}'>($usuarioFollow->username())</a>
					$username = $usuarioFollow->username();
					//echo "<a href="verPerfil.php?username=$username">$username</a>";
					echo "<a href=\"verPerfil.php?usuario=" .$username . "\">" . $username .  "</a>";
					echo "</br>";

				
				}
    		}
    		else
    		{
    			echo "No sigues a nadie";
    		}
		?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>