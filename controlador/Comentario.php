<?php

class Comentario extends EntidadBase {
  private $l_comentarios;


  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct("Comentarios");
  }


  /**
   * Destructor
   */
  public function __destruct() {
    parent::__destruct();
    unset( $this -> l_comentarios );
  }


  /**
   * [buscarComentarioEmail description]
   * @param  [type] $email [description]
   * @return [type]        [description]
   */
  public function buscarComentarioEmail($email) {
    $datos = $this->modelo->getValuesBy("*", "email_usuario='$email'");

    while($fila = $datos->fetch(PDO::FETCH_ASSOC)) {
      $this->l_comentarios[] = array(
        'texto'   => $fila['texto'],
        'usuario' => $fila['email_usuario'],
        'fecha'   => $fila['fecha'],
        'id_ntc'  => $fila['id_noticia']
      );
    }

    if(isset($this->l_comentarios))
      return $this->l_comentarios;
  }


  /**
   * [getComentarios description]
   * @return [type] [description]
   */
  public function getComentarios() {
    $datos = $this->modelo->getValues();

    while($fila = $datos->fetch(PDO::FETCH_ASSOC)) {
      $this->l_comentarios[] = array(
        'texto'   => $fila['texto'],
        'usuario' => $fila['email_usuario'],
        'fecha'   => $fila['fecha'],
        'id_ntc'  => $fila['id_noticia']
      );
    }

    if(isset($this->l_comentarios))
      return $this->l_comentarios;
  }
}

?>
