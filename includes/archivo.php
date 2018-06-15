<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;


class Archivo
{

	private $id;

	private $nombre;

	private $descripcion;

	private $autor;

	private $destacado;

	private $punt;

	private $ruta;

	private $precio;

    private $tipo;

    private $tipomime;


	private function __construct($id, $nombre,$descripcion,  $autor, $dest, $puntuacion, $ruta, $precio, $tipo, $tipomime)
	{
		$this->id = $id;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->autor = $autor;
		$this->destacado = $dest;
		$this->punt = $puntuacion;
		$this->ruta = $ruta;
		$this->precio = $precio;
        $this->tipo = $tipo;
        $this->tipomime = $tipomime;
	}







		public static function buscarImagenDest($idAutor)
	{
		$app = App::getSingleton();
   		$conn = $app->conexionBd();
    	$query = sprintf("SELECT * FROM archivo A WHERE A.autor='%s'AND A.imgDest = 1", $conn->real_escape_string($idAutor));
		$rs = $conn->query($query);



    	if ($rs && $rs->num_rows == 1) 
    	{
    		$fila = $rs->fetch_assoc();
      		$img = new archivo($fila['id'], $fila['nombre'],$fila['Descripcion'], $fila['autor'], $fila['imgDest'], $fila['punt'], $fila['ruta'],$fila['Precio'],$fila['tipo'],$fila['tipoMime']);
      		$rs->free();

      		return $img;
    	}
    	return false;
	}


	public static function buscarMejoresArch($idAutor)
 	{
 		$app = App::getSingleton();
   		$conn = $app->conexionBd();
    	$query = sprintf("SELECT * FROM archivo A WHERE A.autor='%s' ORDER BY A.punt ASC", $conn->real_escape_string($idAutor));
		$rs = $conn->query($query);

		if ($rs)
		{
			$archivos = array();


			while($row = $rs->fetch_assoc()) 
			{
   				$results[] = $row;
			}
			return $results;
		}
		return false;
 	}

 	public static function buscaArchivo($idArchivo)
 	{
 		$app = App::getSingleton();
   		$conn = $app->conexionBd();
    	$query = sprintf("SELECT * FROM archivo A WHERE A.id='%s'", $conn->real_escape_string($idArchivo));
		$rs = $conn->query($query);


		if ($rs && $rs->num_rows == 1)
		{
			$fila = $rs->fetch_assoc();
      		$arch = new archivo($fila['id'], $fila['nombre'],$fila['Descripcion'], $fila['autor'], $fila['imgDest'], $fila['punt'], $fila['ruta'],$fila['Precio'],$fila['tipo'],$fila['tipoMime']);
      		$rs->free();

      		return $arch;
		}
		return false;
 	}

  public static function subirArchivo ($nombre, $descripcion, $ruta, $precio, $tipo, $mimetype)
  {
    $user = Usuario::buscaUsuario($_SESSION['username']);
    if ($user) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();


        $reg = sprintf("INSERT INTO archivo(nombre, Descripcion,autor,imgDest, punt, ruta, Precio, tipo, tipoMime) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')"
          , $conn->real_escape_string($nombre)
          , $conn->real_escape_string($descripcion)
          , $conn->real_escape_string($user->id())
          , 0
          , 0 //TO-DO: cambiar a null o algo que signifique "aún no puntuado"
          , $conn->real_escape_string($ruta)
          , $conn->real_escape_string($precio)
          , $conn->real_escape_string($tipo)
          , $mimetype);


        if ($conn->query($reg) === TRUE)
        {
            echo "<br />" . "<h2>" . "Archivo subido exitosamente!" . "</h2>";
        }
        else
        {
            echo "Error: (" . $conn->errno . ") ";
            return false;
        }

        
        return $conn;
    }
    else {
        //error fatal: usuario no encontrado
        return false;
    }
  }


  public static function modificarArchivo ($id, $nombre, $descripcion, $precio, $destacado)
  {
    $user = Usuario::buscaUsuario($_SESSION['username']);
    if ($user) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();

        //Si $destacado=1, poner el resto de archivos del usuario a imgDest=0
        if($destacado==1){
            $regDestacado = sprintf("UPDATE archivo A SET imgDest = 0 WHERE A.autor = '%s'", archivo::buscaArchivo($id)->autor());

            if ($conn->query($regDestacado) === TRUE)
            {
                echo "<br />" . "<h2>" . "Archivo destacado actualizado" . "</h2>";
            }
            else
            {
                echo "Error al actualizar destacado: (" . $conn->errno . ") ";
                return false;
            }
        }


        $reg = sprintf("UPDATE archivo A SET nombre='%s', Descripcion='%s', Precio='%s', imgDest='%s' WHERE '%s' = A.id"
        , $conn->real_escape_string($nombre)
        , $conn->real_escape_string($descripcion)
        , $conn->real_escape_string($precio)
        , $conn->real_escape_string($destacado)
        , $conn->real_escape_string($id) );


        if ($conn->query($reg) === TRUE)
        {
            echo "<br />" . "<h2>" . "Archivo modificado exitosamente!" . "</h2>";
        }
        else
        {
            echo "Error: (" . $conn->errno . ") ";
            return false;
        }

        
        return $conn;
    }
    else {
        //error fatal: usuario no encontrado
        return false;
    }
  }

  public static function eliminarArchivo ($id)
  {
    $user = Usuario::buscaUsuario($_SESSION['username']);
    if ($user) {
        $app = App::getSingleton();
        $conn = $app->conexionBd();

        $ruta=archivo::buscaArchivo($id)->ruta();

        $reg = sprintf("DELETE FROM archivo WHERE '%s' = id AND '%s' = autor"
        , $conn->real_escape_string($id)
        , $user->id());

        if ($conn->query($reg) === TRUE)
        {
            echo "<br />" . "<h2>" . "Archivo eliminado exitosamente!" . "</h2>";
            unlink($ruta);
        }
        else
        {
            echo "Error: (" . $conn->errno . ") ";
            return false;
        }

        
        return $conn;
    }
    else {
        //error fatal: usuario no encontrado
        return false;
    }
  }

 	public function autor()
 	{
 		return $this->autor;
 	}

    public function nombreAutor()
    {
        $user = Usuario::buscaUsuarioById($this->autor);

 		return $user->username();
    }

	public function ruta()
  	{
  	  return $this->ruta;
 	}
 	public function nombre()
 	{
 		return $this->nombre;
 	}
 	public function descripcion()
 	{
 		return $this->descripcion;
 	}
 	public function puntuacion()
 	{
 		return $this->punt;
 	}
 	public function destacado()
 	{
 		return $this->destacado;
 	}
 	public function precio()
 	{
 		return $this->precio;
 	}
 	public function id()
 	{
 		return $this->id;
 	}
    public function tipo()
 	{
 		return $this->tipo;
 	}
    public function tipomime()
 	{
 		return $this->tipomime;
 	}
}


?>
