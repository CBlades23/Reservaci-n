<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<h1 class="nombre-pagina">Actualizar Servicios</h1>
<p class="descripcion-pagina">Adminstración de servicios</p>

<?php
    include_once __DIR__ . '/../templates/botonesAdmin.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form method="POST" class="formulario">
    
    <?php   include_once __DIR__ . '/formulario.php';   ?>

    <input type="submit" class="boton" id="actualizar" value="Actualizar">
</form>


<?php
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        ";
?>