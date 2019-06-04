
<?php

  class Usuario extends EntidadBase {
    private $email, $nombre, $tipo;
    public $data;


    /**
     * Constructor
     */
    public function __construct() {
      parent::__construct("Usuarios");
      // $_SESSION['tipo'] = "baxsico";
    }


    /**
     * Destructor
     */
    public function __destruct() {
      parent::__destruct();
      // $this->desconectar();
    }


    /**
     * Conecta un usuario al sistema.
     * Un usuario realiza una conexión con éxito cuando su correo electrónico
     * y su contraseña coinciden con las proporcionadas en el formulario.
     *
     * El usuario debe existir en la base de datos.
     * @param  [type] $correo [description]
     * @param  [type] $pass   [description]
     */
    public function conectar($correo, $pass) {
      $datos = $this->modelo->getValuesBy("*", "email='$correo'")->fetch(PDO::FETCH_ASSOC);

      if(!isset($datos)) {
        echo "<script>alert('Fallo en la bd)</script>";
        return false;
      }


      if($datos['email']==$correo && $datos['contraseña']==$pass) {
        $_SESSION['nombre_usuario'] = $datos['nombre'];
        $_SESSION['correo_usuario'] = $datos['email'];
        $_SESSION['tipo'] = $datos['tipo'];

        $this->nombre = $datos['nombre'];
        $this->email = $datos['email'];
        $this->tipo = $datos['tipo'];
      }

      if( isset($_SESSION['nombre_usuario']) ) {
        echo "<script>alert('Sesión iniciada')</script>";
        return true;
      }
      else {
        echo "<script>alert('Correo o contraseña incorrectos')</script>";
        return false;
      }
    }


    /**
     * Desconecta a un usuario del sistema destruyendo los datos asociados a
     * su sesión.
     */
    public function desconectar() {
      unset($this -> email);
      unset($this -> nombre);
      unset($this -> tipo);
      unset($_SESSION['nombre']);
      unset($_SESSION['email']);
      unset($_SESSION['tipo']);
      session_unset();
      session_destroy();
    }


    /**
     * [registrar description]
     * @param  [type] $correo    [description]
     * @param  [type] $nombre    [description]
     * @param  [type] $pass      [description]
     * @param  [type] $pass_conf [description]
     * @return [type]            [description]
     */
    public function registrar($correo, $nombre, $pass, $pass_conf) {
      $exito = false;

      if($pass == $pass_conf) {
        $campos = "email, nombre, contraseña";
        $temp = array($correo, $nombre, $pass);
        $valores = "'" . implode("', '", $temp) . "'";

        $exito = $this->modelo->insertValues($campos, $valores);
      }

      if( $exito )
        echo "<script>alert('Registro completo, incie sesión)</script>";
      else
        echo "<script>alert('Falló el registro')</script>";
    }


    /**
     * [modificar description]
     * @param  [type] $campos  [description]
     * @param  [type] $valores [description]
     * @return [type]          [description]
     */
    public function modificarNombre($nombre) {
      $pk = $_SESSION['correo_usuario'];

      if( $this->modelo->updateValues("nombre='$nombre'", "email='$pk'") != NULL) {
        $_SESSION['nombre_usuario'] = $nombre;
      }
      return gettype($datos);
    }


    /**
     * [modificarContraseña description]
     * @param  [type] $pass [description]
     * @return [type]       [description]
     */
    public function modificarContraseña($pass) {
      $pk = $_SESSION['correo_usuario'];


      $this->modelo->updateValues("contraseña='$pass'", "email='$pk'");
    }


    /**
     * [eliminar description]
     * @return [type] [description]
     */
    public function eliminar() {
      $pk = $_SESSION['correo_usuario'];
      $this->modelo->deleteBy("email='$pk'");
      $this->desconectar();
    }


    ////////////////////////////////////////////////////
    // GETTERS - funciones de consulta de información //
    ////////////////////////////////////////////////////

    public function getNombre() {
      return $this->nombre;
    }

    public function getCorreo() {
      return $this->email;
    }

    public function getTipo() {
      // echo $this->tipo;
      switch ($this->tipo) {
        case 'R':   $tipo_usuario = "Registrado";   break;
        case 'M':   $tipo_usuario = "Moderador";    break;
        case 'G':   $tipo_usuario = "Gestor";       break;
        case 'X':   $tipo_usuario = "Admin.";       break;
        default :   $tipo_usuario = "unset";        break;
      }

      // return $tipo_usuario;
      return $this->tipo;
    }


    /////////////////////////////////
    // Funciones de Administrador  //
    /////////////////////////////////


    public function buscarUsuario($email) {
      $datos = $this->modelo->getValuesBy("*", "email='$email'")->fetch(PDO::FETCH_ASSOC);

      return array( "nombre" => $datos['nombre'],
                    "correo" => $datos['email'],
                    "tipo"   => $datos['tipo']);
    }



    public function editarUsuario($email, $tipo) {

      // Recuperar tipo actual de usuario
      $tipo_usuario = $this->modelo->getValuesBy("tipo", "email='$email'")->fetch(PDO::FETCH_ASSOC)['tipo'];
      // Si es admin y se le va a quitar ese nivel, comprobamos si es el último.
       // && $tipo!='admin'
      if($tipo_usuario=='admin') {
        $datos = $this->modelo->getValuesBy("tipo", "tipo='admin'")->fetchAll(PDO::FETCH_ASSOC);
        if(count($datos)==1)
          return false;
      }

      $this->modelo->updateValues("tipo='$tipo'", "email='$email'");
    }

  }
?>
