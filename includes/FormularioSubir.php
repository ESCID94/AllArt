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
		  <p><label>Subir imagen:</label> <input type="file" name="nuevaImagen"></p> 
		  <p><label>Nombre de la imagen:</label> <input type="text" name="name"></p> 
          <p><label>Usar como imagen destacada:</label> <input type="checkbox" name="destacada"></p>  
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
    $dir_subida1 = '/var/www/html/allart/img/';
    $dir_subida1b = '/opt/lampp/htdocs/allart/img/';
    $dir_subida2 = 'img/';
    $imagen_subida1 = $dir_subida1b . basename($_FILES['nuevaImagen']['name']);
    $imagen_subida2 = $dir_subida2 . basename($_FILES['nuevaImagen']['name']);
    //  echo $_FILES['nuevaImagen']['name'];

    //Comprobación con seguridad y tratamiento consultado en https://stackoverflow.com/questions/28716498/uploading-a-file-using-html-php
    /*$finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['nuevaImagen']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
        ),
        true
    )){
        $result[] = 'El archivo no es una imagen png o jpg';
        $ok = false;
    }*/


    //Ejemplo basado en http://php.net/manual/es/features.file-upload.post-method.php
    if (!move_uploaded_file($_FILES['nuevaImagen']['tmp_name'], $imagen_subida1)) { //cambiar a elseif si se habilita el if de finfo
        $result[] = '¡Posible ataque de subida de ficheros!';
        $ok = false;
    } else {
        $result[] = 'La imagen es válida y se subió con éxito.';
    }
    
    
    if(!$ok){ 
        $result[] = 'No se ha completado la modificación de la imagen del perfil';
    }
    else{
        //TO-DO: Cambiar ubicación de archivo y nombre
        $user = Usuario::modImagen($imagen_subida2); //id(auto),autor(auto)
        Aplicacion::getSingleton()->modImagen($user);
        $result = \es\ucm\fdi\aw\Aplicacion::getSingleton()->resuelve('/Perfil.php');
    }
    return $result;
  }
}
