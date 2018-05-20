<?php
  session_start();

  $tipo = $_SESSION['tipo'];
  $usuario_avanzado = true;

  switch ($tipo) {
    case 'usuario':
      $usuario_avanzado = false;
      break;

    case 'admin':
      $html = datosAdmin($conexion);
      break;

    case 'moderador':
      $html .= datosModerador($conexion);
      break;

    case 'gestor':
      $html .= datosGestor($conexion);
      break;
  }
?>

<!-- ###########################  HTML ###################################  -->

<div class="login <?php if ($usuario_avanzado) echo 'opciones'; ?>">
  <!-- Formulario para cerrar sesión -->
  <div class="login-container">
    <h2>Desconectar</h2>
    <form action="php/login/desconectar.php" method="POST">
      <input type="submit" value="Cerrar sesión"/>
    </form>
  </div>

  <!-- Formulario para editar información de usuario -->
  <div class="login-container">
    <h2>Editar datos personales</h2>
    <form action="php/login/modificar.php" method="POST">
      <div class="login-item">
        Nombre de usuario:  <input type="text"  name="usuario"
        placeholder="Escriba su nuevo nombre de usuario" maxlength="20"/>
      </div>
        <div class="login-item">Correo electrónico: <input type="email"
          name="email" placeholder="Escriba su nuevo correo" maxlength="30"/>
      </div>
        <div class="login-item">Contraseña: <input type="password"
          name="clave" placeholder="Escriba su nueva contraseña" maxlength="10"/>
      </div>
      <input type="submit" value="Aceptar" />
    </form>
  </div>

  <!-- Sección de opciones avanzadas para usuarios con privilegios -->
  <?php if ($usuario_avanzado) echo $html; ?>

</div>


<!-- ######################## Funciones PHP ###############################  -->

<?php

  /**
   * [leerTabla description]
   * @param  [type] $tabla [description]
   * @return [type]        [description]
   */
  function leerTabla ($conexion, $tabla) {
    $peticion = "SELECT * FROM $tabla";

    if (!($resultado = mysqli_query($conexion, $peticion)))
      die ("Ha fallado la petición a la base de datos" . mysqli_error($conexion));

    return $resultado;
  }

  /**
   * [datosModerador description]
   * @return [type] [description]
   */
  function datosModerador($conexion){
    $resultado = leerTabla($conexion, "Comentario");

    $num_filas = mysqli_num_rows($resultado);

    $lista = '<div class="fechas item-lista negrita">
          <p> Usuario </p>
          <p> Fecha   </p>
          <p> Enlace  </p>
        </div>';

    for ($i=0; $i<$num_filas; $i++){
        $fila = mysqli_fetch_assoc($resultado);
        $usuario = $fila['usuario'];
        $fecha   = $fila['fechapublicacion'];
        $obra    = $fila['obraref'];

        $lista .= '<div class="fechas item-lista">
              <p>'.$usuario.'</p>
              <p>'.$fecha.'</p>
              <a href="/web_sibw/plantillaObra.php?id='.$obra.'">Ir a Obra</a>
          </div>';
    }

    $html .= '<div class="login-container">
        <h2>Opciones de Moderador</h2>
        <div class="avanzadas">
          '.$lista.'
        </div>
      </div>';

    return $html;
  }

  /**
   * [datosGestor description]
   * @param  [type] $conexion [description]
   * @return [type]           [description]
   */
  function datosGestor($conexion){
    $resultado = leerTabla($conexion, "Obra");

    $num_filas = mysqli_num_rows($resultado);

    $lista = '<div class="fechas item-lista negrita">
          <p> Título </p>
          <p> Autor  </p>
          <p> Enlace </p>
        </div>';

    for ($i=0; $i<$num_filas; $i++){
        $fila = mysqli_fetch_assoc($resultado);
        $titulo = $fila['titulo'];
        $autor   = $fila['autor'];
        $obra    = $fila['id'];

        $lista .= '<div class="fechas item-lista">
              <p>'.$titulo.'</p>
              <p>'.$autor.'</p>
              <a href="/web_sibw/plantillaObra.php?id='.$obra.'">Ir a Obra</a>
          </div>';
    }

    $html .= '<div class="login-container">
        <h2>Opciones de Gestor</h2>
        <div class="avanzadas">
          '.$lista.'
        </div>
      </div>';

      return $html;
  }


  function datosAdmin($conexion){
    $resultado = leerTabla($conexion, "Usuarios");

    $num_filas = mysqli_num_rows($resultado);

    $lista = '<div class="fechas admin negrita">
          <p> Usuario </p>
          <p> Correo  </p>
          <p> </p>
          <p> Tipo    </p>
        </div>';

    for ($i=0; $i<$num_filas; $i++){
        $fila = mysqli_fetch_assoc($resultado);
        $nombre = $fila['nombre_usuario'];
        $email  = $fila['email'];
        $tipo   = $fila['privilegios'];


        $lista .= '<div class="fechas admin">
              <p>'.$nombre.'</p>
              <p>'.$email.'</p>
              <form action="/web_sibw/php/editar.php" method="POST" id="privilegios">
                <input type="hidden" name="usuario" value="'.$nombre.'" />
                <input type="hidden" name="selector" value="Usuarios" />
                <input type="image"  name="submit" src="/web_sibw/icons/confirm.png"
                  title="Confirmar cambios"/>
              </form>
              <select name="privilegios" form="privilegios">';

        switch ($tipo) {
          case 0:
            $lista .= '<option value=1> Usuario </option>
                       <option value=2> Moderador </option>
                       <option value=3> Gestor </option>
                       <option value=4> Administrador </option>';
            break;
          case 1:
            $lista .= '<option value=0> Anónimo </option>
                       <option value=2> Moderador </option>
                       <option value=3> Gestor </option>
                       <option value=4> Administrador </option>';
            break;
          case 2:
            $lista .= '<option value=0> Anónimo </option>
                       <option value=1> Usuario </option>
                       <option value=3> Gestor </option>
                       <option value=4> Administrador </option>';
            break;
          case 3:
            $lista .= '<option value=0> Anónimo </option>
                       <option value=1> Usuario </option>
                       <option value=2> Moderador </option>
                       <option value=4> Administrador </option>';
            break;
          case 4:
            $lista .= '<option value=0> Anónimo </option>
                       <option value=1> Usuario </option>
                       <option value=2> Moderador </option>
                       <option value=3> Gestor </option>';
            break;
        }

        $lista .='</select>
            <form action="php/borrar.php" method="POST">
              <input type="hidden" name="usuario" value="'.$nombre.'" />
              <input type="hidden" name="selector" value="Usuarios" />
              <input type="image" name="submit" src="/web_sibw/icons/trash.png"
                title="Eliminar usuario"/>
            </form>
          </div>';
    }

    $html = '<div class="login-container">
        <h2>Opciones de Administrador</h2>
        <div class="avanzadas">
          '.$lista.'
        </div>
      </div>';

    $html .= datosGestor($conexion) . datosModerador($conexion);

    return $html;
  }

?>
