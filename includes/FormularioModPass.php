<?php

namespace es\ucm\fdi\aw;

class FormularioModPass extends Form {


  public function __construct() {
    parent::__construct('formMod');
  }
  
  protected function generaCamposFormulario ($datos) {
 
     $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Cambiar contraseña</legend>
		  <p><label>Contraseña actual:</label> <input type="password" name="actualPass"></p> 
		  <p><label>Nueva contraseña:</label> <input type="password" name="nuevaPass" ><br /></p>
          <p><label>Repetir nueva contraseña:</label><input type="password" name="nuevaPassRep" ><br /></p>
		  <button type="submit">Confirmar</button>
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
    $actualPass = isset($datos['actualPass']) ? $datos['actualPass'] : null ;
    $user = Usuario::buscaUsuario(Aplicacion::getSingleton()->nombreUsuario());
    $nuevaPass = isset($datos['nuevaPass']) ? $datos['nuevaPass'] : null ;
    $nuevaPassRep = isset($datos['nuevaPassRep']) ? $datos['nuevaPassRep'] : null ;

    if ( ! $actualPass ||  mb_strlen($actualPass) < 4 ) { //Evalúa si la contraseña actual introducida es un valor válido
        $result[] = 'La contraseña actual introducida no es válida';
        $ok = false;
    } elseif(!$user->compruebaPassword($actualPass)){ //Comprueba si la contraseña actual introducida es correcta
        $result[] = 'La contraseña actual introducida es incorrecta';
        $ok = false;
    } elseif(! $nuevaPass){ //Comprobar que la nueva contraseña es válida
        $result[] = 'El primer campo "nueva contraseña" no es válido';
        $ok = false;
    } elseif(! $nuevaPassRep){ //Comprobar que la nueva contraseña es válida
        $result[] = 'El segundo campo "nueva contraseña" no es válido';
        $ok = false;
    } elseif ( $nuevaPass !== $nuevaPassRep) { //Comprobar que la nueva contraseña se ha introducida igual en los dos campos
        $result[] = 'Los campos "nueva contraseña" no coinciden';
        $ok = false;
    }
    
    if(!$ok)
    { 
        $result[] = 'No se ha completado el cambio de contraseña';
    }
    else{
        $user = Usuario::modPass($nuevaPass);
        //$result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/Perfil.php');
    }
    return $result;
  }
}
