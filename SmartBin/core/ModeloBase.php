<?php

/**
 * ModeloBase: clase con varias operaciones para los modelos de consulta
 * ModeloBase: class with multiple operations for query models
 */
class ModeloBase extends EntidadBase
{
    /**
     * table: Nombre de la tabla en la base de datos
     * table: Name of the table in the database
     *
     * @var string
     */
    private $table;
    /**
     * fluent: Conexión con el core de la base de datos mediante la librería FluentPDO
     * fluent: Connection with the core of the database through the FluentPDO library
     *
     * @var object
     */
    private $fluent;

    /**
     * __construct: Contructor de la clase
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
        parent::__construct($table, $campoOrden, $adapter);
    }

    /**
     * table: Recuperación del nombre de la tabla en la base de datos
     * table: Get the name of the table in the database
     *
     * @return string Devuelve el nombre de la tabla en la base de datos | Returns the name of the table in the database
     */
    public function table()
    {
        return $this->table;
    }

    /**
     * fluent: Recuperación de la conexión con el core de la base de datos mediante la librería FluentPDO
     * fluent: Get the connection with the core of the database through the FluentPDO library
     *
     * @return object Devuelve la conexión con el core de la base de datos mediante la librería FluentPDO | Returns the connection with the core of the database through the FluentPDO library
     */
    public function fluent()
    {
        return $this->fluent;
    }

    /**
     * ejecutarSql: Ejecución de una consulta SQL
     * ejecutarSql: Running a SQL query
     *
     * @param  string $query Parámetro que representa una consulta SQL | Parameter representing a SQL query
     * @return mixed Devuelve el resultado de una consulta SQL | Returns the result of a SQL query
     */
    public function ejecutarSql($query)
    {
        $query = $this->db()->query($query);
        if ($query) {
            if ($query->num_rows > 1) {
                while ($row = $query->fetch_object()) {
                    $resultSet[] = $row;
                }
            } elseif ($query->num_rows == 1) {
                if ($row = $query->fetch_object()) {
                    $resultSet = $row;
                }
            } else {
                $resultSet = true;
            }
        } else {
            $resultSet = false;
        }

        return $resultSet;
    }
}
