<?php

/**
 * EntidadBase: clase con varias operaciones con la base de datos de la entidad
 * EntidadBase: class with various operations with the entity database
 */
class EntidadBase
{
    /**
     * table: Nombre de la tabla en la base de datos
     * table: Name of the table in the database
     *
     * @var string
     */
    private $table;
    /**
     * campoOrden: Campo de orden o filtro predeterminado
     * campoOrden: The default sort or filter field
     * 
     * @var string
     */
    private $campoOrden;
    /**
     * db: Objeto adaptador de la conexión entre PHP y MySQL
     * db: Adapter object of the connection between PHP and MySQL
     *
     * @var object
     */
    private $db;
    /**
     * conectar: Conexión con el core de la base de datos mediante la librería FluentPDO (por defecto a null)
     * conectar: Connection with the core of the database through the FluentPDO library (null by default)
     *
     * @var object
     */
    private $conectar;

    /**
     * __construct: Constructor de la clase
     * __construct: Class contructor
     *
     * @param  string $table Parámetro que representa el nombre de la tabla en la base de datos | Parameter representing the name of the table in the database
     * @param  string $campoOrden Parámetro que representa el campo de orden o filtro predeterminado | Parameter representing the default sort or filter field
     * @param  object $adapter Parámetro que representa el objeto adaptador de la conexión entre PHP y MySQL | Parameter representing the adapter object of the connection between PHP and MySQL
     * @return void
     */
    public function __construct($table, $campoOrden, $adapter)
    {
        $this->table = (string) $table;
        $this->campoOrden = (string) $campoOrden;
        $this->conectar = null;
        $this->db = $adapter;
    }

    /**
     * getConetar: Recuperación de la conexión con el core de la base de datos
     * getConetar: Get the connection with the core of the database
     *
     * @return object Devuelve la conexión con el core de la base de datos | Returns the connection with the core of the database
     */
    public function getConetar()
    {
        return $this->conectar;
    }

    /**
     * db: Recuperación del objeto adaptador de la conexión entre PHP y MySQL
     * db: Get the adapter object of the connection between PHP and MySQL
     *
     * @return object Devuelve el objeto adaptador de la conexión entre PHP y MySQL | Returns the adapter object of the connection between PHP and MySQL
     */
    public function db()
    {
        return $this->db;
    }

    /**
     * getAll: Recuperación de todos los registros
     * getAll: Get all records
     *
     * @return array Devuelve todos los registros | Returns all records
     */
    public function getAll()
    {
        $resultSet = null;

        $query = $this->db->query("SELECT * FROM $this->table ORDER BY $this->campoOrden DESC");

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }

    /**
     * getAsc: Recuperación de todos los registros en orden ascendente por una columna
     * getAsc: Get all records in ascending order by a column
     *
     * @param  string $column Parámetro que representa la columna por la que se ordena ascendentemente | Parameter representing the column that is sorted in ascending order 
     * @return array Devuelve los registros en orden ascendente por una columna | Returns the records in ascending order by a column
     */
    public function getAsc($column)
    {
        $resultSet = null;

        $query = $this->db->query("SELECT * FROM $this->table ORDER BY $column ASC");

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }

    /**
     * getDesc: Recuperación de todos los registros en orden descendente por una columna
     * getDesc: Get all records in descending order by a column
     *
     * @param  string $column Parámetro que representa la columna por la que se ordena descendentemente | Parameter representing the column that is sorted in descending order 
     * @return array Devuelve los registros en orden descendente por una columna | Returns the records in descending order by a column
     */
    public function getDesc($column)
    {
        $resultSet = null;

        $query = $this->db->query("SELECT * FROM $this->table ORDER BY '$column' DESC");

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }

    /**
     * getById: Recuperación de un registro por su identificador
     * getById: Get a record by its identifier
     *
     * @param  string $id Parámetro que representa el identificador del registro | Parameter representing the record's identifier
     * @return object Devuelve un registro por su identificador | Returns a record by its identifier
     */
    public function getById($id)
    {
        $resultSet = null;

        $query = $this->db->query("SELECT * FROM $this->table WHERE $this->campoOrden='$id'");

        if ($row = $query->fetch_object()) {
            $resultSet = $row;
        }

        return $resultSet;
    }

    /**
     * getBy: Recuperación de los registro por una columna
     * getBy: Get records by a column
     *
     * @param  string $column Parámetro que representa la columna del registro | Parameter representing the column of the record
     * @param  mixed $value Parámetro que representa el valor de la columna del registro | Parameter representing the value of the record's column
     * @return array Devuelve los registro por una columna | Returns the records by a column
     */
    public function getBy($column, $value)
    {
        $resultSet = null;

        $query = $this->db->query("SELECT * FROM $this->table WHERE $column='$value'");

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }

    /**
     * getNoBy: Recuperación inversa de los registro por una columna
     * getNoBy: Inversely get records by a column
     *
     * @param  string $column Parámetro que representa la columna del registro | Parameter representing the column of the record
     * @param  mixed $value Parámetro que representa el valor de la columna del registro | Parameter representing the value of the record's column
     * @return array Devuelve los registro por una columna | Returns the records by a column
     */
    public function getNoBy($column, $value)
    {
        $resultSet = null;

        $query = $this->db->query("SELECT * FROM $this->table WHERE $column!='$value'");

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }

    /**
     * deleteById: Eliminación de un registro por su identificador
     * deleteById: Deleting a record by its identifier
     *
     * @param  string $id Parámetro que representa el identificador del registro | Parameter representing the record's identifier
     * @return object Devuelve el objeto con la consulta de eliminación | Returns the object with the delete query
     */
    public function deleteById($id)
    {
        return $this->db->query("DELETE FROM $this->table WHERE $this->campoOrden='$id'");;
    }

    /**
     * deleteBy: Eliminación de los registro por una columna
     * deleteBy: Deleting a record by a column
     *
     * @param  string $column Parámetro que representa la columna del registro | Parameter representing the column of the record
     * @param  mixed $value Parámetro que representa el valor de la columna del registro | Parameter representing the value of the record's column
     * @return object Devuelve el objeto con la consulta de eliminación | Returns the object with the delete query
     */
    public function deleteBy($column, $value)
    {
        return $this->db->query("DELETE FROM $this->table WHERE $column='$value'");;
    }
}
