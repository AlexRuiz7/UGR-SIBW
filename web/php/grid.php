<?php
  $peticion = "SELECT * FROM Obra";

  if ( !($resultado = mysqli_query ($conexion, $peticion)) ) {
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  }

  $num_filas = mysqli_num_rows ($resultado);

  $divs = array();

  if ( $num_filas > 0)
    for ($i = 0; $i < $num_filas; $i++) {
      $fila         = mysqli_fetch_assoc ($resultado);
      $titulo       = $fila["titulo"];
      $imagen       = $fila["imagen"];
      $id           = $i+1;

      $divs[] ='<a href="plantillaObra.php?id='.$id.'" title="Visitar Obra">
        <img src="'.$imagen.'" class="imagen">
        </a>
        <div class="titulo-obra" >"'.$titulo.'"</div>';
    }
  else
    echo("<script>console.log('PHP: sin datos - ".$num_filas."');</script>");
?>



<!-- GRID: comienzo  -->
<div class="grid">
  <div class="box">
    <?php echo $divs[0] ?>
  </div>
  <div class="box">
    <?php echo $divs[1] ?>
  </div>
  <div class="box">
    <?php echo $divs[2] ?>
  </div>
  <div class="box">
    <?php echo $divs[3] ?>
  </div>
  <div class="box">
    <p>En construcción #5</p>
  </div>
  <div class="box">
    <p>En construcción #6</p>
  </div>
  <div class="box">
    <p>En construcción #7</p>
  </div>
  <div class="box">
    <p>En construcción #8</p>
  </div>
  <div class="box">
    <p>En construcción #9</p>
  </div>
</div>
<!-- GRID: fin -->
