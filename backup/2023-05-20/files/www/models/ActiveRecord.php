<?php

namespace Model;

use mysqli_sql_exception;

class ActiveRecord
{

    //Base de datos
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];
    protected static $alertas = [];

    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlertas($tipo, $mensaje)  {
        static::$alertas[$tipo][] = $mensaje;
    }

    //Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar()   {
        static::$alertas = [];
        return static::$alertas;
    }

    //Consulta SQL para crear un objeto en memoria
    public static function consultarSQL($query) {

        //consultar base de datos
        $resultado = self::$db->query($query);

        //iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //liberar memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    public static function crearObjeto($registro)
    {

        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Identificar y unir los atributos de la BD
    public function atributos()
    {

        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    //Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarDatos()
    {

        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Registros - CRUD
    public function guardar()
    {

        $resultado = '';
        if (!is_null($this->id)) {
            //actualizar
            $resultado = $this->actualizar();
        } else {
            $resultado = $this->crear();
        }
        return $resultado;
    }


    // Todos los registros

    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Buscar un registro por su id
    public static function find(int $id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id ";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    //Buscar un registro por su token
    public static function where($columna, $valor)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$valor'";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }
    
    //Consulta plana de SQL (utilizar cuando los métodos del modelo no son suficientes)
    public static function SQL($query)
    {
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Obtener registros con cierta cantidad
    public static function get($limite)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT $limite";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    //Crear un nuevo registro
    public function crear()
    {

        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        //Consulta a la BD - insertar
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        // return json_encode(['query' => $query]);

        try {
            //Resultado de la consulta
            $resultado = self::$db->query($query);

            return [
                'resultado' => $resultado,
                'id' => self::$db->insert_id
            ];
        } catch (mysqli_sql_exception) {
            return [
                'resultado' => false,
                'id' => 0 
            ];
        }
    }

    //Actualizaar registro
    public function actualizar()
    {


        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        //Consulta a la BD - actualizar
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        //Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar()
    {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }
}
