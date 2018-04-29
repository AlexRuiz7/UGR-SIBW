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

      $comentarios .= '<div class="comentario">
        <div class="comentario-fecha">
          <p>'.$fecha.'</p>
          <p>'.$usuario.'</p>
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

    <div id="formulario">
      <form action="php/submit.php?id=<?php echo $obra?>" method="post">
        <fieldset>
          <div id="personal-info">
            <span>
              Nombre: <input type="text" id="nombre" name="nombre"
              placeholder="Escribe aquí tu nombre..." maxlength="30" required>
            </span>
            <span>
              Email: <input type="email" id="email" name="email"
              placeholder="Escribe aquí tu email..." maxlength="50" required>
            </span>
          </div>
          <div>
            <textarea id="comentario" name="texto" placeholder="Escribe aquí tu comentario..."
             onKeyUp="revisarComentario();" maxlength="2000" required></textarea>
          </div>
          <div>
            <input id="boton" type="submit" value="Enviar" onClick="enviarComentario();">
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>
<!-- COMENTARIOS: fin -->
