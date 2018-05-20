<?php
  session_start();

  $conexion = mysqli_connect ("localhost", "usuario", "", "museo");

  if ( mysqli_connect_errno() ) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
  }

  mysqli_set_charset($conexion, "utf8");

  $username = $_POST['usuario'];
  $password = $_POST['clave'];
  $email    = $_POST['email'];

  // Petciones a la Base de Datos
  $modificar_nombre = "UPDATE Usuarios SET nombre_usuario='$username' where nombre_usuario='$_SESSION[username]'";
  $modificar_email  = "UPDATE Usuarios SET email='$email' where nombre_usuario='$_SESSION[username]'";
  $modificar_clave  = "UPDATE Usuarios SET password='$password' where nombre_usuario='$_SESSION[username]'";

  // Modificar clave, si se ha indicado
  if ( strlen($password) != 0 ){
    if ( !mysqli_query($conexion, $modificar_clave) )
      die("No se ha podido cambiar la contraseña: " . mysqli_error($conexion));
    echo "<p>Tu contraseña ha sido modificada correctamente</p>";
  }

  // Modificar correo, si se ha indicado
  if ( strlen($email) != 0 ){
    if ( !mysqli_query($conexion, $modificar_email) )
      die("No se ha podido cambiar el email: " . mysqli_error($conexion));
    echo "<p>Tu correo electrónico ha sido modificado correctamente</p>";
  }

  // Modificar nombre, si se ha indicado
  if ( strlen($username) != 0 ){
    if ( !mysqli_query($conexion, $modificar_nombre) )
      die("No se ha podido cambiar lel nombre: " . mysqli_error($conexion));
    $_SESSION['username'] = $username;
    echo "<p>Tu nombre de usuario ha sido modificado correctamente</p>";
  }

  mysqli_close($conexion);

  echo "<p> <a href='/web_sibw/panelControl.php'>Volver a opciones</a> </p>";
?>
