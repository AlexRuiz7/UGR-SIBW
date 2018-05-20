<?php
  session_start();

  $conexion = mysqli_connect ("localhost", "usuario", "", "museo");

  if ( mysqli_connect_errno() ) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
  }

  mysqli_set_charset($conexion, "utf8");

  $username     = $_POST['usuario'];
  $privilegios  = (int)$_POST['privilegios'];
  $tabla        = $_POST['selector'];

  // Petciones a la Base de Datos
  $modificar_tipo = "UPDATE $tabla SET privilegios='$privilegios' WHERE nombre_usuario='$username'";

  // Modificar nombre, si se ha indicado
  if ( !mysqli_query($conexion, $modificar_tipo) )
    die("No se ha podido cambiar el tipo de usuario: " . mysqli_error($conexion));

  mysqli_close($conexion);

  echo "<br />".$username;
  echo "<br />".$privilegios;
  echo "<br />".$username;

  echo "<p> <a href='/web_sibw/panelControl.php'>Volver a opciones</a> </p>";
?>
