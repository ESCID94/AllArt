<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Seguidos {


	private function __construct($id, $idFollow) {
    $this->id = $id;
	$this->idFollow = $idFollow;
  }

  private $id;

  private $idFollow;





  public static function buscarFollows($id)
  {
        $app = App::getSingleton();
        $conn = $app->conexionBd();

        $reg = sprintf ("SELECT * FROM seguidos S WHERE S.id = '%s'" , $conn->real_escape_string($id));
        $rs =$conn->query($reg);

    if ($rs)
    {
      $results = NULL;
      while($row = $rs->fetch_assoc()) 
      {
          $results[] = $row;
      }
      return $results;
    }
      return false;
  }


	public static function alredyFollow($follow, $follower)
	{
		$app = App::getSingleton();
   	$conn = $app->conexionBd();

    	$reg = sprintf ("SELECT count(S.id) FROM seguidos S WHERE S.id = '%s' AND S.idFollow = '%s" 
        , $conn->real_escape_string($follower) 
        ,$conn->real_escape_string($follow));

        $rs =$conn->query($reg);

        if ($rs == 0) //no sigue al usuario
        {
          return false;
        }
        else
        {
          return true;
        }

}
  public static function follow($follow, $follower)
  {
    $app = App::getSingleton();
    $conn = $app->conexionBd();

    $reg = sprintf("INSERT INTO seguidos(id, idFollow) VALUES ('%s' , '%s')"
      , $conn->real_escape_string($follower) 
      ,$conn->real_escape_string($follow));

    $rs =$conn->query($reg);

    return $rs;
  }


  public static function unfollow($follow, $follower)
  {
    $app = App::getSingleton();
    $conn = $app->conexionBd();

    $reg = sprintf("DELETE FROM seguidos S WHERES.id = '%s' AND S.idFollow = '%s"
      , $conn->real_escape_string($follower) 
      ,$conn->real_escape_string($follow));

    $rs =$conn->query($reg);

    return $rs;
  }


}
?>