<?php

class BD {
  private $host, $user, $pass, $database, $charset;
  private $conn;


  /**
   * Constructor
   *
   * Recoge los parámetros de configuración de la base de datos.
   */
  public function __construct() {
    $db_cfg = require __ROOT__.'config/BDconfig.php';
    $this -> host     = $db_cfg["host"];
    $this -> user     = $db_cfg["user"];
    $this -> pass     = $db_cfg["pass"];
    $this -> database = $db_cfg["database"];
    $this -> charset  = $db_cfg["charset"];

    if(DEBUG)
      echo "Objeto BD creado<br/>";
  }


  /**
   * Método que realiza la conexión a la base de datos
   *
   * @return
   */
  public function conectar() {
    $dsn = "mysql:dbname=" . $this->database;

    try {
      $this->conn = new PDO($dsn, $this->user, $this->pass);
      $this->conn->exec("SET NAMES $this->charset");
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
      echo "Falló la conexión: " . $e->getMessage() . '<br />';
    }

    if(DEBUG)
      echo "Conexión establecida con " . $this->host .'<br/>';

    return $this->conn;
  }


  /**
   * Destruye la conexión con la base de datos
   */
  public function desconectar() {
    unset($this->conn);

    if(DEBUG)
      echo "Desconectado de " . $this->host;
  }
}

?>
