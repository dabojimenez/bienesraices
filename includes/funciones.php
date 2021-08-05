<?php


define('TEMPLATES_URL', __DIR__ . '/templates');//con (__DIR__),es una super global, tomamos la direccion de nuestro archivo (funciones.php) y lo incluimos en nuestra URL
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

function includeTemplate(string $nombre, bool $inicio = false)
{

    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() : bool
{
    session_start();
    $autenticacion = $_SESSION['login'];
    if ($autenticacion) {
        return true;
    }
    return false;
}
