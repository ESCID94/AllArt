<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;


class Archivo
{

	private $id;

	private $nombre;

	private $autor;

	private $destacado;

	private $punt;

	private $ruta;


	private function __construct($id, $nombre, $autor, $dest, $puntuacion, $ruta)
	{
		$this->id = $id;
		$this->nombre = $nombre;
		$this->autor = $autor;
		$this->destacado = $dest;
		$this->punt = $puntuacion;
		$this->ruta = $ruta;
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
      		$img = new archivo($fila['id'], $fila['nombre'], $fila['autor'], $fila['imgDest'], $fila['punt'], $fila['ruta']);
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


	public function ruta()
  	{
  	  return $this->ruta;
 	}



}


?>