<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Comentario {

  private $id;

  private $texto;

  private $autor;

  private $fecha;

  private $idArchivo;

  private function __construct($id,$texto,$autor,$fecha,$idArchivo) {
    $this->id = $id;
    $this->texto = $texto;
    $this->autor = $autor;
    $this->fecha = $fecha;
    $this->idArchivo = $idArchivo;
  }

   public function __toString()
    {
      return $this->texto . ' ' . $this->autor. ' ' . $this->fecha;
    }

  public static function verComentarios($idArchivo)
  {
    $app = App::getSingleton();
    $conn = $app->conexionBd();

    $query = sprintf("SELECT * FROM comentario C  WHERE C.idArchivo = %s ORDER BY C.Fecha ASC" , $conn->real_escape_string($idArchivo));

    $rs = $conn->query($query);

    if ($rs && $rs->num_rows > 0)
    {
     while($row = $rs->fetch_assoc()) 
      {
          $results[] = $row;
      }
      return $results;
    }
    return false;
  }

  public static function crearComentario($username, $texto, $idArchivo)
  {
    $app = App::getSingleton();
    $conn = $app->conexionBd();


    $fecha = date("Y-m-d H:i:s");
    echo $fecha;
    $user = Usuario::buscaUsuario($username);



    $usuario = $user->id();


     $reg = sprintf("INSERT INTO comentario(`Texto`, `Autor`, `Fecha`, `idArchivo`)VALUES( '%s', '%s', '%s', '%s')"
          , $conn->real_escape_string($texto)
          , $conn->real_escape_string($usuario)
          , $fecha
          , $idArchivo);

     if ($conn->query($reg))
     {
      echo "Comentario creado exitosamente";
     }
     else
     { echo "Error al configurar la codificación de la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);}

     return $conn;
  }

  public function id() {
    return $this->id;
  }

 
  public function texto() {
    return $this->texto;
  }

  public function autor(){
    return $this->autor;
  }

  public function fecha(){
	  return $this->fecha;
  }

  public function idArchivo(){
    return $this->idArchivo;
  }
}
