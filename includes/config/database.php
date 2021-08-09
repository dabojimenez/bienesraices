<?php

function coneccionBD() : mysqli{

    //  $db = mysqli_connect("localhost","root","root","bienes_raices");
    $db = new mysqli("localhost","root","root","bienes_raices");

    if(!$db){
        echo 'Error no se conecto';
        exit; //evitamos que las siguientes lineas se ejecuten
    }

    return $db;
};