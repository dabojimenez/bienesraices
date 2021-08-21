<?php

namespace App;

class ActiveRecord{
    //  BASE DE DATOS
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = "";

    //  Errores
    protected static $errores = [];

    //  DEFINIR LA CONEXION A LA BD
    public static function setDB($database){
        self::$db = $database;
    }

    function guardar()
    {
        if (!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Crear un nuevo registro
            $this->crear();
        }
    }

    function crear()
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
        $query = "INSERT INTO " .static::$tabla ." ( ";
        $query .= $stringKeys;
        $query .= " ) VALUES ('";
        $query .= $stringValues;
        $query .= "') ";

        //debugear($query);

        $resultado = self::$db->query($query);

        // Mensaje de exito
        if ($resultado) {
            header('Location:/BienesRaices/admin?resultado=1');
        }
    }

    // Actualizar 
    public function actualizar()
    {
        //  Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        // Actualizaos en a BD
        // $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorid = ${vendedorid} WHERE id = ${id} ";
        $query = "UPDATE " .static::$tabla. " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redireccionaral usuario
            header('Location:/BienesRaices/admin?resultado=2');
        }
    }

    // Eliminar un registro
    public function eliminar()
    {
        //  ELiminar la Propiedad
        $query = "DELETE FROM " .static::$tabla. " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            header('Location:/BienesRaices/admin?resultado=3');
        }
    }

    // Subida de archivos
    public function setImagen($imagen)
    {
        // ELimina la imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }
    // Eliminar archivo
    public function borrarImagen()
    {
        // Comprobar si existe un archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //  Identificar y unir los atributos de la base de datos
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue; //   el (continue), le indica al if, de que si existe dicho parametro, se salte ese parametro, pero siga con los demas
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
        return $sanitizado;
    }

    //  Validación
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    // Lista todos las propiedades
    public static function all()
    {
        // query de consuta BD
        // Con (static), heredamos el metodo y va a buscara dicho atributo en la clase que se este heredando
        $query = "SELECT * FROM " . static::$tabla;
        // resultado
        $resultado = self::consultarSQL($query);
        // retornamos
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " .static::$tabla. " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);
        // La función (array_shift), nos devuelve el primer elemento de un arreglo
        return array_shift($resultado);
    }

    public static function consultarSQL($query): array
    {
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        // Liberar la memoria con (free), para ayudar a nuestro servidor
        $resultado->free();
        // Retornar
        return $array;
    }

    // Funciona como un espejo de la Base de Datos, pero ahora estan en memoria para poder usar
    protected static function crearObjeto($registro): Object
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            /**Con (property_exists), verifica que exista una propiedad, o compara el objeto que estoy creando si tiene un id, ect.
             * 1)   Toma el objeto a comparar
             * 2)   La llave o valor para comparar
             */
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            /**Con (this), hacemos referencia a los atributos de la clase, que estan como publicos
             * y comparamos con la llave o key, pero usando $, para hacerla variable y no estar rescribiendo uno por uno cada atributo
             */
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}