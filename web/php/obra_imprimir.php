<?php
  $conexion = mysqli_connect ("localhost", "usuario", "", "museo");

  if ( mysqli_connect_errno() ) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
  }

  mysqli_set_charset($conexion, "utf8");

  $obra = $_GET["id"];
  // Comprobar integridad de datos con JS
  $valido = is_numeric($obra);

  if ($valido){
    $peticion = "SELECT * FROM Obra WHERE id=". $obra;

    if ( !($resultado = mysqli_query ($conexion, $peticion)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));

    $num_filas = mysqli_num_rows ($resultado);

    if( $num_filas > 0 ) {
      $fila         = mysqli_fetch_assoc ($resultado);
      $fecha        = $fila["fechaobra"];
      $descripcion  = $fila["descripcion"];
      $titulo       = $fila["titulo"];
      $autor        = $fila["autor"];
      $imagen       = $fila["imagen"];
      $link         = $fila["vermas"];
      $publicacion  = $fila["fechapublicacion"];
      $edicion      = $fila["fechamodificacion"];
    }
    else
      echo("<script>console.log('PHP: sin datos - ".$num_filas."');</script>");
  }
?>

<html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Museo SIBW</title>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="stylesheet" type="text/css" href="../css/estilo_imprimir.css"
  </head>

  <body>

    <!-- CABECERA: comienzo -->
    <div class="cabecera">
      <!-- Elementos que deben aparecer en la cabecera:
      //  * Título
      //  * Logotipo o imagen
      //  * Menú (navbar)
      -->

      <!-- LOGO: comienzo -->
      <div class="logo">
        <img src="/web_sibw/images/icn_medium_bn.png" alt="Logotipo del museo">
      </div>
      <!-- LOGO: fin -->

      <!-- TÍTULO: comienzo -->
      <div class="titulo">
        <h1>MUSEO DE LO GROTESCO</h1>
      </div>
      <!-- TÍTULO: fin -->

    </div>
    <!-- CABECERA: fin -->


    <div class="encabezado-imagen">
      <!-- INFO DE LA OBRA: comienzo -->
      <div class="meta-obra">
        <!-- Título -->
        <h2 id=titulo-obra>
          "<?php echo $titulo ?>"
        </h2>
        <!-- Título -->
        <!-- Autor -->
        <h4 id=autor>
          Autor: <?php echo $autor ?>
        </h4>
        <!-- Autor -->
        <!-- Fecha -->
        <h4 id=fecha>
          Fecha: <?php echo $fecha ?>
        </h4>
        <!-- Fecha -->
        <!-- Descripición -->
        <div class="descripcion-obra">
          <?php echo $descripcion ?>
        </div>
      </div>
      <!-- Descripción -->
      <!-- Imagen -->
      <div class="imagen-obra">
        <a href="<?php echo $link ?>" title="Ver más"
            target="_blank">
            <img src="<?php echo $imagen ?>" alt="Imagen">
          </a>
      </div>
      <!-- Imagen -->
    </div>
    <!-- Encabezado -->

    <!-- Fechas -->
    <div class="fechas">
      <p>Fecha de publicación: <?php echo $publicacion ?> </p>
      <p>Última modificacion: <?php echo $edicion ?> </p>
    </div>
    <!-- Fechas -->

    <?php include(footer.php) ?>

  </body>

</html>

<?php
  mysqli_close($conexion);
?>
