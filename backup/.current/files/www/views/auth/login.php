<h1 class="nombre-pagina">Login</h1>

<p class="descripcion-pagina">Inicia sesión ingresando tus datos</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="ejemplo@ejemplo.com" name="email" value="<?php echo s($auth->email) ?>">
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Tu password" name="password">
    </div>

    <input type="submit" value="Iniciar Sesión" class="boton">

    <div class="acciones">
        <a href="/crearCuenta">¿Aún no tienes una cuenta? <span>Crear una</span></a>
        <a href="/olvidePassword">¿Olvidaste tu contraseña?</a>
    </div>
</form>
