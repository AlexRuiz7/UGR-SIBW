<?php

class EntidadBase {
  public $modelo;


  /**
   * Constructor
   */
  public function __construct($tabla) {
    $this -> modelo = new ConsultasCRUD($tabla);
  }


  /**
   * Destructor
   */
  public function __destruct() {
    unset(  $this -> modelo );
  }

}

?>
