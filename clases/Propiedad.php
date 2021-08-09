<?php

namespace App;

class Propiedad
{
    //  BASE DE DATOS
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedorid'];

    //  Errores
    protected static $errores = [];

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
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorid = $args['vendedor'] ?? '';
    }

    //  DEFINIR LA CONEXION A LA BD
    public static function setDB($database){
        self::$db = $database;
    }

    function guardar()
    {
        //  Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        //  (join), lo que hace es crear un nuevo string a partir de un arreglo
        /**Toma dos parametros:
         * 1) Es el separador
         * 2) Es el arreglo a aplanar o convertir en string
         */
        $stringKeys = join(', ', array_keys($atributos));
        $stringValues = join("', '", array_values($atributos));
        //debugear($stringValues);
        
        //Insertamos en la base de datos
        //$query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado,vendedorid) VALUES ('$this->titulo','$this->precio','$this->imagen','$this->descripcion','$this->habitaciones','$this->wc','$this->estacionamiento','$this->creado','$this->vendedorid')";
        $query = "INSERT INTO propiedades ( ";
        $query .= $stringKeys;
        $query .= " ) VALUES ('";
        $query .= $stringValues;
        $query .= "') ";
        
        //debugear($query);

        $resultado = self::$db->query($query);
        
        return $resultado;
    }
    // Subida de archivos
    public function setImagen($imagen)
    {
        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //  Identificar y unir los atributos de la base de datos
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id') continue;//   el (continue), le indica al if, de que si existe dicho parametro, se salte ese parametro, pero siga con los demas
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        //debugear($sanitizado);
        return $sanitizado;
    }

    //  Validación
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar ()
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
            self::$errores[] = 'La Imagen es Obligatoria';
        }

        return self::$errores;
    }

}
