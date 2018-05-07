<?php

namespace es\ucm\fdi\aw;

class FormularioLogin extends Form {

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public function __construct() {
    parent::__construct('formLogin');
  }
  
  protected function generaCamposFormulario ($datos) {
    $username = 'user@example.org';
    $password = '12345';
    if ($datos) {
      $username = isset($datos['username']) ? $datos['username'] : $username;
      $password = isset($datos['password']) ? $datos['password'] : $password;
    }

    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Usuario y contraseña</legend>
		  <p><label>Name:</label> <input type="text" name="username" value="$username"/></p>
		  <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
		  <button type="submit">Entrar</button>
		</fieldset>
EOF;
    return $camposFormulario;
  }

  /**
   * Procesa los datos del formulario.
   */
  protected function procesaFormulario($datos) {
    $result = array();
    $ok = true;
    $username = isset($datos['username']) ? $datos['username'] : null ;
    if ( !$username ) {
        $result[] = 'El nombre de usuario no es válido';
        $ok = false;
    }

    $password = isset($datos['password']) ? $datos['password'] : null ;
    if ( ! $password ||  mb_strlen($password) < 4 ) {
      $result[] = 'La contraseña no es válida';
      $ok = false;
    }

    if ( $ok ) {
      $user = Usuario::login($username, $password);
      //echo '$user';
      if ( $user ) {
        // SEGURIDAD: Forzamos que se genere una nueva cookie de sesión por si la han capturado antes de hacer login
        session_regenerate_id(true);
        Aplicacion::getSingleton()->login($user);
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/home.php');

      }else {
        $result[] = 'El usuario o la contraseña es incorrecta';
      }
    }
    return $result;
  }
}
