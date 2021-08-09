<?php
//Impostarmos la conexión e incluimos el header
require 'includes/app.php';

$db = coneccionBD();

//  CReamos el usuario
$emai = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

//  Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('${emai}', '${passwordHash}')";

//  Agregamos a la BD
mysqli_query($db, $query);