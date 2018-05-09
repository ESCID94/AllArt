<?php

namespace es\ucm\fdi\aw;

class FormularioRespuesta extends Form {

  private $idMensajePadre;

  public function __construct($idMensajePadre) {
    parent::__construct('formRespuesta'.$idMensajePadre);
    $this->idMensajePadre = $idMensajePadre;
  }
  
  protected function generaCamposFormulario ($datos) {
    $mensaje = 'Mensaje';
    if ($datos) {
      $mensaje = isset($datos['mensaje']) ? $datos['mensaje'] : $mensaje;
    }

    $maxSize = Mensaje::MAX_SIZE;
    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Respuesta</legend>
		  <p><label>Respuesta:</label> <input type="text" name="mensaje" value="$mensaje" maxlength="$maxSize"/></p>
		  <button type="submit">Responder</button>
          <input type="hidden" name="idMensajePadre" value="$this->idMensajePadre" />
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
    $idMensajePadre = isset($datos['idMensajePadre']) ? $datos['idMensajePadre'] : null ;
    if ( ! $idMensajePadre) {
      $result[] = 'No se ha podido añadir la respuesta.';
      $ok = false;
    }

    if ( $ok ) {
      $app = Aplicacion::getSingleton();
      $mensaje = Mensaje::crea($app->nombreUsuario(), $mensaje, $idMensajePadre);
      if ( $mensaje ) {
        $result = $app->resuelve('/mensajes.php');
      }else {
        $result[] = 'No se ha podido añadir el mensaje.';
      }
    }
    return $result;
  }
}
