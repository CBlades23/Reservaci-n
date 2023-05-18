<h1 class="nombre-pagina">Olvide contraseña </h1>
<p class="descripcion-pagina">Reestablece tu contraseña escribiendo tu correo a continuación</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/olvidePassword">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="ejemplo@ejemplo.com" name="email">
    </div>

    <input type="submit" value="Enviar Instrucciones" class="boton">

    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? <span>Iniciar sesión</span></a>
        <a href="/crearCuenta">¿Aún no tienes una cuenta? <span>Crear una</span></a>
    </div>
</form>