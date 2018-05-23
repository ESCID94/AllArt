<?php

//Modificado

namespace es\ucm\fdi\aw;

class FormularioComentario extends Form {

  private $idArch;

  public function __construct($id_Arch) {
    $this->idArch = $id_Arch;
    parent::__construct('formComent');
  }
  
  protected function generaCamposFormulario ($datos) {
    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Comentar</legend>
		  <p><label></label> <input type="text" name="comentario"></p> 
      <INPUT TYPE="hidden" NAME="id" VALUE="<?= $this->idArch ?>">
		  <button type="submit">Comentar</button>
		</fieldset>
EOF;
    return $camposFormulario;
  }

  /**
   * Procesa los datos del formulario.
   */
  protected function procesaFormulario($datos) 
  {
     $userComment  = $_SESSION['username'];

     $com = Com::crearComentario($_SESSION['username'], $datos[0],$datos[1]);
  }
}