<?php
  $obra = $_GET["id"];
  // Comprobar integridad de datos con JS
  $valido = is_numeric($obra);

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

  if($valido) {

    $peticion = "SELECT * FROM Obra WHERE id=" . $obra;

    if ( !($resultado = mysqli_query ($conexion, $peticion)) ) {
      die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
    }

    $num_filas = mysqli_num_rows ($resultado);

    if ($num_filas > 0) {
      $fila         = mysqli_fetch_assoc ($resultado);
      $fecha        = $fila["fechaobra"];
      $descripcion  = $fila["descripcion"];
      $titulo       = $fila["titulo"];
      $autor        = $fila["autor"];
      $imagen       = $fila["imagen"];
      $link         = $fila["vermas"];
      $publicacion  = $fila["fechapublicacion"];
      $edicion      = $fila["fechamodificacion"];
      $id           = $fila["id"];
    }
    else{
      echo("<script>console.log('PHP: sin datos - ".$num_filas."');</script>");
    }
  }

  $usuario_avanzado = false;
  if (($_SESSION['tipo'] == 'gestor') || ($_SESSION['tipo'] == 'admin'))
  $usuario_avanzado = true;
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

  <!-- Fechas -->
  <div class="fechas">
    <p>Fecha de publicación: <?php echo $publicacion ?> </p>
    <p>Última modificacion: <?php echo $edicion ?> </p>
  </div>
  <!-- Fechas -->

  <!-- Enlaces -->
  <div class="enlaces <?php if( $usuario_avanzado ) {echo 'gestor';} ?>">
    <a name="fb" title="Compartir en Facebook" href="" onclick="compartir();return false;">
      <img src="icons/fb_ico.png"/>
    </a>
    <a name="tw" title="Compartir en Twitter" onclick="compartir();return false;" href="" >
      <img src="icons/tw_ico.png"/>
    </a>
    <a href="/web_sibw/php/obra_imprimir.php?id=<?php echo $obra ?>" target="_blank" title="Imprimir">
      <img src="icons/print.png"/>
    </a>
    <?php
      if ( $usuario_avanzado ) {
        echo '<a title="Borrar obra">
                <form action="php/borrar.php" method="POST">
                  <input type="hidden" name="id" value="'.$id.'" />
                  <input type="hidden" name="obra" value="'.$obra.'" />
                  <input type="hidden" name="selector" value="Obra" />
                  <input type="image" name="submit" src="/web_sibw/icons/trash.png" />
                </form>
              </a>';
        echo '<a title="Editar obra">
                <form action="php/editar.php" method="POST">
                  <input type="hidden" name="id" value="'.$id.'" />
                  <input type="hidden" name="selector" value="Obra" />
                  <input type="image" name="submit" src="/web_sibw/icons/edit.png" />
                </form>
              </a>';
      }
    ?>
  </div>
  <!-- Enlaces -->

  <!-- Modal -->
  <div id="compartir" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <span id="cerrar" class="close">&times;</span>
        <h2>COMPARTIR</h2>
      </div>
      <div class="modal-body">
        <div class="compartir">
          <p>Se publicará en Twitter/Facebook el siguiente mensaje:</p>
          <p> <?php echo $titulo ?> </p>
          <div class="imagen">
            <img src="/web_sibw/images/The_chapman_brothers_128.jpg" alt="Imagen">
          </div>
          <p>
            via @MuseoDeLoGrotesco
          </p>
        </div>
      </div>
      <div class="modal-footer">
        <h3>Modal Footer</h3>
      </div>
    </div>

  </div>
  <!-- Modal -->

</div>
<!-- OBRA: fin -->
