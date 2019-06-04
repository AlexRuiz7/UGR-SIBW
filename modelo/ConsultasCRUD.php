<?php
/**
 * Conjunto de consultad CRUD
 *    C: CREATE
 *    R: READ
 *    U: UPDATE
 *    D: DELETE
 */
class ConsultasCRUD {
  private $tabla, $bd, $conn;


  /**
   * Constructor
   *
   * @param String $tabla tabla sobre la que actuar
   */
  public function __construct($tabla) {
    $this -> tabla  = (string) $tabla;
    $this -> bd     = new BD();
    $this -> conn   = $this->bd->conectar();

    if(DEBUG)
      echo "Objeto CRUD creado<br />";
  }


  /**
   * Destructor
   */
  public function __destruct() {
    $this->bd->desconectar();

    unset( $this -> tabla );
    unset( $this ->  bd   );
    unset( $this -> conn  );
  }


  ///////////////////////////////////////////////////////////////////
  // MÉTODO PRINCIPAL - envío de las peticiones a la Base de Datos //
  ///////////////////////////////////////////////////////////////////


  /**
   * Envía la petición a la base de datos
   *
   * @param  PDOStatement $sql [description]
   * @return PDOStatement      [description]
   */
  public function consultar($sql) {
    $datos = NULL;

    try {
      $datos = $this->conn->query($sql);
    } catch (PDOException $e) {
      echo "Consulta fallida " . $e->getMessage()."<br/>";
    }
    return $datos;
  }


  ///////////////////////////////////////////////
  // CREATE -- consultas de inserción de datos //
  ///////////////////////////////////////////////


  /**
   * Inserta los pares campo-valor en la tabla.
   *
   * @param  String $campos  campos de la tabla a insertar
   * @param  String $valores nuevos valores de los campos seleccionados
   * @return Bool            true si se ha ejecutado con éxito, false en otro caso
   */
  public function insertValues($campos, $valores) {
    $sql = "INSERT INTO $this->tabla ($campos) VALUES ($valores)";

    return $this->consultar($sql);
  }


  //////////////////////////////////////////////////////////
  // READ -- consultas de lectura y recopilación de datos //
  //////////////////////////////////////////////////////////

  /**
   * Devuelve algunos o todos los valores de una tabla
   *
   * @param  String $campos   campos a mostrar. Por defecto se muestran todos
   * @return PDOStatement     resultados de la consulta
   */
  public function getValues($campos = "*") {
    $sql = "SELECT $campos FROM $this->tabla";

    return $this->consultar($sql);
  }


  /**
   * Consulta y devulve aquellos valores de la base de datos que cumplen las
   * condiciones dadas como argumento.
   *
   * @param  String $campos      campos a mostrar. Por defecto todos.
   * @param  String $condiciones condiciones que debe cumplir la consulta
   * @return PDOStatement        resultados de la consulta
   */
  public function getValuesBy($campos, $condiciones) {
    if(!isset($campos))
      $campos = "*";

    $sql = "SELECT $campos FROM $this->tabla WHERE $condiciones";

    return $this->consultar($sql);
  }

  /**
   * [getValuesOrdered description]
   * @param  [type] $campos [description]
   * @param  [type] $orden  [description]
   * @return [type]         [description]
   */
  public function getValuesOrdered($campos, $orden) {
    $sql = "SELECT $campos FROM $this->tabla ORDER BY $orden";

    return $this->consultar($sql);
  }


  /**
   * [getValuesByOrdered description]
   * @param  [type] $campos      [description]
   * @param  [type] $condiciones [description]
   * @param  [type] $orden       [description]
   * @return [type]              [description]
   */
  public function getValuesByOrdered($campos, $condiciones, $orden) {
    $sql = "SELECT $campos FROM $this->tabla WHERE $condiciones ORDER BY $orden";

    return $this->consultar($sql);
  }


  ///////////////////////////////////////////////////
  // UPDATE -- consultas de actualización de datos //
  ///////////////////////////////////////////////////


  /**
   * Actualiza los pares campo-valor dados de aquellas filas que cumplan las
   * condiciones dadas.
   *
   * @param  String $campos       campos de la tabla sobre los que ejecutar la
   *                              consulta
   * @param  String $condiciones  condiciones sobre las que ejecutar la consulta
   * @return Bool                 true si se ha ejecutado con éxito, false en otro caso
   */
  public function updateValues($campos, $condiciones) {
    // $sql = "UPDATE $this->tabla SET $campos";
    //
    // if(isset($condiciones))
    $sql = "UPDATE IGNORE $this->tabla SET $campos WHERE $condiciones";

    return $this->consultar($sql);
  }


  /////////////////////////////////////////////////
  // DELETE -- consultas de eliminación de datos //
  /////////////////////////////////////////////////


  /**
   * Eliminado las filas que cumplan la condicones dadas
   *
   * @param  String $condiciones  condiciones sobre las que ejecutar la consulta
   * @return Bool                 true si se ha ejecutado con éxito, false en otro caso
   */
  public function deleteBy($condiciones) {
    $sql = "DELETE FROM $this->tabla WHERE $condiciones";

    return $this->consultar($sql);
  }


  /**
   * [debug description]
   * @param  [type] $datos [description]
   * @return [type]        [description]
   */
  private function debug($datos) {
    while ($fila = $datos->fetch(PDO::FETCH_NUM)) {
      echo "<ul>";
      for ($i=0; $i<$datos->columnCount(); $i++)
        echo "<li>" . $fila[$i] . "</li>";
      echo "</ul>";
    }
  }

}
?>
