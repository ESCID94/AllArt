<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Usuario {

  public static function login($username, $password) {
    $user = self::buscaUsuario($username);
    if ($user && $user->compruebaPassword($password)) {
      $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT R.nombre FROM rolesusuario RU, roles R WHERE RU.rol = R.id AND RU.usuario=%s", $conn->real_escape_string($user->id));
      $rs = $conn->query($query);
      if ($rs) {
       // while($fila = $rs->fetch_assoc()) { 
        //  $user->addRol($fila['nombre']);
        //}
        $rs->free();
      }
      return $user;
    }
    return false;
  }

public static function registro($username, $password,$email,$fechaNac,$descripcion)
  {
    $buscarUsuario = "SELECT * FROM usuarios WHERE username = '$_POST[username]' ";
    $app = App::getSingleton();
    $conn = $app->conexionBd();
	  /*$result = $conn->query($buscarUsuario);
	  $count = mysqli_num_rows($result);*/
	  
      //if ($count >= 1)
      if(self::buscaUsuario($username))
	  {
		  echo "<br />". "El Nombre de Usuario ya ha sido tomado." . "<br />";
	  }
      elseif (self::buscaEmail($email)){ //Comprobar que no se ha registrado otro usuario con el mismo email
          echo "<br />". "El Email ya ha sido tomado." . "<br />";
      }
	  else
	  {
		  //$pass = password_hash($password, PASSWORD_DEFAULT);      
		  //$reg = "INSERT INTO usuarios(username, password, Email, FechaNac, Descripcion) VALUES ($username, $pass, $email, $fechaNac, $descripcion)"; 
      $reg = sprintf("INSERT INTO usuarios(username, password,Email,FechaNac, Descripcion, imagenPerfil) VALUES('%s', '%s', '%s', '%s', '%s', '%s')"
          , $conn->real_escape_string($username)
          , password_hash($password, PASSWORD_DEFAULT)
          , $conn->real_escape_string($email)
          , $fechaNac
          , $conn->real_escape_string($descripcion)
          , 'img/imgBasica.jpg');
      if ($conn->query($reg)=== TRUE)
		  {
			 echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
		  }
      else
      {
        echo "Error al configurar la codificación de la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
      }
	  }
	  return $conn;
  }

  public static function buscaUsuario($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM usuarios WHERE username='%s'", $conn->real_escape_string($username));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['id'], $fila['username'], $fila['password'], $fila['Descripcion'], $fila['Email'],$fila['FechaNac'], $fila['imagenPerfil']);
      $rs->free();

      return $user;
    }
    return false;
  }

  public static function buscaEmail($email) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM usuarios WHERE Email='%s'", $conn->real_escape_string($email));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['id'], $fila['username'], $fila['password'], $fila['Descripcion'], $fila['Email'],$fila['FechaNac'], $fila['imagenPerfil']);
      $rs->free();

      return $user;
    }
    return false;
  }

  public static function modPerfil ($username,$email,$fechaNac,$descripcion)
  {
    $user = self::buscaUsuario($_SESSION['username']);
    if ($user) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();

        $reg = sprintf("UPDATE usuarios U SET username='%s', Descripcion='%s', Email='%s', FechaNac='%s' WHERE '%s' = U.id"
        , $conn->real_escape_string($username)
        , $conn->real_escape_string($descripcion)
        , $conn->real_escape_string($email)
        , $fechaNac
        , $conn->real_escape_string($user->id) );


        if ($conn->query($reg)=== TRUE)
        {
            $user->username=$username;
            $user->descripcion=$descripcion;
            $user->email=$email;
            $user->fechaNac=$fechaNac;
            echo "<br />" . "<h2>" . "Usuario modificado exitosamente!" . "</h2>";
        }
        else
        {
            echo "Error: (" . $conn->errno . ") ";
            return false;
        }
        return $user;
    }
    else {
        //error fatal: usuario no encontrado
        return false;
    }
  }
 

  public static function modPass ($nuevaPass)
  {
    $user = self::buscaUsuario($_SESSION['username']);
    if ($user) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();

        //$pass = password_hash($nuevaPass, PASSWORD_DEFAULT); 
        $reg = sprintf("UPDATE usuarios U SET password='%s' WHERE '%s' = U.id"
        , password_hash($nuevaPass, PASSWORD_DEFAULT)
        , $conn->real_escape_string($user->id) );


        if ($conn->query($reg) === TRUE)
        {
            $user->password = password_hash($nuevaPass, PASSWORD_DEFAULT);
            echo "<br />" . "<h2>" . "Contraseña modificada exitosamente!" . "</h2>";
        }
        else
        {
            echo "Error: (" . $conn->errno . ") ";
            return false;
        }
        return $user;
    }
    else {
        //error fatal: usuario no encontrado
        return false;
    }
  }

  public static function modImagen ($nuevaImagen)
  {
    $user = self::buscaUsuario($_SESSION['username']);
    if ($user) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();

        //TO-DO: Introducir funcionalidad

        /*$reg = sprintf("UPDATE usuarios U SET password='%s' WHERE '%s' = U.id"
        , password_hash($nuevaPass, PASSWORD_DEFAULT)
        , $conn->real_escape_string($user->id) );


        if ($conn->query($reg) === TRUE)
        {
            $user->password = password_hash($nuevaPass, PASSWORD_DEFAULT);
            echo "<br />" . "<h2>" . "Contraseña modificada exitosamente!" . "</h2>";
        }
        else
        {
            echo "Error: (" . $conn->errno . ") ";
            return false;
        }*/
        return $user;
    }
    else {
        //error fatal: usuario no encontrado
        return false;
    }
  }

  private $id;

  private $username;

  private $password;

  private $roles;

  private $descripcion;
 
  private $email;

  private $fechaNac;

  private $imgPerfil;

  private function __construct($id, $username, $password, $descripcion, $email,$fechaNac, $imgPerfil) {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->roles = [];
    $this->descripcion = $descripcion;
    $this->email = $email;
    $this->fechaNac = $fechaNac;
    $this->imgPerfil = $imgPerfil;
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

  public function imgPerfil()
  {
    return $this->imgPerfil;
  }

  public function fechaNac()
  {
    return $this->fechaNac;
  }

  public function compruebaPassword($password) {
    return password_verify($password, $this->password);
  }

  /*public function cambiaPassword($nuevoPassword) {
    $this->password = password_hash($nuevoPassword, PASSWORD_DEFAULT);
  }*/
}
