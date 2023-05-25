<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<h1 class="nombre-pagina">Crear Servicio</h1>
<p class="descripcion-pagina">Llena los campos para crear un nuevo servicio</p>

<?php
    include_once __DIR__ . '/../templates/botonesAdmin.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/servicios/crear" method="POST" class="formulario">
    
<?php   include_once __DIR__ . '/formulario.php';   ?>

    <input type="submit" class="boton" value="Crear">
</form>