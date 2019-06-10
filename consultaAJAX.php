<?php
  require_once dirname(__FILE__).'/vendor/autoload.php';
  require_once dirname(__FILE__).'/config/defines.php';
  require_once __ROOT__.'autoload.php';

  date_default_timezone_set("Europe/Madrid");
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);


  /**
   * [buscar description]
   * @param  [type] $cadena [description]
   * @return [type]         [description]
   */
  function buscar($cadena) {
    $b = new EntidadBase("Noticias");

    $sql = "SELECT titular, id, autor, fecha FROM Noticias WHERE
      titular LIKE '%".$cadena."%' OR
      autor LIKE '%".$cadena."%' OR
      texto LIKE '%".$cadena."%' OR
      fecha LIKE '%".$cadena."%'";

    $datos = $b->modelo->consultar($sql);

    if( !empty($datos) ) {
      $resultados = array();
      while( $fila = $datos->fetch(PDO::FETCH_ASSOC) ) {
        $temp = array(
          "id"      => $fila['id'],
          "titular" => $fila['titular'],
          "autor"   => $fila['autor'],
          "fecha"   => $fila['fecha'],
        );

        array_push($resultados, $temp);
      }
    }
    else {
      $resultados = "No se encontraron resultados";
    }

    header('Content-Type: application/json');
    return json_encode($resultados);
  }

  /**
   * [if description]
   * @var [type]
   */
  if(isset($_POST['cadena'])) {
    echo buscar($_POST['cadena']);
  }

?>
