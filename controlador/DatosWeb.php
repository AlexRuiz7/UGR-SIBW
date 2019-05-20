<?php

class DatosWeb extends EntidadBase {
  private $header, $footer;


  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct("Datos_Web");

    $this -> header = $this -> setHeader();
    $this -> header_imprimir = $this -> setHeader();
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
   * Devuelve los datos de la cabecera de la página
   *
   * @return Array datos de la cabecera
   */
  public function getHeader () {
    return $this -> header;
  }


  /**
   * Devuelve los datos del pie de página.
   *
   * @return Array datos del pie de página
   */
  public function getFooter () {
    return $this -> footer;
  }

}

?>
