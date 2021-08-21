<?php

require __DIR__ . '/funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//  Conectar a la base de datos
$db = coneccionBD();

use App\ActiveRecord;

ActiveRecord::setDB($db);