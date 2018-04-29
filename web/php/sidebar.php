<?php
  $peticion = "SELECT * FROM Obra";

  if ( !($resultado = mysqli_query ($conexion, $peticion)) ) {
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  }

  $num_filas = mysqli_num_rows ($resultado);

  $menu = '<div class="navitem" title="Ir">
    <a href="/web_sibw/">Inicio</a>
  </div>';

  $menu .= '<div class="navitem" title="Ir">
    <a href="#">Información</a>
  </div>';

  if( $num_filas > 0 ) {
    for ($i = 0; $i < $num_filas; $i++) {
      $fila         = mysqli_fetch_assoc ($resultado);
      $titulo       = $fila["titulo"];
      $link         = $i+1;


      $menu .= '<div class="navitem" title="Ir"style="font-variant:  all-small-caps;">
        <a href="plantillaObra.php?id='.$link.'">'.$titulo.'</a>
      </div>';
    }
  }
  else
    echo("<script>console.log('PHP: sin datos - ".$num_filas."');</script>");
?>


<!-- SECCION-LATERAL: comienzo -->
<div class="seccion-lateral">

  <div>
    <h3 align="center">NAVEGADOR</h3>
  </div>

  <?php echo $menu ?>

</div>
<!-- SECCION-LATERAL: fin -->
