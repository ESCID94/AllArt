<?php

namespace es\ucm\fdi\aw;

class Aplicacion {

  private static $instancia;

  private $bdDatosConexion;

  private $rutaRaizApp;

  private $dirInstalacion;

  public static function getSingleton() {
      if (  !self::$instancia instanceof self) {
         self::$instancia = new self;
      }
      return self::$instancia;
  }

  private function __construct() {
  }

  public function init($bdDatosConexion, $rutaRaizApp, $dirInstalacion){
    $this->bdDatosConexion = $bdDatosConexion;

    $this->rutaRaizApp = $rutaRaizApp;
    $tamRutaRaizApp = mb_strlen($this->rutaRaizApp);
    if ($tamRutaRaizApp > 0 && $this->rutaRaizApp[$tamRutaRaizApp-1] !== '/') {
      $this->rutaRaizApp .= '/';
    }

    $this->dirInstalacion = $dirInstalacion;
    $tamDirInstalacion = mb_strlen($this->dirInstalacion);
    if ($tamDirInstalacion > 0 && $this->dirInstalacion[$tamDirInstalacion-1] !== '/') {
      $this->dirInstalacion .= '/';
    }

    $this->conn = null;
    session_start();
  }

  public function resuelve($path = '') {
    if (strlen($path) > 0 && $path[0] == '/') {
      $path = mb_substr($path, 1);
    }
    return $this->rutaRaizApp . $path;
  }

  public function doInclude($path = '') {
    if (strlen($path) > 0 && $path[0] == '/') {
      $path = mb_substr($path, 1);
    }
    include($this->dirInstalacion . '/'.$path);
  }

  public function login(Usuario $user) {
    $_SESSION['login'] = true;
    $_SESSION['nombre'] = $user->username();
    $_SESSION['roles'] = $user->roles();
  }

  public function logout() {
    //Doble seguridad: unset + destroy
    unset($_SESSION["login"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["roles"]);


    session_destroy();
    session_start();
  }

  public function usuarioLogueado() {
    return isset($_SESSION["login"]) && ($_SESSION["login"]===true);
  }

  public function nombreUsuario() {
    return isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
  }

  public function conexionBd() {
    if (! $this->conn ) {
      $bdHost = $this->bdDatosConexion['host'];
      $bdUser = $this->bdDatosConexion['user'];
      $bdPass = $this->bdDatosConexion['pass'];
      $bd = $this->bdDatosConexion['bd'];

      $this->conn = new \mysqli($bdHost, $bdUser, $bdPass, $bd);
      if ( $this->conn->connect_errno ) {
        echo "Error de conexión a la BD: (" . $this->conn->connect_errno . ") " . utf8_encode($this->conn->connect_error);
        exit();
      }
      if ( ! $this->conn->set_charset("utf8mb4")) {
        echo "Error al configurar la codificación de la BD: (" . $this->conn->errno . ") " . utf8_encode($this->conn->error);
        exit();
      }
    }
    return $this->conn;
  }

  public function tieneRol($rol, $cabeceraError=NULL, $mensajeError=NULL) {
    if (!isset($_SESSION['roles']) || ! in_array($rol, $_SESSION['roles'])) {
      if ( !is_null($cabeceraError) && ! is_null($mensajeError) ) {
        $bloqueContenido=<<<EOF
<h1>$cabeceraError!</h1>
<p>$mensajeError.</p>
EOF;
        echo $bloqueContenido;
      }

      return false;
    }

    return true;
  }
}
