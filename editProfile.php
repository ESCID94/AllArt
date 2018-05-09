<?php


require_once __DIR__.'/config.php';
require_once __DIR__.'/formlib.php';

namespace es\ucm\fdi\aw;

   
 /**
 	* Editar a la base de datos de AllArt
 */              
<?php          		
    $sql = "SELECT * FROM user where user_username='$user_username'";   
    $result = mysqli_query($database,$sql) or die(mysqli_error($database)); 
    $rws = mysqli_fetch_array($result);
?>             



class editProfile extends Form {

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public function __construct() {
    parent::__construct('formLogin');
  }
  
  protected function generaCamposFormulario ($datos) {
    $username = 'user@example.org';
    $password = '12345';
    $email = 'user@example.org' 
    if ($datos) {
      $username = isset($datos['username']) ? $datos['username'] : $username;
      $password = isset($datos['password']) ? $datos['password'] : $password;
      $email = isset($datos['email']) ? $datos['email'] : $email;
    }

    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Usuario y contraseña</legend>
		  <p><label>Name:</label> <input type="text" name="username" value="$username"/></p>
		  <p><label>Password:</label> <input type="password" name="password" value="$password"/><br /></p>
		  <p><label>Email:</label> <input type="email" name="email" value="$email"/><br /></p>
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
    if ( !$username || ! mb_ereg_match(self::HTML5_EMAIL_REGEXP, $username) ) {
      $result[] = 'El nombre de usuario no es válido';
      $ok = false;
    }

    $password = isset($datos['password']) ? $datos['password'] : null ;
    if ( ! $password ||  mb_strlen($password) < 4 ) {
      $result[] = 'La contraseña no es válida';
      $ok = false;
    }

    $email = isset($datos['email']) ? $datos['email'] : null ;
    if ( ! $email ||  !filter_var($email, FILTER_VALIDATE_EMAIL)) { 
      $result[] = 'El email no es válido';
      $ok = false;
    }

    if ( $ok ) {
      $user = Usuario::login($username, $password);
      if ( $user ) {
        // SEGURIDAD: Forzamos que se genere una nueva cookie de sesión por si la han capturado antes de hacer login
        session_regenerate_id(true);
        Aplicacion::getSingleton()->login($user);
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/index.php');
      }else {
        $result[] = 'El usuario o la contraseña es incorrecta';
      }
    }
    return $result;
  }
}
