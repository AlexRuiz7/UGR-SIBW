<?php

class Noticia extends EntidadBase {
  /* Conexiones con las tablas relacionadas */
  private $con_imagen, $con_etiquetas, $con_comentarios;
  /* Objetos dependientes y construibles por esta clase */
  private $noticia, $barra_lateral, $grid_inicio;
  /* Parámetros varios */
  private $tam_sidebar;


  /**
   * Constructor
   *
   * @param Twig $twig Instancia de twig
   */
  public function __construct($twig) {
    parent::__construct("Noticias", $twig);

    $this -> con_imagen = new ConsultasCRUD("ImagenesEnNoticia");
    $this -> con_etiquetas = new ConsultasCRUD("EtiquetasEnNoticia");
    // $this -> con_comentarios = new ConsultasCRUD("");

    $this -> noticia        = array();
    $this -> barra_lateral  = array();
    $this -> grid_inicio    = array();

    $this -> tam_sidebar    = 4;

    $this -> setBarraLateral();
    $this -> setGridInicio();
  }


  /**
   * Destructor
   */
  public function __destruct() {
    parent::__destruct();

    unset(  $this -> con_imagen       );
    unset(  $this -> con_etiquetas    );
    unset(  $this -> con_comentarios  );

    unset(  $this -> noticia          );
    unset(  $this -> barra_lateral    );
    unset(  $this -> grid_inicio      );

    unset(  $this -> tam_sidebar      );
  }


  /**
   * Actualiza el tamaño de la barra lateral de la página. Este valor define la
   * cantidad de noticias que aparecerán en ella.
   *
   * @return int $tam
   */
  public function setTamBarraLateral($tam) {
    $this -> tam_sidebar = $tam;
  }


  /**
   * Devuelve el tamaño de la barra lateral de la página. Este valor define la
   * cantidad de noticias que aparecerán en ella.
   *
   * @return int $tam
   */
  public function getTamBarraLateral() {
    return $this -> tam_sidebar;
  }


  /**
   * Recupera los datos para la barra lateral con las noticias más visitadas de
   * la página. Almacena los datos en una estructura de datos propia para ser
   * utilizada por Twig.
   */
  private function setBarraLateral() {
    $datos = $this->modelo->getValuesOrdered("id, titular", "visitas DESC");

    $temp = array();
    for($i=0; $i < $this -> tam_sidebar; $i++) {
      $fila = $datos->fetch(PDO::FETCH_ASSOC);
      if($fila)
        $temp[] = array(
          'id'      => $fila['id'],
          'titulo'  => $fila['titular']
        );
    }

    $array_noticias = array('noticias_sidebar' => $temp);
    $this->barra_lateral = $array_noticias;
  }


  /**
   * Renderiza la barra lateral con Twig haciendo uso de los datos recuperados
   * de la base de datos.
   *
   * @return Template plantilla de la barra lateral rellenada con sus datos.
   */
  public function getBarraLateral() {
    return $this->twig->render('sidebar.twig', $this->barra_lateral);
  }


  /**
   * Recupera los datos para la sección de noticias de la página de inicio.
   * Almacena los datos en una estructura de datos propia para ser utilizada por
   * Twig.
   */
  private function setGridInicio() {
    $datos = $this->modelo->getValuesOrdered("id, titular", "fecha DESC LIMIT 9");

    $temp = array();
    for($i=0; $i < 9; $i++) {
      $fila = $datos->fetch(PDO::FETCH_ASSOC);
      if($fila) {
        $id = $fila['id'];
        $img = $this->setImgs($id);
        $temp[] = array(
          'id'      => $id,
          'titulo'  => $fila['titular'],
          'imagen'  => 'media/imgs/noticias/' . $img
        );
      }
    }

    $array_noticias = array('noticias_grid' => $temp);
    $this->grid_inicio = $array_noticias;
  }


  /**
   * Renderiza la sección central con Twig haciendo uso de los datos recuperados
   * de la base de datos.
   *
   * @return Template plantilla de la sección central rellenada con sus datos.
   */
  public function getGridInicio() {
    return $this->twig->render('seccion_central.twig', $this->grid_inicio);
  }


  /**
   * [getInicio description]
   * @return [type] [description]
   */
  public function getInicio() {
    $datos = $this->barra_lateral + $this->grid_inicio;
    return $this->twig->render('seccion_central.twig', $datos);
  }


  /**
   * Obtiene y devuelve la imagen asociada a cada noticia.
   *
   * NOTE solo devuelve 1 imagen ya que solo hay una por noticia de momento.
   *
   * @param  Int $id_noticia identificador de la noticia a consultar
   * @return String
   */
  private function setImgs($id_noticia) {
    $img_url = $this->con_imagen->getValuesBy("url", "id_noticia=$id_noticia");
    return $img_url->fetch(PDO::FETCH_ASSOC)['url'];
  }


  /**
   * Obtiene y devuelve todas las etiquetas asociadas a una noticia
   *
   * @param Int $id_noticia identificador de la noticia a consultar
   */
  private function setEtiquetas($id_noticia) {
    $datos = $this->con_etiquetas->getValuesBy("tema", "id_noticia=$id_noticia");

    while($fila = $datos->fetch(PDO::FETCH_ASSOC)) {
      $temp[] = $fila['tema'];
    }

    return implode(", ", $temp);
  }


  /**
   * [setNoticia description]
   */
  private function setNoticia($id_noticia) {
    $datos = $this->modelo->getValuesBy("*", "id=$id_noticia")->fetch(PDO::FETCH_ASSOC);

    $imagenes  = $this -> setImgs($id_noticia);
    $etiquetas = $this -> setEtiquetas($id_noticia);
    $parrafos  = $this -> formatearTexto($datos["texto"]);

    $temp = array(
      "id"      => $datos["id"],
      "titulo"  => $datos["titular"],
      "autor"   => $datos["autor"],
      "fecha"   => date('H:i:s  --  d-m-Y', strtotime($datos["fecha"])),
      "visitas" => $datos["visitas"],
      "enlace"  => $datos["link"],
      "texto"   => $parrafos,
      "imagen"  => 'media/imgs/noticias/' . $imagenes,
      "etiquetas" => $etiquetas
    );

    $array_noticias = array('noticia' => $temp);
    return $array_noticias;
  }


  /**
   * [getNoticia description]
   * @return [type] [description]
   */
  public function getNoticia($id_noticia) {
    $datos = $this->barra_lateral + $this -> setNoticia($id_noticia);

    return $this->twig->render('seccion_central.twig', $datos);
  }


  /**
   * [getNoticia description]
   * @return [type] [description]
   */
  public function getNoticiaImprimir($id_noticia) {
    $datos = $this -> setNoticia($id_noticia);

    return $this->twig->render('noticia_imprimir.twig', $datos);
  }




  private function formatearTexto($texto) {
    return explode("##", $texto);
  }

}

?>
