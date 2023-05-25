<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapa - Sanitiza el HTML
function s($html) {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(String $actual, String $proximo):   bool    {
    if ($actual !== $proximo) {
        return true;
    }
    return false;
}

function isAuth() : void    {
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function isAdmin() : void
{
    if (!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}

?>