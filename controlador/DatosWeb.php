<?php

class DatosWeb extends EntidadBase {
  private $header, $footer;


  /**
   * Constructor
   *
   * @param Twig $twig Instancia de twig
   */
  public function __construct($twig) {
    parent::__construct("Datos_Web", $twig);

    $this -> header = $this -> setHeader();
    $this -> footer = $this -> setFooter();
  }


  /**
   * Destructor
   */
  public function __destruct() {
    unset( $this -> header );
    unset( $this -> footer );
    parent::__destruct();
  }


  /**
   * Construye la cabecera de la página a partir de los datos almacenados en la
   * base de datos. Se da formato a los datos para que los utilice Twig.
   *
   * @return Array datos formateados para ser usados por Twig
   */
  private function setHeader() {
    $titulo = $this->modelo->getValuesBy("valor", "campo='titulo'")->fetch(PDO::FETCH_ASSOC)['valor'];
    $logo = $this->modelo->getValuesBy("valor", "campo='logo'")->fetch(PDO::FETCH_ASSOC)['valor'];

    return array(
      'cabecera' => array(
        'titulo'  => $titulo,
        'logo'    => $logo
      )
    );
  }


  /**
   * Construye el footer de la página a partir de los datos almacenados en la
   * base de datos. Se da formato a los datos para que los utilice Twig.
   *
   * @return Array datos formateados para ser usados por Twig
   */
  private function setFooter() {
    $dir = $this->modelo->getValuesBy("valor", "campo='direccion'")->fetch(PDO::FETCH_ASSOC)['valor'];
    $tlfn = $this->modelo->getValuesBy("valor", "campo='telefono'")->fetch(PDO::FETCH_ASSOC)['valor'];
    $email = $this->modelo->getValuesBy("valor", "campo='email'")->fetch(PDO::FETCH_ASSOC)['valor'];
    $mapa = $this->modelo->getValuesBy("valor", "campo='mapa'")->fetch(PDO::FETCH_ASSOC)['valor'];
    $fb = $this->modelo->getValuesBy("valor", "campo='fb'")->fetch(PDO::FETCH_ASSOC)['valor'];
    $ig = $this->modelo->getValuesBy("valor", "campo='ig'")->fetch(PDO::FETCH_ASSOC)['valor'];
    $tw = $this->modelo->getValuesBy("valor", "campo='tw'")->fetch(PDO::FETCH_ASSOC)['valor'];
    $logo = $this->modelo->getValuesBy("valor", "campo='logo'")->fetch(PDO::FETCH_ASSOC)['valor'];


    $valores = array( 'footer' => array(
      'direccion' => $dir,
      'telefono'  => $tlfn,
      'email'     => $email,
      'mapa'      => $mapa,
      'icn_fb'    => $fb,
      'icn_ig'    => $ig,
      'icn_tw'    => $tw,
      'logo'      => $logo
      )
    );

    return $valores;
  }


  /**
   * Renderiza y devuelve el template de la cabecera.
   *
   * @return Template plantilla de la cabecera rellenada con sus datos
   */
  public function getHeader () {
    return $this->twig->render('header.twig', $this->header);
  }


  /**
   * Renderiza y devuelve el template del footer.
   *
   * @return Template plantilla del footer rellenada con sus datos
   */
  public function getFooter () {
    return $this->twig->render('footer.twig', $this->footer);
  }

}

?>
