<?php

namespace es\ucm\fdi\aw;

class FormularioModPerfil extends Form {

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public function __construct() {
    parent::__construct('formModPerfil');
  }
  
  protected function generaCamposFormulario ($datos) {
//TO-DO?: Cambiar coger estos datos de la sesión por cogerlos de Usuario.php?¿
    $username = $_SESSION['username'];
    $Email = $_SESSION['email'];
    $Descripcion = $_SESSION['descripcion'];
    $FechaNac = $_SESSION['fechaNac'];

    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Perfil</legend>
		  <p><label>Name:</label> <input type="text" name="username" value="$username"></p> 
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
    $username = isset($datos['username']) ? $datos['username'] : null ;
    if ( !$username ) {
        $result[] = 'El nombre de usuario no es válido';
        $ok = false;
    } elseif ((Aplicacion::getSingleton()->nombreUsuario() !== $datos['username']) && Usuario::buscaUsuario($datos['username'])) { //Comprueba que el nombre de usuario es único en la aplicación
        $result[] = 'El nombre de usuario ya está en uso';
        $ok = false;
    } elseif ((Aplicacion::getSingleton()->emailUsuario() !== $datos['Email']) && Usuario::buscaEmail($datos['Email'])) { //Comprueba que el correo es único en la aplicación
        $result[] = 'El correo electrónico ya está en uso';
        $ok = false;
    }
    
    if(!$ok){ 
        $result[] = 'No se ha completado la modificación del perfil';
    }
    else{
        $user = Usuario::modPerfil($datos['username'],$datos['Email'],$datos['FechaNac'],$datos['Descripcion']);
        Aplicacion::getSingleton()->modPerfil($user);
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/Perfil.php');
    }
    return $result;
  }
}
