<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

	<?php
		
		$usu = $_GET["usu"];
		$con = $_GET["con"];
		$perfil = $_GET["perfil"];
		
		
		 require ("datos_conexion.php");
		 
		 $conexion=mysqli_connect($db_host, $db_usuario, $db_contra);
			
		 if(mysqli_connect_errno()){
			
			echo "Fallo al conectar con la BBDD";
			
			exit();
		}
		
		mysqli_select_db($conexion,$db_nombre) or die ("No se encuentra la BBDD");
		
		mysqli_set_charset($conexion, "utf8");
		 
		$sql="INSERT INTO PERFILUSUARIOS (USUARIO, PASSWORD, PERFIL) VALUES (?,?,?)";
		
		$resultado=mysqli_prepare($conexion, $sql);
		
		$ok=mysqli_stmt_bind_param($resultado, "sss", $usu, $con, $perfil);
		
		$ok=mysqli_stmt_execute($resultado);
		
		if($ok==false){
			
			echo "Error al ejecutar la consulta";
			
		}else{
			
			
			echo "Agregado nuevo registro";
			
			
			mysqli_stmt_close($resultado);
		}
		 
		
		
		 
		 
		 
	
	?>


</body>
</html>