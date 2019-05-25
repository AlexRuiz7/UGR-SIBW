
<?php

  class Usuario extends EntidadBase {
    private $usuario;


    /**
     * Constructor
     */
    public function __construct() {
      parent::__construct("Usuarios");
    }


    /**
     * Destructor
     */
    public function __destruct() {
      parent::__destruct();
      // $this->desconectar();
    }

    private function initUsuario() {

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

      if($datos['email']==$correo && $datos['contraseña']==$pass) {
        $_SESSION['nombre_usuario'] = $datos['nombre'];
        $_SESSION['correo_usuario'] = $datos['email'];
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
      unset($this -> privilegios);
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

      if($pass == $pass_conf) {
        $campos = "email, nombre, contraseña";
        $temp = array($correo, $nombre, $pass);
        $valores = "'" . implode("', '", $temp) . "'";

        $this->modelo->insertValues($campos, $valores);
      }

      if( isset($_SESSION["correo_usuario"]) )
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

      if( $this->modelo->updateValues("nombre='$nombre'", "email='$pk'") ) {
        $_SESSION['nombre_usuario'] = $nombre;
      }
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

  }
?>
