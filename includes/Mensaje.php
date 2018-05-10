<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;
use es\ucm\fdi\aw\Usuario as Usuario;

class Mensaje {

  const MAX_SIZE = 140;

  public static function crea($username, $mensaje, $respuestaAMensaje = NULL) {
    $user = Usuario::buscaUsuario($username);
    if ($user) {
      $m = new Mensaje($user->username(), $user->id(), $mensaje, $respuestaAMensaje);
      $m = self::guarda($m);
      return $m;
    }    
    return false;
  }

  public static function mensajes($idMensajePadre=NULL) {
    $result = [];
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = "SELECT M.id, U.id AS usuario, U.username, M.mensaje, M.idMensajePadre FROM Mensajes M, Usuarios U WHERE U.id = M.usuario";
    if($idMensajePadre) {
      $query = $query . ' AND M.idMensajePadre = %s';
      $query = sprintf($query, $conn->real_escape_string($idMensajePadre));
    }
    $rs = $conn->query($query);
    if ($rs) {
      while($fila = $rs->fetch_assoc()) {
        $result[] = new Mensaje($fila['username'], $fila['usuario'], $fila['mensaje'], $fila['idMensajePadre'], $fila['id']);
      }
      $rs->free();
    }
    return $result;
  }

  public static function mensaje($idMensaje) {
    $result = null;
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf('SELECT M.id, U.id AS usuario, U.username, M.mensaje, M.idMensajePadre FROM Mensajes M, Usuarios U WHERE U.id = M.usuario AND M.id = %s;', $conn->real_escape_string($idMensaje));
    $rs = $conn->query($query);
    if ($rs && $rs->row_count == 1) {
      while($fila = $rs->fetch_assoc()) {
        $result = new Mensaje($fila['username'], $fila['usuario'], $fila['mensaje'], $fila['idMensajePadre'], $fila['id']);
      }
      $rs->free();
    }
    return $result;
  }

  public static function guarda($mensaje) {
    $result = false;
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("INSERT INTO Mensajes (usuario, mensaje, idMensajePadre) VALUES (%s, '%s', %s)", $conn->real_escape_string($mensaje->usuario), $conn->real_escape_string($mensaje->mensaje), !is_null($mensaje->idMensajePadre)?$mensaje->idMensajePadre : 'NULL');
    print_r($query);
    $result = $conn->query($query);
    if ($result) {
      $mensaje->id = $conn->insert_id;
      $result = $mensaje;
    } else {
      error_log($conn->error);  
    }

    return $result;
  }

  private $id;

  private $usuario;

  private $username;

  private $mensaje;

  private $idMensajePadre;

  private function __construct($username, $usuario, $mensaje, $idMensajePadre, $id = NULL) {
    $this->id = $id;
    $this->usuario = $usuario;
    $this->username = $username;
    $this->mensaje = $mensaje;
    $this->idMensajePadre = $idMensajePadre;
  }

  public function id() {
    return $this->id;
  }

  public function username() {
    return $this->username;
  }

  public function texto() {
    return $this->mensaje;
  }

  public function idMensajePadre() {
    return $this->idMensajePadre;
  }

  public function __get($name) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }
}
