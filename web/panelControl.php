<?php
  $conexion = mysqli_connect ("localhost", "usuario", "", "museo");

  if ( mysqli_connect_errno() ) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
  }

  mysqli_set_charset($conexion, "utf8");
?>


<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Museo SIBW</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
      $pagina = "opciones";
      include("php/header.php");
    ?>
    <!-- SECCIONES: comienzo -->
    <div class="secciones">
      <?php
        include("php/sidebar.php");

        if( isset($_SESSION['loggedin']) ){
          include("php/login/opciones.php");
        }
        else {
          include("php/login/login.php");
        }
      ?>
    </div>
    <!-- SECCIONES: fin -->
    <?php
      include("php/footer.php");
    ?>
  </body>

</html>

<?php
  mysqli_close($conexion);
?>
