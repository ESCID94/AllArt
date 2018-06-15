<?php

namespace es\ucm\fdi\aw;

class MostradorUsuario {

  private $usuario;

  public function __construct($usu) {
    $this->usuario=$usu;
  }
  
  public function mostrar () {
    $html="";
	if($this->usuario != null) {
        $html.="<div class='usuario'>";    
        $html.= "<img src= '" . $this->usuario->imgPerfil() . "' border='0' width='100' height='100'></br>";
        $html.= "Nombre: " . $this->usuario->username() . "</br>";
        $html.= "Descripción: " . $this->usuario->descripcion() . "</br>";
        $html.= "Fecha nacimiento: " . $this->usuario->fechaNac() . "</br></div>";
    }
    return $html;
  }
}
