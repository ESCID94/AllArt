<?php

namespace es\ucm\fdi\aw;

class FormularioModArchivo extends Form {

    private $idArch;

  public function __construct($id_Arch) {
    $this->idArch = $id_Arch;
    parent::__construct('formMod');
  }
  
  protected function generaCamposFormulario ($datos) {
    
    //TO-DO: Si no eres el propietario del archivo, impedir la modificación: no mostrar los campos   
    
    $archivo = archivo::buscaArchivo($this->idArch);
    $nombre = $archivo->nombre();
    $descripcion = $archivo->descripcion();
    $precio = $archivo->precio();
    $destacado = $archivo->destacado();

    $checkedDestacado = $destacado==1 ? "checked" : "";

$camposFormulario=<<<EOF
		<fieldset>
		  <legend>Modificar archivo</legend>
		  <p><label>Nombre:</label> <input type="text" name="nombre" value="$nombre"></p> 
          <p><label>Descripción:</label> <input type="text" name="descripcion" value="$descripcion"></p>
          <p><label>Precio:</label> <input type="text" name="precio" value="$precio"></p>
          <p><label>Archivo Destacado:</label> <input type="checkbox" name="destacado" $checkedDestacado value="Si" ></p>
          <input type="hidden" name="id" value="<?= $this->idArch ?>">
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
    
    if(!$ok){ 
        $result[] = 'No se ha completado la subida del archivo correctamente';
    }
    else{
        $arch = archivo::modificarArchivo($datos['id'], $datos['nombre'], $datos['descripcion'], $datos['precio'], $esDestacado);
    }
    return $result;
  }
}
