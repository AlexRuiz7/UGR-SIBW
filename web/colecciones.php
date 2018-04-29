<?php
  $conexion = mysqli_connect ("localhost", "usuario", "", "museo");

  if ( mysqli_connect_errno() ) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
  }

  mysqli_set_charset($conexion, "utf8");

  $peticion = "select * from Coleccion";

  if ( !($resultado = mysqli_query ($conexion, $peticion)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));

  $num_filas = mysqli_num_rows ($resultado);

  if( $num_filas > 0 )
    for($i=0; $i<$num_filas; $i++){
      $fila         = mysqli_fetch_assoc ($resultado);
      $titulo       = $fila["tituloColeccion"];
      $descripcion   = $fila["descripcion"];

      $html        .= '
        <div class="titulo">
          <h2>'.$titulo.'</h2>
          <p>'.$descripcion.'</p>
        </div>';
    }
?>


<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Museo SIBW</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
      include("php/header.php");
      ?>
      <!-- SECCIONES: comienzo -->
      <div class="secciones">
        <?php include("php/sidebar.php"); ?>
        <div class="colecciones">
          <?php echo $html ?>
        </div>
      </div>
      <!-- SECCIONES: fin -->
      <?php
        include("php/footer.php");
      ?>
  </body>

</html>

<?php
  mysqli_close($conexion);
?>
