<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Usuario {

  public static function login($username, $password) {
    $user = self::buscaUsuario($username);
    if ($user && $user->compruebaPassword($password)) {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT R.nombre FROM RolesUsuario RU, Roles R WHERE RU.rol = R.id AND RU.usuario=%s", $conn->real_escape_string($user->id));
      $rs = $conn->query($query);
      if ($rs) {
        while($fila = $rs->fetch_assoc()) { 
          $user->addRol($fila['nombre']);
        }
        $rs->free();
      }
      return $user;
    }    
    return false;
  }

  public static function buscaUsuario($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM usuarios WHERE username='%s'", $conn->real_escape_string($username));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['id'], $fila['username'], $fila['password'], $fila['Email'], $fila['Descripcion']);
      $rs->free();

      return $user;
    }
    return false;
  }
 
  private $id;

  private $username;

  private $password;

  private $roles;

 private $descripcion;
 
 private $email;

  private function __construct($id, $username, $password, $descripcion, $email) {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->roles = [];
    $this->descripcion = $descripcion;
    $this->email = $email;
  }

  public function id() {
    return $this->id;
  }

  public function addRol($role) {
    $this->roles[] = $role;
  }

  public function roles() {
    return $this->roles;
  }

  public function username() {
    return $this->username;
  }
  public function email()
{
	return $this->email;
}
  public function descripcion()
{
	return $this->descripcion;
}


  public function compruebaPassword($password) {
    return password_verify($password, $this->password);
  }

  public function cambiaPassword($nuevoPassword) {
    $this->password = password_hash($nuevoPassword, PASSWORD_DEFAULT);
  }
}
