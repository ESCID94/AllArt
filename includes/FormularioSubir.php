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
          <p><label>Descripción:</label> <input type="text" name="descripcion"></p>
          <p><label>Precio:</label> <input type="text" name="precio"></p>
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
    $dir_subida_container = '/var/www/html/allart/uploads/';
    $dir_subida_local = '/opt/lampp/htdocs/allart/uploads/';
    $dir_uploads = 'uploads/';
    $random = Aplicacion::getSingleton()->generateRandomString();
    $ruta_subida_filesystem = $dir_subida_container . $random;
    $ruta_subida_bd = $dir_uploads . $random;


    //Comprobación con seguridad y tratamiento consultado en https://stackoverflow.com/questions/28716498/uploading-a-file-using-html-php
    //TO-DO: comprobar si el tipo pasado por formulario coincide con el real: imagen, vídeo, escrito o audio    

    switch ($datos['tipo']) {
        case "imagen":
            $opciones=array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            );
            break;
        case "video":
            $opciones=array(
            'mp4' => 'video/mp4',
            'ogg' => 'video/ogg',
            'webm' => 'video/webm',
            );
            break;
        case "audio":
            $opciones=array(
            'mp3' => 'audio/mpeg',
            'ogg' => 'audio/ogg',
            'webm' => 'audio/webm',
            );
            break;
        case "escrito":
            $opciones=array(
            'txt' => 'text/plain',
            'pdf' => 'application/pdf',
            );
            break;
    }


    $finfo = new \finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['archivo']['tmp_name']),
        $opciones,
        true
    )){
        switch ($datos['tipo']) {
        case "imagen":
            $result[] = 'El archivo no es una imagen png, jpg o gif';
            break;
        case "video":
            $result[] = 'El archivo no es un vídeo mp4, ogg o webm';
            break;
        case "audio":
            $result[] = 'El archivo no es un audio mp3, ogg o webm';
            break;
        case "escrito":
            $result[] = 'El archivo no es un fichero txt o pdf';
            break;
    }
        $result[] = 'El tipo de archivo subido no es el esperado';
        $ok = false;
    }


    //Ejemplo basado en http://php.net/manual/es/features.file-upload.post-method.php
    elseif (!move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta_subida_filesystem)) {
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
        $arch = archivo::subirArchivo($datos['nombre'], $datos['descripcion'], $ruta_subida_bd, $datos['precio']);
        //Aplicacion::getSingleton()->modImagen($user);
        //$result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/Perfil.php'); //cambiar destino ¿dinámicamente?
    }
    return $result;
  }
}
