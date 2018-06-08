<?php

namespace es\ucm\fdi\aw;

class FormularioModArchivo extends Form {

    private $idArch;

  public function __construct($id_Arch) {
    $this->idArch = $id_Arch;
    parent::__construct('formModArchivo');
  }
  
  protected function generaCamposFormulario ($datos) {   
    
    $archivo = archivo::buscaArchivo($this->idArch);

    if($archivo!=false){
        $nombre = $archivo->nombre();
        $descripcion = $archivo->descripcion();
        $precio = $archivo->precio();
        $destacado = $archivo->destacado();
        $checkedDestacado = $destacado==1 ? "checked" : "";
    }
    else {
        $nombre = "";
        $descripcion = "";
        $precio = "";
        $destacado = "";
        $checkedDestacado = "";
    }
    

    $camposFormulario=<<<EOF
		<fieldset>
		  <legend>Modificar archivo</legend>
		  <p><label>Nombre:</label> <input type="text" name="nombre" value="$nombre"></p> 
          <p><label>Descripción:</label> <input type="text" name="descripcion" value="$descripcion"></p>
          <p><label>Precio:</label> <input type="text" name="precio" value="$precio"></p>
          <p><label>Archivo Destacado:</label> <input type="checkbox" name="destacado" $checkedDestacado value="Si" ></p>
          <input type="hidden" name="id" value="$this->idArch">
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

    //TO-DO: Validar contenido de los campos
    
    if(isset($datos['destacado']) && $datos['destacado'] == 'Si'){
        $esDestacado = 1;
    } else { $esDestacado = 0; }

    $idSet=isset($datos['id']) ? $datos['id'] : null;
    if($idSet == null) {
       	$result[] = 'No se ha encontrado el archivo';
        echo $idSet;
        $ok=false;
    } elseif(!Aplicacion::getSingleton()->usuarioLogueado() || archivo::buscaArchivo($idSet)->autor() != Usuario::buscaUsuario($_SESSION['username'])->id()){
        $result[] = 'No puedes modificar el archivo';
        $ok=false;
    }
    
    if(!$ok){ 
        $result[] = 'No se ha completado la modificación del archivo correctamente';
    } else{
        $arch = archivo::modificarArchivo($datos['id'], $datos['nombre'], $datos['descripcion'], $datos['precio'], $esDestacado);
        if ($arch!=false) $result[]= 'Modificado con éxito';
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/verArchivo.php?archivo='.$datos['id']);
    }

    return $result;
  }
}
