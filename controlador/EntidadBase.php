<?php

class EntidadBase {
  protected $modelo;


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
