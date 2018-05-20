<?php
  $conexion = mysqli_connect ("localhost", "usuario", "", "museo");

  if ( mysqli_connect_errno() ) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
  }

  mysqli_set_charset($conexion, "utf8");

  // Buscar usuario
  $buscar_usuario = "SELECT * FROM Usuarios WHERE nombre_usuario='$_POST[usuario]'";

  if ( !($resultado = mysqli_query($conexion, $buscar_usuario)) )
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));

  $num_filas = mysqli_num_rows($resultado);
  if ($num_filas >= 1){
    echo "Ese nombre de usuario ya existe";
    echo "<a href='/web_sibw/login.php'>Volver al registro</a>";
  }
  else {
    $insertar = "INSERT INTO Usuarios (nombre_usuario, email, password) VALUES ('$_POST[usuario]', '$_POST[email]', '$_POST[clave]')";

    if ( !($resultado = mysqli_query($conexion, $insertar)) )
      die("No se han podido insertar los datos: " . mysqli_error($conexion));
    echo "<p>Tu cuenta ha sido creada correctamente. Ya puedes iniciar sesión.</p>";
    echo "<p> <a href='/web_sibw/panelControl.php'>Volver e iniciar sesión</a> </p>";
  }
  mysqli_close($conexion);
?>
