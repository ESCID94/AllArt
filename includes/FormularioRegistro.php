

<?php

//Modificado

namespace es\ucm\fdi\aw;

class FormularioRegistro extends Form {

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public function __construct() {
    parent::__construct('formLogin');
  }
  
  protected function generaCamposFormulario ($datos) {
  

    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Usuario y contraseña</legend>
		  <p><label>Name:</label> <input type="text" name="username"></p> 
		  <p><label>Password:</label> <input type="password" name="password" ><br /></p>
		  <p><label>Email:</label> <input type="text" name="Email" ><br /></p>
		  <p><label>Descripcion:</label> <input type="text" name="Descripcion" ><br /></p>
		  <button type="submit">Registrarse</button>
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
  
      $ok = Usuario::registro($username, $password,$email,$descripcion);
      if(!$ok){
		  
		  $result[] = 'No se ha completado el registro';
		  
		  )
		  else{
		 $user = Usuario::login($username, $password);	  
		 
	  if ( $user ) {
		  
        // SEGURIDAD: Forzamos que se genere una nueva cookie de sesión por si la han capturado antes de hacer login
        session_regenerate_id(true);
        Aplicacion::getSingleton()->login($user);
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/index.php');
      }
		  }
    return $result;
  }
}
