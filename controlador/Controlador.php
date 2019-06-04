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

      if( $_SESSION['tipo'] != 'registrado' ) {
        $datos += array('tipo_usuario' => $_SESSION['tipo']);
      }
    }

    $plantilla = '404.twig';

    switch ($this->pagina) {

      /* ##### */

      case 'inicio':
        $datos += $this -> noticias -> getGridInicio();
        $plantilla = "inicio.twig";
      break;

      /* ##### */

      case 'noticias':
        if( isset($_GET['id']) && is_numeric($_GET['id']) ) {
          $datos += $this -> noticias -> getNoticia($_GET['id']);
          $plantilla = "noticia.twig";

          if(isset($_SESSION['tipo'])) {
            $tipo = $_SESSION['tipo'];

            switch ($tipo) {
              case 'moderador':
                $plantilla = "noticia_moderador.twig";
                $this->noticiaModerador();
              break;

              case 'gestor':
                $plantilla = "noticia_gestor.twig";
                $this->noticiaGestor();
              break;

              case 'admin':
                $plantilla = "noticia_admin.twig";
                $this->noticiaModerador();
                $this->noticiaGestor();
              break;
            }
          }
          // header('Location: http://localhost:8081/?p=noticias&id='.$_GET['id']);
        }
      break;

      /* ##### */

      case 'listado-noticias':
        // TODO
        // $plantilla = "listado-noticias.twig;"
      break;

      /* ##### */

      case 'imprimir':
        if( isset($_GET['id']) && is_numeric($_GET['id']) ) {
          $datos += $this -> noticias -> getNoticia($_GET['id']);
          $plantilla = "noticia_imprimir.twig";
        }
      break;

      /* ##### */

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

      /* ##### */

      case 'usuario':
        $this->opcionesUsuario();
        $plantilla = 'usuario.twig';
      break;

      /* ##### */

      case 'moderador':
        if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])) {
          $datos = $this->opcionesModerador($datos);
          $plantilla = 'moderador.twig';
        }
      break;

      /* ##### */

      case 'gestor':
        if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])) {
          $datos = $this->opcionesGestor($datos);
          $plantilla = 'gestor.twig';
        }
      break;

      /* ##### */

      case 'admin':
        if(isset($_SESSION['tipo']) && !empty($_SESSION['tipo'])) {
          $datos = $this->opcionesAdmin($datos);
          $datos = $this->opcionesGestor($datos);
          $datos = $this->opcionesModerador($datos);
          $plantilla = 'admin.twig';
        }
      break;

    }
    echo $this->twig->render($plantilla, $datos);
  }


  /**
   * [noticiaModerador description]
   * @return [type] [description]
   */
  private function noticiaModerador() {
    if( isset($_POST['editar']) && !empty($_POST['texto']) ) {
      $this->noticias->editarComentario($_POST['texto'], $_POST['index']);
      header('Location: http://localhost:8081/?p=noticias&id='.$_GET['id']);
    }
    else if(isset($_POST['borrar'])) {
      $this->noticias->borrarComentario($_POST['index']);
      header('Location: http://localhost:8081/?p=noticias&id='.$_GET['id']);
    }
  }


  /**
   * [noticiaGestor description]
   * @return [type] [description]
   */
  private function noticiaGestor() {
    if( isset($_POST['etiquetas']) ) {
      $etiquetas = NULL;

      if(empty($_POST['texto'])) {
        $this->noticias->borrarEtiquetas($_GET['id']);
      }
      else{
        $etiquetas = explode(",", $_POST['texto']);
        foreach ($etiquetas as $i) {
          $this->noticias->editarEtiquetas(strtoupper($i), $_GET['id']);
        }
      }
      header('Location: http://localhost:8081/?p=noticias&id='.$_GET['id']);
    }
    if( isset($_POST['evento']) ) {
      $this->noticias->borrarEvento($_GET['id']);
      header('Location: http://localhost:8081/?p=gestor');
    }
  }


  /**
   * [opcionesUsuario description]
   * @return [type] [description]
   */
  private function opcionesUsuario() {
    if( isset($_POST['cerrar-sesion']) ) {
      $this->usuario->desconectar();
      header('Location: http://localhost:8081/?p=inicio-sesion');
    }

    if( isset($_POST['edicion']) ) {

      if( !empty($_POST['username']) ) {
        $nombre = $_POST['username'];
        $this->usuario->modificarNombre($nombre);
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
  }


  /**
   * [opcionesModerador description]
   * @return [type] [description]
   */
  private function opcionesModerador($l_datos) {
    $mbd = new Comentario();

    if( isset($_POST['busqueda_moderador']) ) {
      $comentarios = $mbd->buscarComentarioEmail($_POST['busqueda_moderador']);
      $l_datos += array ("comentarios_busqueda" => $comentarios);
    }

    if( $temp = $mbd->getComentarios() ) {
      $l_datos += array("comentarios" => $temp);
    }

    return $l_datos;
  }

  /**
   * [opcionesGestor description]
   * @return [type] [description]
   */
  private function opcionesGestor($l_datos) {
    if( isset($_POST['busqueda_gestor']) ) {
      $eventos = NULL;

      // Separa etiquetas por ',' y almacena sin espacios y en mayúsculas,
      $post_etq = explode(",", $_POST['busqueda_gestor']);
      foreach($post_etq as $item) {
        $etiqueta = strtoupper(trim($item));
        // echo $etiqueta.PHP_EOL;
        $eventos = $this->noticias->buscarEvento($etiqueta);
      }
      $l_datos += array("eventos_busqueda" => $eventos);
    }

    if( $temp = $this->noticias->getNoticias() ) {
      $l_datos += array("noticias" => $temp);
    }

    return $l_datos;
  }


  /**
   * [opcionesAdmin description]
   * @return [type] [description]
   */
  private function opcionesAdmin($l_datos) {
    if( isset($_POST['busqueda_admin']) ) {
      $usuario = NULL;
      $email = strtoupper(trim($_POST['busqueda_admin']));
      $usuario = $this->usuario->buscarUsuario($email);
      $l_datos += array("usuario_busqueda" => $usuario);
    }

    if( isset($_POST['tipo_usuario']) ) {
      $this->usuario->editarUsuario($_POST['email'], $_POST['tipo_usuario']);
    }

    return $l_datos;
  }

}

?>
