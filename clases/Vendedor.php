<?php

namespace App;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = "El Nombre es Obligatorio";
        }

        if (!$this->apellido) {
            self::$errores[] = "El Apellido es Obligatorio";
        }

        if (!$this->telefono) {
            self::$errores[] = "El Teléfono es Obligatorio";
        }
        /**Para buscar expresiones regulares en una cadena usamos (preg_match)
         * Una expresion regular es una forma de bsucar un patron dentro de un texto
         * Parametros que recibe:
         * 1)   La expresion regular
         * 2)   La variable o valor a revisar
         * SINTAXIS:
         * / /  :Debemos colocar al incio o al final, indicando que es fijo el tamaño
         * [0-9]:Los valores que va aceptar van de 0 a 9
         * {10} :Que tienen que ser 10 digitos
        */
        if (!preg_match('/[0-9]{10,10}/', $this->telefono)) {
            self::$errores[] = "Formato no Válido";
        }

        return self::$errores;

    }
}