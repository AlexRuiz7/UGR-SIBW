<?php
  session_start();

  $conexion = mysqli_connect ("localhost", "usuario", "", "museo");

  if ( mysqli_connect_errno() ) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
  }

  mysqli_set_charset($conexion, "utf8");

  $tabla = $_POST['selector'];

  if($tabla == "Obra"){
    $borrar_comentarios = "DELETE FROM Comentario WHERE obraref='$_POST[id]'";
    if ( !mysqli_query($conexion, $borrar_comentarios) )
      die ("No se han podido borrar las dependencias" . mysqli_error($conexion));

    $borrar_colecciones = "DELETE FROM EnColeccion WHERE idObra='$_POST[id]'";
    if ( !mysqli_query($conexion, $borrar_colecciones) )
      die ("No se han podido borrar las dependencias: " . mysqli_error($conexion));

    $borrar = "DELETE FROM Obra WHERE id='$_POST[id]'";

    if ( !mysqli_query($conexion, $borrar) )
    die ("No se ha podido borrar: " . mysqli_error($conexion));
  }

  if($tabla == "Usuarios"){
    $borrar_usuario = "DELETE FROM Usuarios WHERE nombre_usuario='$_POST[usuario]'";
    if ( !mysqli_query($conexion, $borrar_usuario) )
      die ("No se ha podido borrar el usuario: " . mysqli_error($conexion));
  }

  mysqli_close($conexion);

  header("Location: http://localhost:8080/web_sibw/panelControl.php");
?>
