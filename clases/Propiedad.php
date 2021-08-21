<?php

namespace App;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorid'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorid;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorid = $args['vendedorid'] ?? "";
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un Titulo";
        }

        if (!$this->precio) {
            self::$errores[] = "Debes añadir un Precio";
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "Debes añadir una Descripcion y debetener almenos 50 caracteres";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "Debes añadir Habitaciones";
        }

        if (!$this->wc) {
            self::$errores[] = "Debes añadir WC";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "Debes añadir Estacionamientos";
        }

        if (!$this->vendedorid) {
            self::$errores[] = "Elije un vendedor";
        }

        if (!$this->imagen) {
            self::$errores[] = 'La Imagen de la Propiedad es Obligatoria';
        }

        return self::$errores;
    }
}
