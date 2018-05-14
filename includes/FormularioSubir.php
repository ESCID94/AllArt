<?php

namespace es\ucm\fdi\aw;

class FormularioSubir extends Form {


  public function __construct($opciones) {
    parent::__construct('formMod',$opciones);
  }
  
  protected function generaCamposFormulario ($datos) {
$camposFormulario=<<<EOF
		<fieldset>
		  <legend>Subir archivo</legend>
		  <p><label>Seleccionar archivo:</label> <input type="file" name="archivo"></p> 
		  <p><label>Nombre:</label> <input type="text" name="nombre"></p> 
          <p>Tipo de archivo<select name="tipo">
            <option value="imagen" selected>Imagen</option>
            <option value="video">Vídeo</option>
            <option value="audio">Audio</option>
            <option value="escrito">Escrito</option>
          </select></p>
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
    $dir_subida_container = '/var/www/html/allart/img/';
    $dir_subida_local = '/opt/lampp/htdocs/allart/img/';
    $dir_uploads = 'uploads/';
    $ruta_subida_filesystem = $dir_subida_local . basename($_FILES['archivo']['nombre']);
    $ruta_subida_bd = $dir_uploads . basename($_FILES['archivo']['nombre']);


    //Comprobación con seguridad y tratamiento consultado en https://stackoverflow.com/questions/28716498/uploading-a-file-using-html-php
    //TO-DO: comprobar si el tipo pasado por formulario coincide con el real: imagen, vídeo, escrito o audio    
    $finfo = new \finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['archivo']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
        ),
        true
    )){
        $result[] = 'El archivo no es una imagen png o jpg';
        $ok = false;
    }


    //Ejemplo basado en http://php.net/manual/es/features.file-upload.post-method.php
    if (!move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta_subida_filesystem)) { //cambiar a elseif si se habilita el if de finfo
        $result[] = 'Error al procesar el archivo';
        $ok = false;
    } else {
        $result[] = 'El archivo es válido y se subió con éxito.';
    }
    
    
    if(!$ok){ 
        $result[] = 'No se ha completado la subida del archivo correctamente';
    }
    else{
        //TO-DO: Cambiar ubicación de archivo y nombre
        $user = Usuario::subirArchivo($ruta_subida_bd); //id(auto),autor(auto)
        //Aplicacion::getSingleton()->modImagen($user);
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/Perfil.php'); //cambiar destino ¿dinámicamente?
    }
    return $result;
  }
}
