<?php
  $obra = $_GET["id"];
  // Comprobar integridad de datos con JS


  /* Inicializar variables por si la consulta falla */
  $titulo = "Titulo de la Obra";
  $autor  = "Autro de la Obra";
  $fecha  = "Fecha de la Obra";
  $descripcion =
    "Nulla non felis nec massa sodales tristique eget vitae quam. Ut placerat
    egestas finibus. Sed volutpat ipsum at feugiat sagittis. Mauris laoreet vel
    orci id aliquet. Aliquam ultricies nisi eu facilisis cursus. Nunc feugiat
    odio porttitor orci fringilla, sed condimentum libero dignissim. Curabitur
    euismod nulla eu nibh rhoncus sollicitudin. Quisque condimentum tempor
    commodo. Aliquam dignissim suscipit turpis eu laoreet. Nullam ac dui at eros
    gravida malesuada. Integer viverra tempor efficitur. Aliquam semper ipsum id
    tristique pellentesque. Maecenas aliquet nunc sit amet nisl ultrices,
    pellentesque egestas velit interdum.";

  if($obra <> "") {

    $conexion = mysqli_connect ("localhost", "usuario", "", "museo");
    $abreBD = mysqli_select_db ("museo", $conexion);

    if ( mysqli_connect_errno() ) {
      die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
    }

    mysqli_set_charset($conexion, "utf8");
    $peticion = "SELECT * FROM Obra WHERE id=" . $obra;

    if ( !($resultado = mysqli_query ($conexion, $peticion)) ) {
      die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
    }

    $num_filas = mysqli_num_rows ($resultado);

    if ($num_filas > 0) {
      $fila         = mysqli_fetch_assoc ($resultado);
      $fecha        = $fila["fechaobra"];
      $descripcion  = $fila["description"];
      $titulo       = $fila["title"];
      $autor        = $fila["author"];
      $imagen       = $fila["imagelink"];
      $link         = $fila["seemorelink"];
    }
    else{
      echo("<script>console.log('PHP: sin datos - ".$num_filas."');</script>");
    }

    mysqli_close ($conexion);
  }
?>

<!-- OBRA: comienzo  -->
<div class="obra">

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

  <!-- Enlaces -->
  <div class="enlaces">
    <a href="https://www.facebook.com/" target="_blank" title="Compartir en Facebook">
      <img src="icons/fb_ico.png"/>
    </a>
    <a href="https://twitter.com/" target="_blank" title="Compartir en Twitter">
      <img src="icons/tw_ico.png"/>
    </a>
    <a href="obra_imprimir.html" target="_blank" title="Imprimir">
      <img src="icons/print.png"/>
    </a>
  </div>
  <!-- Enlaces -->
</div>
<!-- OBRA: fin -->
