
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
      $this->desconectar();
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

      if(empty($datos))
        echo "<script>alert('Correo o contraseña incorrectos')</script>";
      else
        echo "<script>alert('Sesión iniciada')</script>";
    }


    /**
     * Desconecta a un usuario del siste,a destruyendo los datos asociados a
     * su sesión.
     */
    public function desconectar() {
      unset($this -> email);
      unset($this -> nombre);
      unset($this -> privilegios);
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
      $exito = true;

      if($pass == $pass_conf) {
        $campos = "email, nombre, contraseña";
        $temp = array($correo, $nombre, $pass);
        $valores = "'" . implode("', '", $temp) . "'";

        $exito = $this->modelo->insertValues($campos, $valores);
      }

      if($exito)
        echo "<script>alert('Registro completo, incie sesión)</script>";
      else
        echo "<script>alert('Falló el registro')</script>";
    }
  }
?>
