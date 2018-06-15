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
	if($_POST['buscar']){
		$buscar = $_POST["palabra"];

		$query = "SELECT * FROM archivos WHERE titulo like '%$buscar%'";
		$resultado = $mysqli->query($query);
		while($registro = $resultado->fetch_assoc()){
			echo "$registro[titulo]";
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
