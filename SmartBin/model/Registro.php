<?php

/**
 * Registro: clase que representa el registro del sensor de peso
 * Record: class representing the weight sensor record
 */
class Registro extends EntidadBase
{
    /**
     * id: Identificador del registro
     * id: Record's identifier
     *
     * @var string
     */
    private $id;
    /**
     * name: Nombre del registro
     * name: Record's name
     *
     * @var string
     */
    private $name;
    /**
     * createdAt: Fecha de creación del registro
     * createdAt: Record's creation date
     *
     * @var DateTime
     */
    private $createdAt;
    /**
     * temperature: Temperatura durante el registro
     * temperature: Record's temperature
     *
     * @var double
     */
    private $temperature;
    /**
     * grind: Grind del registro
     * grind: Record's grind
     *
     * @var string
     */
    private $grind;
    /**
     * tasty: Tasty del registro
     * tasty: Record's tasty
     *
     * @var int
     */
    private $tasty;
    /**
     * note: Anotación sobre el registro
     * note: Record's note
     *
     * @var string
     */
    private $note;
    /**
     * totalTime: Tiempo total de duración del registro
     * totalTime: Record's total recording duration time
     *
     * @var double
     */
    private $totalTime;
    /**
     * averageFlowrate: Peso medio durante el registro
     * averageFlowrate: Record's average flowrate
     *
     * @var double
     */
    private $averageFlowrate;
    /**
     * totalWeight: Peso máximo durante el registro
     * totalWeight: Record's maximum weight
     *
     * @var double
     */
    private $totalWeight;
    /**
     * brewData: Cadena con todos los pesos del registro (separados por ";")
     * brewData: String with all record's weights (separated by ";")
     *
     * @var string
     */
    private $brewData;

    /**
     * __construct: Constructor del modelo registro
     * __construct: Register's model constructor
     *
     * @param  object $adapter Parámetro que representa el objeto adaptador de la conexión entre PHP y MySQL | Parameter that represents the adapter object of the connection between PHP and MySQL
     * @return void
     */
    public function __construct($adapter)
    {
        $table = "registro";
        $campoOrden = "id";
        parent::__construct($table, $campoOrden, $adapter);
    }

    /**
     * getId: Recuperación del identificador del registro
     * getId: Get record's identifier
     *
     * @return string Devuelve el identificador del registro | Returns the record's identifier
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * getName: Recuperación del nombre del registro 
     * getName: Get record's name
     *
     * @return string Devuelve el nombre del registro | Returns the record's name
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * getCreatedAt: Recuperación de la fecha de creación del registro
     * getCreatedAt: Get record's creation date
     *
     * @return DateTime Devuelve la fecha de creación del registro | Returns the record's creation date
     */
    function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * getTemperature: Recuperación de la temperatura durante el registro
     * getTemperature: Get record's temperature
     *
     * @return double Devuelve la temperatura durante el registro | Returns the record's temperature
     */
    function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * getGrind: Recuperación del grind del registro
     * getGrind: Get record's grind
     *
     * @return string Devuelve el grind del registro | Returns the record's grind
     */
    function getGrind()
    {
        return $this->grind;
    }

    /**
     * getTasty: Recuperación del tasty del registro
     * getTasty: Get record's tasty
     *
     * @return int Devuelve el tasty del registro | Returns the record's tasty
     */
    function getTasty()
    {
        return $this->tasty;
    }

    /**
     * getNote: Recuperación de la anotación sobre el registro
     * getNote: Get record's note
     *
     * @return string Devuelve la anotación sobre el registro | Returns the record's note
     */
    function getNote()
    {
        return $this->note;
    }

    /**
     * getTotalTime: Recuperación del tiempo total de duración del registro
     * getTotalTime: Get record's total recording duration time
     *
     * @return double Devuelve el tiempo total de duración del registro | Returns the record's total recording duration time
     */
    function getTotalTime()
    {
        return $this->totalTime;
    }

    /**
     * getAverageFlowrate: Recuperación del peso medio durante el registro
     * getAverageFlowrate: Get record's average flowrate
     *
     * @return double Devuelve el peso medio durante el registro | Returns the record's average flowrate
     */
    function getAverageFlowrate()
    {
        return $this->averageFlowrate;
    }

    /**
     * getTotalWeight: Recuperación del peso máximo durante el registro
     * getTotalWeight: Get record's maximum weight
     *
     * @return double Devuelve el peso máximo durante el registro | Returns the record's maximum weight
     */
    function getTotalWeight()
    {
        return $this->totalWeight;
    }

    /**
     * getBrewData: Recuperación de la cadena con todos los pesos del registro
     * getBrewData: Get record's string with all record's weights
     *
     * @return string Devuelve la cadena con todos los pesos del registro | Returns the record's string with all record's weights
     */
    function getBrewData()
    {
        return $this->brewData;
    }

    /**
     * setId: Asignación del identificador del registro
     * setId: Set record's identifier
     *
     * @param  string $id Parámetro que representa el identificador del registro | Parameter representing record's identifier
     * @return void
     */
    function setId($id)
    {
        $this->id = $id;
    }

    /**
     * setName: Asignación del nombre del registro
     * setName: Set record's name
     *
     * @param  string $name Parámetro que representa el nombre del registro | Parameter representing record's name
     * @return void
     */
    function setName($name)
    {
        $this->name = $name;
    }

    /**
     * setCreatedAt: Asignación de la fecha de creación del registro
     * setCreatedAt: Set record's creation date
     *
     * @param  DateTime $createdAt Parámetro que representa la fecha de creación del registro | Parameter representing record's creation date
     * @return void
     */
    function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * setTemperature: Asignación de la temperatura durante el registro
     * setTemperature: Set record's temperature
     *
     * @param  double $temperature Parámetro que representa la temperatura durante el registro | Parameter representing record's temperature
     * @return void
     */
    function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * setGrind: Asignación del grind del registro
     * setGrind: Set record's grind
     *
     * @param  string $grind Parámetro que representa el grind del registro | Parameter representing record's grind
     * @return void
     */
    function setGrind($grind)
    {
        $this->grind = $grind;
    }

    /**
     * setTasty: Asignación del tasty del registro
     * setTasty: Set record's tasty
     *
     * @param  mixed $tasty Parámetro que representa el tasty del registro | Parameter representing record's tasty
     * @return void
     */
    function setTasty($tasty)
    {
        $this->tasty = $tasty;
    }

    /**
     * setNote: Asignación de la anotación sobre el registro
     * setNote: Set record's note
     *
     * @param  string $note Parámetro que representa la anotación sobre el registro | Parameter representing record's note
     * @return void
     */
    function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * setTotalTime: Asignación del tiempo total de duración del registro
     * setTotalTime: Set record's total recording duration time
     *
     * @param  double $totalTime Parámetro que representa el tiempo total de duración del registro | Parameter representing record's total recording duration time
     * @return void
     */
    function setTotalTime($totalTime)
    {
        $this->totalTime = $totalTime;
    }

    /**
     * setAverageFlowrate: Asignación del peso medio durante el registro
     * setAverageFlowrate: Set record's average flowrate
     *
     * @param  double $averageFlowrate Parámetro que representa el peso medio durante el registro | Parameter representing record's average flowrate
     * @return void
     */
    function setAverageFlowrate($averageFlowrate)
    {
        $this->averageFlowrate = $averageFlowrate;
    }

    /**
     * setTotalWeight: Asignación del peso máximo durante el registro
     * setTotalWeight: Set record's maximum weight
     *
     * @param  double $totalWeight Parámetro que representa el peso máximo durante el registro | Parameter representing record's maximum weight
     * @return void
     */
    function setTotalWeight($totalWeight)
    {
        $this->totalWeight = $totalWeight;
    }

    /**
     * setBrewData: Asignación de la cadena con todos los pesos del registro
     * setBrewData: Set record's string with all record's weights
     *
     * @param  string $brewData Parámetro que representa la cadena con todos los pesos del registro | Parameter representing record's string with all record's weights
     * @return void
     */
    function setBrewData($brewData)
    {
        $this->brewData = $brewData;
    }

    /**
     * save: Inserción de un registro en la base de datos
     * save: Inserting a record in the database
     *
     * @return object Devuelve el objeto con la consulta de inserción | Returns the object with the insert query
     */
    public function save()
    {
        $query = "INSERT INTO registro (
            id,
            name,
            createdAt,
            temperature,
            grind,
            tasty,
            note,
            totalTime,
            averageFlowrate,
            totalWeight,
            brewData)
                VALUES( '" . $this->id . "',"
            . "'" . $this->name . "',"
            . "'" . $this->createdAt . "',"
            . "'" . $this->temperature . "',"
            . "'" . $this->grind . "',"
            . "'" . $this->tasty . "',"
            . "'" . $this->note . "',"
            . "'" . $this->totalTime . "',"
            . "'" . $this->averageFlowrate . "',"
            . "'" . $this->totalWeight . "',"
            . "'" . $this->brewData . "');";

        return $this->db()->query($query);
    }

    /**
     * buscarRegistro: Búsqueda de un registro en la base de datos por identificador o nombre
     * buscarRegistro: Search for a record in the database by identifier or name
     *
     * @param  string $buscar Parámetro que representa la cadena de búsqueda | Parameter representing the search string
     * @return object Devuelve el objeto con la consulta de búsqueda | Returns the object with the search query
     */
    public function buscarRegistro($buscar)
    {
        $resultSet = null;

        $query = $this->db()->query("SELECT * FROM registro WHERE id LIKE '%$buscar%' OR name LIKE '%$buscar%' ORDER BY id DESC");

        while ($row = $query->fetch_object()) {
            $resultSet[] = $row;
        }

        return $resultSet;
    }


    /**
     * comprobarVacio: Comprobación de si una cadena es vacía 
     * comprobarVacio: Checking if a string is empty
     *
     * @param  string $cadena Parámetro que representa la cadena a comprobrar | Parameter representing the string to check
     * @return string Devuelve la cadena | Returns the string
     */
    public function comprobarVacio($cadena)
    {
        if (isset($cadena)) {
            return $cadena;
        } else {
            return "";
        }
    }
}
