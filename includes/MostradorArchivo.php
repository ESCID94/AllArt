<?php

namespace es\ucm\fdi\aw;

class MostradorArchivo {

  private $archivo;

  public function __construct($archivo) {
    $this->archivo=$archivo;
  }
  
  public function mostrar () {
    $html="<div class='archivo'>";
    //echo "<embed src= '" . $archivo->ruta() . "' width='400' height='400' autostart='true' loop='true' /> </embed>'";
    //echo "<img src= '" . $archivo->ruta() . "'>";
	if($this->archivo != null) {	    
        switch ($this->archivo->tipo()){
            case "imagen":
                $html.= "<img src='" . $this->archivo->ruta() . "'></br>";
                break;
            case "video":
                $html.="<video controls> 
                        <source src='" . $this->archivo->ruta() . "' type='" . $this->archivo->tipomime() . "'>
                        </video></br>";
                break;
            case "audio":
                $html.="<audio controls> 
                        <source src='" . $this->archivo->ruta() . "' type='" . $this->archivo->tipomime() . "'>
                        </audio></br>";
                break;
            case "escrito":
                if($this->archivo->tipomime() == "application/pdf"){
                    $html.= "<object data='" . $this->archivo->ruta() . "' type='application/pdf' width='450' height='600'>
                              <a href='" . $this->archivo->ruta() . "'>Enlace al archivo pdf</a>
                            </object></br>";
                } else {
                    $html.="<iframe src='" . $this->archivo->ruta() . "' width='450' height='400'></iframe></br>";
                }
                break;
        }
        $html.= "Nombre: " . $this->archivo->nombre() . "</br>";
        $html.= "Autor: " . $this->archivo->nombreAutor() . "</br>";
        $html.= "Descripción: " . $this->archivo->descripcion() . "</br>";
        $html.= "Puntuacion: " . $this->archivo->puntuacion() . "</br>";
        $html.= "Precio: " . $this->archivo->precio() . "</br></div>";
    }
    return $html;
  }
}
