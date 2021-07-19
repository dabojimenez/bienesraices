<?php

echo "NI ENTRO";
//var_dump(function_exists('mysqli_connect'));

// Show all information, defaults to INFO_ALL
$coneccion = mysqli_connect("localhost","root","root","appsalon");
$coneccion->set_charset('utf8');
var_dump(function_exists('mysqli_connect'));

if ($coneccion) {
    echo "si vale papu";
}else {
    echo "vale, pero no se conecto";
}

/*
En Ubuntu
Si al usar el metodo (mysqli_connect), no sale nada, despues de que se le pasa los parametros, si es como existira un o fuera
un exit, que practicamente ya no permite ejecutar el codigo siguiente.
1) Si estamos en ubuntu, debemos cambiar nuestros archivos [php.ini], descomentando las linea (extension=mysqli)
2) Si ya lo hicimos y seguimos con el error, que no se ejecuta ni siquiera entra al validador, sigue siendo un exit
debemos instalar la siguiente linea de comandos, pero debemos saber que version de php estamos usando, y seleccionar
para mi caso es el siguiente:
    sudo apt-get install php8.0-mysqlnd
****NOTA: Podemos cambiar la version, solo cmabiando el numero de por ejemplo 8.0 a 7.4
    sudo apt-get install php-mysqlnd
    Si ejecutamos de la siguiente manera el comando, nos pedira la version, el cual nos desplegara un pequeño listado de las versiones

*/

?>