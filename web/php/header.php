<?php
  $peticion_nombre = "SELECT valorDato FROM DatosWeb WHERE nombreDato='NombreMuseo'";
  $peticion_imagen = "SELECT valorDato FROM DatosWeb WHERE nombreDato='Imagen_M'";
  $peticion_url    = "SELECT valorDato FROM DatosWeb WHERE nombreDato='Navegador1'";
  $peticion_info   = "SELECT valorDato FROM DatosWeb WHERE nombreDato='Navegador2'";

  if ( !($resultado = mysqli_query ($conexion, $peticion_nombre)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $titulo       = $fila["valorDato"];

  if ( !($resultado = mysqli_query ($conexion, $peticion_imagen)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $imagen       = $fila["valorDato"];

  if ( !($resultado = mysqli_query ($conexion, $peticion_url)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $inicio       = $fila["valorDato"];

  if ( !($resultado = mysqli_query ($conexion, $peticion_info)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $informacion  = $fila["valorDato"];
?>


<!-- CABECERA: comienzo -->
<div class="cabecera">
  <!-- Elementos que deben aparecer en la cabecera:
  //  * Título
  //  * Logotipo o imagen
  //  * Menú (navbar)
  -->

  <!-- LOGO: comienzo -->
  <div class="logo">
    <a class="imagen" href=<?php echo $inicio ?> title="Ir a inicio">
      <img src=<?php echo $imagen ?> alt="Logotipo del museo">
    </a>
  </div>
  <!-- LOGO: fin -->

  <!-- TITULO-CABECERA: comienzo -->
  <div class="titulo-cabecera">
    <!-- TÍTULO: comienzo -->
    <div class="titulo">
      <h1><?php echo $titulo ?></h1>
    </div>
    <!-- TÍTULO: fin -->

    <!-- MENU: comienzo -->
    <div class="navbar">
      <a class="navitem active" href=<?php echo $inicio ?> title="Ir a inicio">Inicio</a>
      <a class="navitem" href="colecciones.php" title="Listado de obras">Obras</a>
      <a class="navitem" href=<?php echo $informacion ?> title="Ir a detalles">Conócenos</a>
    </div>
    <!-- MENU: fin -->
  </div>
  <!-- TITULO-CABECERA: fin -->
</div>
<!-- CABECERA: fin -->
