<?php


require_once __DIR__.'/includes/config.php';

$mysqli = new mysqli("localhost", "admin", "foo2aipheCah", "allart");

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
$app->doInclude('comun/cabecera.php');
$app->doInclude('comun/sidebarIzq.php');
?>
	<div id="contenido">
    	<?php	 
	
	$consulta="SELECT username, imagenPerfil FROM usuarios WHERE rol='patrocinador'"; 
	if ($resultado = $mysqli->query($consulta)) {
   	while ($fila = $resultado->fetch_assoc()) {
        
		$ruta = $fila["imagenPerfil"];
		$username = $fila["username"];
  		echo '<a href="verPerfilPatrocinador.php?usuario='.$username .'"><img src='.$ruta.' /> </a>';
 	
		printf ("%s  \n", $fila["username"]  );
  	echo "<br>";
	echo "<br>";
	

    }

    /* liberar el conjunto de resultados */
    $resultado->free();
}




	?>
	</div>
<?php
$app->doInclude('comun/pie.php');
?>
</div>
</body>
</html>
