<?php
  $conexion = mysqli_connect ("localhost", "usuario", "", "museo");

  if ( mysqli_connect_errno() ) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
  }

  mysqli_set_charset($conexion, "utf8");

  $obra   = $_GET["id"];
  $nombre = $_POST["nombre"];
  $email  = $_POST["email"];
  $texto  = $_POST["texto"];
  $ip     = "192.168.1.1";
  $fecha  = date("d-m-Y H:i");

  $insercion = "INSERT INTO Comentario
    (obraref, fechapublicacion, ip, usuario, email, comentario)
  VALUES
    ('$obra', '$fecha', '$ip', '$nombre', '$email', '$texto')";

  if( mysqli_query($conexion, $insercion) )
    echo("<script>console.log('PHP: datos insertados');</script>");
  else {
    echo "Fallo la inserción de datos: " . mysqli_error($conexion);
  }

  mysqli_close($conexion);
?>
