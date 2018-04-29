<?php
  $peticion_direccion = "SELECT valorDato FROM DatosWeb WHERE nombreDato='Direccion'";
  $peticion_fijo   = "SELECT valorDato FROM DatosWeb WHERE nombreDato='TelefonoFijo'";
  $peticion_movil  = "SELECT valorDato FROM DatosWeb WHERE nombreDato='TelefonoMovil'";
  $peticion_correo = "SELECT valorDato FROM DatosWeb WHERE nombreDato='Correo'";
  $peticion_fb   = "SELECT valorDato FROM DatosWeb WHERE nombreDato='Facebook'";
  $peticion_ig   = "SELECT valorDato FROM DatosWeb WHERE nombreDato='Instagram'";
  $peticion_tw   = "SELECT valorDato FROM DatosWeb WHERE nombreDato='Twitter'";

  if ( !($resultado = mysqli_query ($conexion, $peticion_direccion)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $direccion       = $fila["valorDato"];

  if ( !($resultado = mysqli_query ($conexion, $peticion_fijo)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $fijo       = $fila["valorDato"];

  if ( !($resultado = mysqli_query ($conexion, $peticion_movil)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $movil       = $fila["valorDato"];

  if ( !($resultado = mysqli_query ($conexion, $peticion_correo)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $correo  = $fila["valorDato"];

  if ( !($resultado = mysqli_query ($conexion, $peticion_fb)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $fb  = $fila["valorDato"];

  if ( !($resultado = mysqli_query ($conexion, $peticion_ig)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $ig  = $fila["valorDato"];

  if ( !($resultado = mysqli_query ($conexion, $peticion_tw)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  $fila         = mysqli_fetch_assoc ($resultado);
  $tw  = $fila["valorDato"];
?>



<!-- FOOTER: comienzo -->
<div class="footer">

  <div id="informacion">
    <p class="bold">Dirección:</p>
    <p><?php echo $direccion ?></p>
    <p class="bold">Teléfono:</p>
    <p><?php echo $fijo . " ," . $movil ?></p>
    <p class="bold">Correo:</p>
    <p><?php echo $correo ?></p>
  </div>

  <div id="mapa">
    <a class="imagen" href="https://www.google.es/maps" target="_blank" title="Abrir Google Maps">
      <img class="map" src="images/madrid-map.gif">
    </a>
  </div>

  <div id="copyright">
    <p>Al acceder a esta página confirmas haber leído y aceptado nuestros
       términos de servicio, cookies y políticas de privacidad.</p>
    <p>Copyright 1999-2018.</p>
    <p>Todos los derechos reservados.</p>
  </div>

  <div id="rrss">
    <a href="<?php echo $fb ?>" target="_blank" title="Estamos en Facebook">
      <img src="icons/fb_ico.png"/>
    </a>
    <a href="<?php echo $ig ?>" target="_blank" title="Estamos en Instagram">
      <img src="icons/ig_ico.png"/>
    </a>
    <a href="<?php echo $tw ?>" target="_blank" title="Estamos en twitter">
      <img src="icons/tw_ico.png"/>
    </a>
  </div>

  <span>
    <img src="images/icn_small.png" alt="Logotipo del museo">
  </span>

</div>
<!-- FOOTER: fin -->

<!-- <button onclick="document.documentElement.scrollTop = 0;" id="scroll" title="Volver a arriba"></button> -->
