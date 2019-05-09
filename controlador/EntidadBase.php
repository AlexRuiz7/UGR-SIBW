<?php

class EntidadBase {
  protected $modelo, $twig;


  /**
   * Constructor
   *
   * @param Twig $twig Instancia de twig
   */
  public function __construct($tabla, $twig) {
    $this -> modelo = new ConsultasCRUD($tabla);
    $this -> twig   = $twig;
  }


  /**
   * Destructor
   */
  public function __destruct() {
    unset(  $this -> modelo );
    unset(  $this -> twig   );
  }

}

?>
