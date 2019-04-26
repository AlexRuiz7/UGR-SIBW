<?php

// echo dirname(__FILE__) . "/BDconfig.php";
include(dirname(__FILE__) . "/BDconfig.php");

class BD extends BDconfig {
  public $bd;
  private $bd_params;

  /**
   * Constructor
   *
   * @var [type]
   */
  public function __construct() {
    $this -> bd_params = new BDconfig();
  }


  /**
   * Realiza la conexión con la base de datos
   *
   * @return mysqli enlace a la BD
   */
  public function conectar() {
    $this->bd = mysqli_connect( $this->bd_params->servidor,
                                $this->bd_params->usuario,
                                $this->bd_params->clave,
                                $this->bd_params->tabla);

    if(mysqli_connect_error())
      die("Error de conexión. " . mysqli_connect_error());

    // if(DEBUG)
      echo("Conexión establecida en " . $this->bd_params->servidor . "\n");

    return $this->bd;
  }


  /**
   * [desconectar description]
   * @return [type] [description]
   */
  public function desconectar() {
    mysqli_close($this->bd);

    if(DEBUG)
      echo("Conexión cerrada\n");
  }
}
// $a = new BD();
// $a->conectar();
// $a->desconectar();
?>
