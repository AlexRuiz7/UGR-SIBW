<?php

class BDconfig {
  protected $servidor;
  protected $tabla;
  protected $usuario;
  protected $clave;

  // function dbconfig
  public function __construct() {
    $this -> servidor = "localhost";
    $this -> tabla    = "SIBW";
    $this -> usuario  = "sibw";
    $this -> clave    = "sibw";
  }

}
?>
