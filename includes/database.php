<?php

$db = mysqli_connect(
    $_ENV['DB_HOST'], 
    $_ENV['DB_USER'], 
    $_ENV['DB_PASSWORD'], 
    $_ENV['DB_BD']);


if (!$db) {
    echo "¡Error! No se pudo estableces conexión con la Base de datos";
    echo "Errno de depuración " . mysqli_connect_errno();
    echo "Error de depuración " . mysqli_connect_error();
    exit;
}

?>