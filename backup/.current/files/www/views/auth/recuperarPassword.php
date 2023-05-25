<h1 class="nombre-pagina">Recuperar Contraseña </h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña a continuación</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<?php  if ($error) return null; ?>

<form class="formulario" method="POST">

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu nueva contraseña">
    </div>

    <input type="submit" class="boton" value="Guardar Nuevo Password">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? <span>Iniciar sesión</span></a>
    <a href="/crearCuenta">¿Aún no tienes una cuenta? <span>Crear una</span></a>
</div>