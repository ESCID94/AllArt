<?php

namespace es\ucm\fdi\aw;

class FormularioEliminarArchivo extends Form {

  private $idArch;

  public function __construct($id_Arch) {
    $this->idArch = $id_Arch;
    parent::__construct('formElimArch');
  }
  
  protected function generaCamposFormulario ($datos) {
    $id=$this->idArch;
    $archivo = archivo::buscaArchivo($this->idArch);
    if($archivo!=false){
        $camposFormulario=<<<EOF
	        
    <input type='hidden' name='id' value='$id'></br>
    <button type="submit">Eliminar archivo</button>
EOF;
    } else {
        $camposFormulario="";
    }

    
    return $camposFormulario;
  }

  /**
   * Procesa los datos del formulario.
   */
  protected function procesaFormulario($datos) {
    $result = array();
    $ok = true;


    $idSet=isset($datos['id']) ? $datos['id'] : null;
    if($idSet == null) {
       	$result[] = 'No se ha encontrado el archivo';
        echo $idSet;
        $ok=false;
    } elseif(!Aplicacion::getSingleton()->usuarioLogueado() || archivo::buscaArchivo($idSet)->autor() != Usuario::buscaUsuario($_SESSION['username'])->id()){
        $result[] = 'No puedes eliminar el archivo';
        $ok=false;
    }
    
    if(!$ok){ 
        $result[] = 'No se ha completado la eliminación del archivo correctamente';
    } else{
        $arch = archivo::eliminarArchivo($datos['id']);
        if ($arch!=false) $result[]= 'Eliminado con éxito';
        //$result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/verArchivo.php?archivo='.$datos['id']);
        else {$result[]="fallo";}
    }

    return $result;
  }
}
