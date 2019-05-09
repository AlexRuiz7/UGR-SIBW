<?php

class Controlador {
  private $pagina, $datos_web, $noticias, $twig;


  /**
   * Constructor
   *
   * @param String $pagina pagina requerida por el usuario
   * @param Twig $twig   Instancia de twig
   */
  public function __construct($pagina, $twig) {
    $this -> pagina     = $pagina;
    $this -> twig       = $twig;
    $this -> datos_web  = new DatosWeb($twig);
    $this -> noticias   = new Noticia ($twig);
  }


  /**
   * Destructor
   */
  public function __destruct() {
    unset( $this -> pagina    );
    unset( $this -> datos_web );
    unset( $this -> noticias  );
    unset( $this -> twig      );
  }


  /**
   * Construye la página web delegando en los distintos módulos que lo componen
   *
   * @return HTML código html renderizado por Twig
   */
  public function construir() {
    echo $this -> datos_web -> getHeader();

    switch ($this->pagina) {
      case 'inicio':
        echo $this -> noticias -> getInicio();
      break;

      case 'noticias':
        if(  isset($_GET['id']) && is_numeric($_GET['id']) )
          echo $this -> noticias -> getNoticia($_GET['id']);
        else
          echo $this->twig->render('404.twig', []);
      break;

      case 'imprimir':
        if(  isset($_GET['id']) && is_numeric($_GET['id']) )
          echo $this -> noticias -> getNoticiaImprimir($_GET['id']);
        else
          echo $this->twig->render('404.twig', []);
      break;

      default:
        echo $this->twig->render('404.twig', []);
      break;
    }

    echo $this -> datos_web -> getFooter();
  }
}

?>
