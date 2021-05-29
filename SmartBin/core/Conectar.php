<?php

/**
 * Conectar: clase que representa la conexión con la base de datos
 * Conectar: class representing the connection to the database
 */
class Conectar
{
    /**
     * driver: Driver de la base de datos
     * driver: Database's driver
     *
     * @var string
     */
    /**
     * host: Host de la base de datos
     * host: Database's host
     *
     * @var string
     */
    /**
     * user: Usuario de la base de datos
     * user: Database's user
     *
     * @var string
     */
    /**
     * pass: Contraseña de la base de datos
     * pass: Database's password
     *
     * @var string
     */
    /**
     * database: Base de datos
     * database: Database
     *
     * @var string
     */
    /**
     * charset: Charset de la base de datos
     * charset: Database's charset
     *
     * @var string
     */
    private $driver, $host, $user, $pass, $database, $charset;

    /**
     * __construct: Constructor de la clase, que incluye los parámetros de configuración de la base de datos
     * __construct: Class contructor, which includes the database configuration parameters
     *
     * @return void
     */
    public function __construct()
    {
        $db_cfg = require_once 'config/database.php';
        $this->driver = $db_cfg["driver"];
        $this->host = $db_cfg["host"];
        $this->user = $db_cfg["user"];
        $this->pass = $db_cfg["pass"];
        $this->database = $db_cfg["database"];
        $this->charset = $db_cfg["charset"];
    }

    /**
     * conexion: Conexión con la base de datos
     * conexion: Connection to the database
     *
     * @return object Devuelve la conexión con la base de datos | Returns the connection to the database
     */
    public function conexion()
    {
        if ($this->driver == "mysql" || $this->driver == null) {
            $con = new mysqli($this->host, $this->user, $this->pass, $this->database);
            $con->query("SET NAMES '" . $this->charset . "'");
        }

        return $con;
    }
}
