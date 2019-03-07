<?php
  session_start();

  $conexion = mysqli_connect ("localhost", "usuario", "", "museo");

  if ( mysqli_connect_errno() ) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
  }

  mysqli_set_charset($conexion, "utf8");

  $tabla = $_POST['selector'];

  // Modificar Usuario
  if ( $tabla == "Usuarios" ) {
    $username     = $_POST['usuario'];
    $privilegios  = (int)$_POST['privilegios'];
    $modificable = true;

    // Comprobar si es superusuario/administrador
    if ($_POST['tipo']==4) {
       $peticion = "SELECT nombre_usuario FROM Usuarios WHERE privilegios='4'";
      if ( !($administradores = mysqli_query($conexion, $peticion)) )
        die("No se ha podido cambiar el tipo de usuario: " . mysqli_error($conexion));

      $num_filas = mysqli_num_rows($administradores);
      if ( $num_filas <= 1 ){
        $modificable = false;
        echo "<h2>Modificación no permitida. $username es el único administrador.
          <a href='/web_sibw/panelControl.php'>Volver a opciones</a></h2>";
      }
    }

    if ($modificable){
      $modificar_usuario = "UPDATE Usuarios SET privilegios='$privilegios' WHERE nombre_usuario='$username'";
      if ( !mysqli_query($conexion, $modificar_usuario) )
        die("No se ha podido cambiar el tipo de usuario: " . mysqli_error($conexion));
      echo "<h2>Usuario $username modificado con éxito a tipo $privilegios.
        <a href='/web_sibw/panelControl.php'>Volver a opciones</a></h2>";
    }

    mysqli_close($conexion);
  }

  // Modificar Obra
  if ( $tabla == "Obra" ){
    $obra   = $_POST['obra'];
    $titulo = $_POST['titulo'];
    $autor  = $_POST['autor'];
    $desc   = $_POST['desc'];
    $modificar_obra = "UPDATE Obra SET titulo='$titulo', autor='$autor', descripcion='$desc' WHERE id='$obra'";
    if ( !mysqli_query($conexion, $modificar_obra) )
      die("No se ha podido modificar la obra: " . mysqli_error($conexion));

    mysqli_close($conexion);
    echo "<h2>Obra modificada con éxito. <a href='/web_sibw/plantillaObra.php?id=''.$obra.''>Volver a la obra</a></h2>";
  }

  // Modificar comentario
  if ( $tabla == "Comentario" ) {

    mysqli_close($conexion);
    echo " <a href='/web_sibw/panelControl.php'>Volver a opciones</a></h2>";
  }

?>
