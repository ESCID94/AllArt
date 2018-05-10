<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;


class Archivo
{

	private $id;

	private $nombre;

	private $descripcion;

	private $autor;

	private $destacado;

	private $punt;

	private $ruta;

	private $precio;


	private function __construct($id, $nombre,$descripcion,  $autor, $dest, $puntuacion, $ruta, $precio)
	{
		$this->id = $id;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->autor = $autor;
		$this->destacado = $dest;
		$this->punt = $puntuacion;
		$this->ruta = $ruta;
		$this->precio = $precio;
	}







		public static function buscarImagenDest($idAutor)
	{
		$app = App::getSingleton();
   		$conn = $app->conexionBd();
    	$query = sprintf("SELECT * FROM archivo A WHERE A.autor='%s'AND A.imgDest = 1", $conn->real_escape_string($idAutor));
		$rs = $conn->query($query);



    	if ($rs && $rs->num_rows == 1) 
    	{
    		$fila = $rs->fetch_assoc();
      		$img = new archivo($fila['id'], $fila['nombre'],$fila['Descripcion'], $fila['autor'], $fila['imgDest'], $fila['punt'], $fila['ruta'],$fila['Precio']);
      		$rs->free();

      		return $img;
    	}
    	return false;
	}


	public static function buscarMejoresArch($idAutor)
 	{
 		$app = App::getSingleton();
   		$conn = $app->conexionBd();
    	$query = sprintf("SELECT * FROM archivo A WHERE A.autor='%s' ORDER BY A.punt ASC", $conn->real_escape_string($idAutor));
		$rs = $conn->query($query);

		if ($rs)
		{
			$archivos = array();


			while($row = $rs->fetch_assoc()) 
			{
   				$results[] = $row;
			}
			return $results;
		}
		return false;
 	}

 	public static function buscaArchivo($idArchivo)
 	{
 		$app = App::getSingleton();
   		$conn = $app->conexionBd();
    	$query = sprintf("SELECT * FROM archivo A WHERE A.id='%s'", $conn->real_escape_string($idArchivo));
		$rs = $conn->query($query);


		if ($rs)
		{
			$fila = $rs->fetch_assoc();
			echo $fila['punt'];
      		$arch = new archivo($fila['id'], $fila['nombre'],$fila['Descripcion'], $fila['autor'], $fila['imgDest'], $fila['punt'], $fila['ruta'],$fila['Precio']);
      		$rs->free();

      		return $arch;
		}
		return false;
 	}

 	public function autor()
 	{
 		$user = Usuario::buscaUsuarioById($this->autor);

 		return $user->username();
 	}



	public function ruta()
  	{
  	  return $this->ruta;
 	}
 	public function nombre()
 	{
 		return $this->nombre;
 	}
 	public function descripcion()
 	{
 		return $this->descripcion;
 	}
 	public function puntuacion()
 	{
 		return $this->punt;
 	}
 	public function destacado()
 	{
 		return $this->destacado;
 	}
 	public function precio()
 	{
 		return $this->precio;
 	}
 	public function id()
 	{
 		return $this->id;
 	}
}


?>