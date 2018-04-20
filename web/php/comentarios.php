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
      <div class="comentario">
        <div class="comentario-fecha">
          <p>19/02/2018 - 17:58</p>
          <p>Juan Cuesta</p>
        </div>
        <div class="texto">
          Nulla non felis nec massa sodales tristique eget vitae quam. Ut
          placerat egestas finibus. Sed volutpat ipsum at feugiat sagittis.
          Mauris laoreet vel orci id aliquet. Aliquam ultricies nisi eu
          facilisis cursus. Nunc feugiat odio porttitor orci fringilla, sed
          condimentum libero dignissim. Curabitur euismod nulla eu nibh
          rhoncus sollicitudin. Quisque condimentum tempor commodo. Aliquam
          dignissim suscipit turpis eu laoreet. Nullam ac dui at eros gravida
          malesuada. Integer viverra tempor efficitur. Aliquam semper ipsum
          id tristique pellentesque. Maecenas aliquet nunc sit amet nisl
          ultrices, pellentesque egestas velit interdum.
        </div>
      </div>
      <!-- Comentario predefinido 2 -->
      <div class="comentario">
        <div class="comentario-fecha">
          <p>13/03/2018 - 11:42</p>
          <p>Emilio Delgado</p>
        </div>
        <div class="texto">
          Proin id rutrum mauris. Suspendisse porttitor rhoncus lacus, ut
          placerat dolor dictum a. Maecenas eros sapien, vehicula ornare
          egestas ac, dictum non tellus. Lorem ipsum dolor sit amet,
          consectetur adipiscing elit. Vestibulum rutrum blandit viverra. In
          hac habitasse platea dictumst. Cras eu feugiat libero. Nunc tempus
          scelerisque commodo. Donec molestie rutrum volutpat. Aenean enim
          dolor, lobortis ac risus sed, cursus fringilla nisi. Proin sit amet
          nisl elit. Maecenas tincidunt vulputate laoreet. Nulla at dolor est.
          Nam lacinia ac velit sed euismod.
        </div>
      </div>

    </div>

    <div id="formulario">
      <form onSubmit="return false;">
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
            <textarea id="comentario" placeholder="Escribe aquí tu comentario..."
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
