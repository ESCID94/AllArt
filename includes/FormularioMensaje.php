<?php

namespace es\ucm\fdi\aw;

class FormularioMensaje extends Form {

  public function __construct() {
    parent::__construct('formMensaje');
  }
  
  protected function generaCamposFormulario ($datos) {
    $mensaje = 'Mensaje';
    if ($datos) {
      $mensaje = isset($datos['mensaje']) ? $datos['mensaje'] : $mensaje;
    }

    $maxSize = Mensaje::MAX_SIZE;
    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Nuevo mensaje</legend>
		  <p><label>Mensaje:</label> <input type="text" name="mensaje" value="$mensaje" maxlength="$maxSize"/></p>
		  <button type="submit">Añadir</button>
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
    $mensaje = isset($datos['mensaje']) ? $datos['mensaje'] : null ;
    if ( ! $mensaje ||  mb_strlen($mensaje) == 0 || mb_strlen($mensaje) > 140 ) {
      $result[] = 'La longitud del mensaje debe ser entre 1 o 140 caracteres.';
      $ok = false;
    }

    if ( $ok ) {
      $app = Aplicacion::getSingleton();
      $mensaje = Mensaje::crea($app->nombreUsuario(), $mensaje);
      if ( $mensaje ) {
        $result = $app->resuelve('/mensajes.php');
      }else {
        $result[] = 'No se ha podido añadir el mensaje.';
      }
    }
    return $result;
  }
}
