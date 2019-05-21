<?php

class Comentario extends EntidadBase {
  private $id_noticia, $l_comentarios;


  /**
   * Constructor
   *
   * @param [type] $twig [description]
   * @param [type] $id   [description]
   */
  public function __construct($id) {
    parent::__construct("Comentarios", $twig);

    $this -> id_noticia = $id;
    $this -> setComentarios();
  }


  /**
   * Destructor
   */
  public function __destruct() {
    parent::__destruct();

    unset( $this -> id_noticia    );
    unset( $this -> l_comentarios );
  }


  /**
   * Recupera los comentarios de la base de datos y los introduce en un array
   * para ser utlizados por Twig.
   */
  private function setComentarios() {
    $datos = $this->modelo->getValuesBy("texto, email_usuario");

    while($fila = $datos->fetch(PDO::FETCH_ASSOC)) {
      $temp[] = array(
        'texto'=> $fila['texto'],
        'usuario' => $fila['email_usuario']
      );
    }

    $this -> l_comentarios = array('comentarios' => $temp);
  }


  /**
   * Devuelve los comnetarios asociados a la noticia
   *
   * @return Array comentarios de la noticia
   */
  public function getComentarios() {
    return $this -> l_comentarios;
  }

}

?>
