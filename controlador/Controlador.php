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
           + $this -> datos_web -> getFooter()
           + array('pagina' => $this->pagina);

    if( isset($_SESSION['nombre_usuario']) ) {
      $datos += array('usuario' => $_SESSION['nombre_usuario']);

      // echo $_SESSION['tipo'];
      if( $_SESSION['tipo'] != 'registrado' ) {
        $datos += array('tipo_usuario' => $_SESSION['tipo']);
      }
    }

    $plantilla = '404.twig';

    switch ($this->pagina) {
      case 'inicio':
        $datos += $this -> noticias -> getGridInicio();
        $plantilla = "inicio.twig";
      break;

      case 'noticias':
        if( isset($_GET['id']) && is_numeric($_GET['id']) ) {
          $datos += $this -> noticias -> getNoticia($_GET['id']);
          $plantilla = "noticia.twig";

          if(isset($_SESSION['tipo'])) {
            $tipo = $_SESSION['tipo'];

            switch ($tipo) {
              case 'moderador':
              $plantilla = "noticia_moderador.twig";

              if( isset($_POST['editar']) && !empty($_POST['texto']) ) {
                $this->noticias->editarComentario($_POST['texto'], $_POST['index']);
              }
              else if(isset($_POST['borrar'])) {
                $this->noticias->borrarComentario($_POST['index']);
              }
              break;

              case 'gestor':
              $plantilla = "noticia_gestor.twig";

              break;

              case 'admin':
              $plantilla = "noticia_admin.twig";

              break;
            }
          }
          // header('Location: http://localhost:8081/?p=noticias&id='.$_GET['id']);
        }
      break;

      case 'listado-noticias':
        // TODO
        // $plantilla = "listado-noticias.twig;"
      break;

      case 'imprimir':
        if( isset($_GET['id']) && is_numeric($_GET['id']) ) {
          $datos += $this -> noticias -> getNoticia($_GET['id']);
          $plantilla = "noticia_imprimir.twig";
        }
      break;

      case 'inicio-sesion':
        if( isset($_POST['inicio-sesion']) ) {
          $email  = $_POST['email'];
          $pass   = $_POST['contraseña'];
          $this->usuario->conectar($email, $pass);

          if( isset($_SESSION["correo_usuario"]) )
            header('Location: http://localhost:8081/?p=usuario');
        }
        else if( isset($_POST['registro']) ) {
          $email  = $_POST['email'];
          $nombre = $_POST['nombre'];
          $pass   = $_POST['contraseña'];
          $pass_2 = $_POST['conf_contraseña'];
          $this->usuario->registrar($email, $nombre, $pass, $pass_2);
        }

        $plantilla = 'login.twig';
      break;

      case 'usuario':
        if( isset($_POST['cerrar-sesion']) ) {
          $this->usuario->desconectar();
          header('Location: http://localhost:8081/?p=inicio-sesion');
        }

        if( isset($_POST['edicion']) ) {

          if( !empty($_POST['username']) ) {
            $nombre = $_POST['username'];
            echo $this->usuario->modificarNombre($nombre);
          }
          if( !empty($_POST['pass']) ) {
            $pass = $_POST['pass'];
            $this->usuario->modificarContraseña($pass);
          }

          header('Location: http://localhost:8081/?p=usuario');
        }

        if( isset($_POST['eliminar']) ) {
          $this->usuario->eliminar();
          header('Location: http://localhost:8081/?p=inicio-sesion');
        }
        $plantilla = 'usuario.twig';
      break;

      case 'moderador':
        $mbd = new Comentario();

        if( isset($_POST['busqueda']) ) {
          $comentarios = $mbd->buscarComentarioEmail($_POST['busqueda']);
          $datos += array ("comentarios_busqueda" => $comentarios);
        }

        if( $temp = $mbd->getComentarios() )
          $datos += array("comentarios" => $temp);

        $plantilla = 'moderador.twig';
      break;

    }
    echo $this->twig->render($plantilla, $datos);
    // print_r($datos);
  }
}

?>
