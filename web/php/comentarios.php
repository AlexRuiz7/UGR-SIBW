<?php
  $peticion = "SELECT * FROM Comentario WHERE obraref=".$obra;

  if ( !($resultado = mysqli_query ($conexion, $peticion)) ) {
    die("No se ha podido realizar la peticion: " . mysqli_error($conexion));
  }

  $num_filas = mysqli_num_rows ($resultado);

  if( $num_filas > 0 ) {
    for ($i = 0; $i < $num_filas; $i++) {
      $fila         = mysqli_fetch_assoc ($resultado);
      $fecha        = $fila["fechapublicacion"];
      $usuario      = $fila["usuario"];
      $comentario   = $fila["comentario"];
      $id           = $fila["id"];

      if( ($_SESSION['tipo'] == "moderador") || ($_SESSION['tipo'] == "admin") ){
        $moderador = '<form action="/web_sibw/php/borrar.php" method="POST"
        style="place-self: center;">
          <input type="hidden" name="id"     value='.$id.'   />
          <input type="hidden" name="obra"   value='.$obra.' />
          <input type="hidden" name="selector" value="Comentario" />
          <input type="image"  name="submit" value="Borrar" src=/web_sibw/icons/trash.png />
        </form>
        <form action="/web_sibw/php/editar.php" method="POST"
        style="place-self: center;">
          <input type="hidden" name="id"     value='.$id.'   />
          <input type="hidden" name="obra"   value='.$obra.' />
          <input type="hidden" name="selector" value="Comentario" />
          <input type="image"  name="submit" value="Editar" src=/web_sibw/icons/edit.png />
        </form>';
      }

      $comentarios .= '<div class="comentario">
        <div class="comentario-fecha">
          <p>'.$fecha.'</p>
          <p>'.$usuario.'</p>
          '.$moderador.'
        </div>
        <div class="texto">
          '.$comentario.'
        </div>
      </div>';
    }
  }
  else
    echo("<script>console.log('PHP: sin datos - ".$num_filas."');</script>");
?>


<!-- COMENTARIOS: comienzo -->
<div id=desplegable-comentarios>
  <a title="Comentar" id=btn_comentarios onClick="mostrarComentarios();">
    <img src="icons/chat.png"/>
  </a>
  <div id=contenedor-comentarios>
  <!--
    Secciones del formulario:
      * Nombre
      * Email
      * Comentario
      * Botón de enviar

    Secciones del comentario:
      * Autor
      * Fecha
      * Hora
      * Texto

    Layout:
      * Arriba: 2 comentarios predefinidos
      * Abajo: Formulario
  -->
    <div id=comentarios>
      <!-- Comentario predefinido 1 -->
    <?php echo $comentarios ?>
    </div>

    <?php
      if( isset($_SESSION['loggedin']) ){
        echo '
        <!-- Formulario para inserción de comentarios -->
        <form id="formulario" action="php/enviarComentario.php?id='.$obra.'" method="post">
          <div id="personal-info">
            <div class="login-item">
              Nombre: <input type="text" id="nombre" name="nombre"
              value="'.$_SESSION['username'].'" readonly>
            </div>
            <div class="login-item">
              Email: <input type="email" id="email" name="email"
              value="'.$_SESSION['email'].'" readonly>
            </div>
          </div>
          <textarea id="comentario" name="texto" placeholder="Escribe aquí tu comentario..."
           onKeyUp="revisarComentario();" maxlength="2000" required></textarea>
           <input id="boton" type="submit" value="Enviar" onClick="enviarComentario();">
        </form>
        ';
      }
      else {
        echo '
        <form id="formulario" action="/web_sibw/panelControl.php">
          <div id="personal-info" style="grid-template-columns: 1fr; text-align:  center;">
            <h2> Debes iniciar sesión para poder enviar un comentario </h2>
            <input id="boton" type="submit" value="Iniciar sesión">
          </div>
        </form>
        ';
      }
    ?>
  </div>
</div>
<!-- COMENTARIOS: fin -->
