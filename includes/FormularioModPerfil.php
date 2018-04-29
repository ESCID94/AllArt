<?php

namespace es\ucm\fdi\aw;

class FormularioModPerfil extends Form {

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public function __construct() {
    parent::__construct('formMod');
  }
  
  protected function generaCamposFormulario ($datos) {
 
    $username = $_SESSION[username];
    $password = $_SESSION[password];
    $Email = $_SESSION[email];
    $Descripcion = $_SESSION[descripcion];
    $FechaNac = $_SESSION[fechaNac];

   /* if ($datos) {
      $username = isset($datos['username']) ? $datos['username'] : $username;
      $password = isset($datos['password']) ? $datos['password'] : $password;
      $Email = isset($datos['password']) ? $datos['password'] : $password;
    }*/


    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Registro</legend>
		  <p><label>Name:</label> <input type="text" name="username" value="$username"></p> 
		  <p><label>Password:</label> <input type="password" name="password" ><br /></p>
		  <p><label>Email:</label> <input type="text" name="Email" value="$Email" ><br /></p>
      <p><label>Fecha nacimiento:</label><input type="date" name="FechaNac" value="$FechaNac" ><br /></p>
		  <p><label>Descripcion:</label> <input type="text" name="Descripcion" value="$Descripcion"><br /></p>
		  <button type="submit">Guardar cambios</button>
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
    $ok = Usuario::modPerfil($datos['username'], $datos['password'],$datos['Email'],$datos['FechaNac'],$datos['Descripcion']);
    if(!$ok)
    { 
		  $result[] = 'No se ha completado el registro';
    }
	 /*else
	 {
	   $user = Usuario::login($username, $password);	  
	   if ( $user ) 
	   {	  
        // SEGURIDAD: Forzamos que se genere una nueva cookie de sesión por si la han capturado antes de hacer login
        session_regenerate_id(true);
        Aplicacion::getSingleton()->login($user);
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/index.php');
     	}
    }*/
    return $result;
  }
}
