<?php


define('TEMPLATES_URL', __DIR__ . '/templates'); //con (__DIR__),es una super global, tomamos la direccion de nuestro archivo (funciones.php) y lo incluimos en nuestra URL
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function includeTemplate(string $nombre, bool $inicio = false)
{

    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado(): bool
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /BienesRaices/');
    }
    return false;
}

function debugear($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}
