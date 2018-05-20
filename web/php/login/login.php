<div class="login">
  <!-- Formulario para iniciar sesion  -->
  <div class="login-container">
    <h2>Iniciar sesión</h2>
    <form action="php/login/conectar.php" method="POST">
      <div class="login-item">
        Nombre de usuario:  <input type="text"  name="usuario"
        placeholder="Escriba su nombre" maxlength="20" required />
      </div>
      <div class="login-item">
        Contraseña: <input type="password" name="clave"
        placeholder="Escriba su contraseña" maxlength="10" required />
      </div>
      <input type="submit" value="Iniciar sesión" />
    </form>
  </div>

  <!-- Formulario para crear nueva cuenta -->
  <div class="login-container">
    <h2>Crear cuenta</h2>
    <form action="php/login/registrar.php" method="POST">
      <div class="login-item">
        Nombre de usuario:  <input type="text"  name="usuario"
        placeholder="Escriba su nombre" maxlength="20" required />
      </div>
        <div class="login-item">Correo electrónico: <input type="email"
          name="email" placeholder="Escriba su correo" maxlength="30"
          required />
      </div>
        <div class="login-item">Contraseña: <input type="password"
          name="clave" placeholder="Escriba su contraseña" maxlength="10"
          required />
      </div>
      <input type="submit" value="Crear cuenta" />
    </form>
  </div>
</div>
