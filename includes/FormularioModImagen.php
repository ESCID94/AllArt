<?php

namespace es\ucm\fdi\aw;

class FormularioModImagen extends Form {

  const HTML5_EMAIL_REGEXP = '^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$';

  public function __construct() {
    parent::__construct('formMod');
  }
  
  protected function generaCamposFormulario ($datos) {
$camposFormulario=<<<EOF
		<fieldset>
		  <legend>Cambiar imagen de Perfil</legend>
		  <p><label>Subir imagen:</label> <input type="file" name="nuevaImagen"></p> 
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
    
    $_FILES['nuevaImagen']['tmp_name']
    

    if ( $_FILES['nuevaImagen']['type'] !== 'image/png' ) { //Comprueba que el tipo de archivo es una imagen png
        $result[] = 'El archivo no es una imagen png';
        $ok = false;
    }
    
    
    if(!$ok){ 
        $result[] = 'No se ha completado la modificación de la imagen del perfil';
    }
    else{
        //TO-DO: Cambiar ubicación de archivo y nombre
        $user = Usuario::modImagen($user,$imagen); //modificar
        Aplicacion::getSingleton()->modImagen($user,$imagen); //modificar
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/Perfil.php');
    }
    return $result;
  }
}
