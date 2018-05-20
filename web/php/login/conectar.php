<?php
  session_start();

  $conexion = mysqli_connect ("localhost", "usuario", "", "museo");

  if ( mysqli_connect_errno() ) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
  }

  mysqli_set_charset($conexion, "utf8");

  $username = $_POST['usuario'];
  $password = $_POST['clave'];

  $peticion = "SELECT * FROM Usuarios WHERE nombre_usuario = '$username'";

  if ( !($resultado = mysqli_query($conexion, $peticion)) )
    die("No se ha podido encontrar al usuario: " . mysqli_error($conexion));

  $num_filas = mysqli_num_rows($resultado);

  if ($num_filas != 0){
    $fila = mysqli_fetch_assoc($resultado);
    if( $password === $fila['password'] ){
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;
      $_SESSION['email']    = $fila['email'];
      $_SESSION['start']    = time();
      $_SESSION['expire']   = $_SESSION['start'] + (10*60);
      switch ($fila['privilegios']) {
        case 1:
          $_SESSION['tipo'] = "usuario";
          break;
        case 2:
          $_SESSION['tipo'] = "moderador";
          break;
        case 3:
          $_SESSION['tipo'] = "gestor";
          break;
        case 4:
          $_SESSION['tipo'] = "admin";
          break;
      }

      // echo "<h2> Bienvenido " . $username . " </h2>";
      // echo "<p> <a href='/web_sibw/index.php'>Volver a página principal</a> </p>";
      header('Location: http://localhost:8080/web_sibw/panelControl.php');
    }
  }
  else {
    echo "<p> Usuario o contraseña incorrectos </p>";
    echo "<p> <a href='/web_sibw/panelControl.php'>Volver a intentarlo</a> </p>";
  }
  mysqli_close($conexion);
?>
