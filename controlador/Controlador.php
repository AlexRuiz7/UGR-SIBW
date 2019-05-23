<?php

class Controlador {
  private $pagina, $datos_web, $noticias, $twig, $usuario;


  /**
   * Constructor
   *
   * @param String $pagina pagina requerida por el usuario
   * @param Twig $twig   Instancia de twig
   */
  public function __construct($pagina, $twig) {
    $this -> pagina     = $pagina;
    $this -> twig       = $twig;
    $this -> datos_web  = new DatosWeb();
    $this -> noticias   = new Noticia ();
    $this -> usuario    = new Usuario ();
  }


  /**
   * Destructor
   */
  public function __destruct() {
    unset( $this -> pagina    );
    unset( $this -> datos_web );
    unset( $this -> noticias  );
    unset( $this -> usuario   );
    unset( $this -> twig      );
  }


  /**
   * Construye la página web delegando en los distintos módulos que lo componen
   *
   * @return HTML código html renderizado por Twig
   */
  public function construir() {
    $datos = $this -> datos_web -> getHeader()
           + $this -> noticias -> getBarraLateral()
           + $this -> datos_web -> getFooter();

    switch ($this->pagina) {
      case 'inicio':
        $datos += $this -> noticias -> getGridInicio();
        echo $this -> twig -> render("inicio.twig", $datos);
      break;

      case 'noticias':
        if( isset($_GET['id']) && is_numeric($_GET['id']) ) {
          $datos += $this -> noticias -> getNoticia($_GET['id']);
          echo $this -> twig -> render("noticia.twig", $datos);
        }
        else {
          echo $this->twig->render('404.twig', $datos);
        }
      break;

      case 'listado-noticias':
        echo $this->twig->render('404.twig', $datos);
      break;

      case 'imprimir':
        if( isset($_GET['id']) && is_numeric($_GET['id']) ) {
          $datos += $this -> noticias -> getNoticia($_GET['id']);
          echo $this -> twig -> render("noticia_imprimir.twig", $datos);
        }
        else {
          echo $this->twig->render('404.twig', $datos);
        }
      break;

      case 'inicio-sesion':
        if( isset($_POST['inicio-sesion']) ) {
          $email  = $_POST['email'];
          $pass   = $_POST['contraseña'];
          $this->usuario->conectar($email, $pass);
        }
        else if( isset($_POST['registro']) ) {
          $email  = $_POST['email'];
          $nombre = $_POST['nombre'];
          $pass   = $_POST['contraseña'];
          $pass_2 = $_POST['conf_contraseña'];
          $this->usuario->registrar($email, $nombre, $pass, $pass_2);
        }
        echo $this->twig->render('login.twig', $datos);
      break;

      default:
        echo $this->twig->render('404.twig', $datos);
      break;
    }

  }
}

?>
