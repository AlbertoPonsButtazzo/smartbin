<?php

/**
 * IndexController: clase que representa el controlador de la vista "Inicio"
 * IndexController: class representing the controller's view "Home"
 */
class IndexController extends ControladorBase
{
    /**
     * conectar: Conexión con la base de datos
     * conectar: Connection with the database
     *
     * @var object
     */
    public $conectar;
    /**
     * adapter: Adaptador de la conexión entre PHP y MySQL
     * adapter: Adapter of the connection between PHP and MySQL
     *
     * @var object
     */
    public $adapter;
    /**
     * powershellDirectory: Directorio del PowerShell
     * powershellDirectory: PowerShell's directory
     *
     * @var string
     */
    public $powershellDirectory;
    /**
     * anacondaDirectory: Directorio del entorno de Anaconda
     * anacondaDirectory: Anaconda's environment directory
     *
     * @var string
     */
    public $anacondaDirectory;

    /**
     * __construct: Constructor de la clase
     * __construct: Class contructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
        $script_cfg = require_once 'config/scriptInstallation.php';
        $this->powershellDirectory = $script_cfg["powershellDirectory"];
        $this->anacondaDirectory = $script_cfg["anacondaDirectory"];
    }

    /**
     * index: Acción por defecto, que carga la vista "Inicio" y pasa de valores a la misma
     * index: Default action, which loads the view "Home" and pass values ​​to it
     *
     * @return void
     */
    public function index()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAll();

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * importar: Importación del CSV con los registros e inserciones a la base de datos de los mismos
     * importar: CSV import with the records and inserts of them to the database
     *
     * @return void
     */
    public function importar()
    {
        if (isset($_POST["import"])) {

            $fileName = $_FILES["file"]["tmp_name"];

            if ($_FILES["file"]["size"] > 0) {

                $file = fopen($fileName, "r");

                while (($column = fgetcsv($file, 50000, ",")) !== FALSE) {

                    $registro = new Registro($this->adapter);
                    $registro->setId($registro->comprobarVacio($column[0]));
                    $registro->setName($registro->comprobarVacio($column[1]));
                    $registro->setCreatedAt($registro->comprobarVacio($column[2]));
                    $registro->setTemperature($registro->comprobarVacio($column[3]));
                    $registro->setGrind($registro->comprobarVacio($column[4]));
                    $registro->setTasty($registro->comprobarVacio($column[5]));
                    $registro->setNote($registro->comprobarVacio($column[6]));
                    $registro->setTotalTime($registro->comprobarVacio($column[7]));
                    $registro->setAverageFlowrate($registro->comprobarVacio($column[8]));
                    $registro->setTotalWeight($registro->comprobarVacio($column[9]));
                    $registro->setBrewData($registro->comprobarVacio($column[10]));

                    $registro->save();
                }
                $registro->deleteById("id");
            }
        }
        $this->redirect("index", "index");
    }

    /**
     * buscar: Búsqueda de un registro en la base de datos por identificador o nombre y definición del mensaje de alerta
     * buscar: Search for a record in the database by identifier or name and definition of the alert message
     *
     * @return void
     */
    public function buscar()
    {
        if (isset($_GET["buscar"])) {
            $registro = new Registro($this->adapter);
            $allRegistros = $registro->buscarRegistro($_GET["buscar"]);

            if (!isset($allRegistros) || $_GET["buscar"] == "") {
                $mensajeBuscar = false;
                $allRegistros = $registro->getAll();
            } else {
                $mensajeBuscar = true;
            }

            $this->view("index", array(
                "allRegistros" => $allRegistros,
                "mensajeBuscar" => $mensajeBuscar
            ));
        }
    }

    /**
     * getGraficabyIds: Recuperación de los datos de la gráfica con la variación de los pesos en el tiempo (con múltiples registros)
     * getGraficabyIds: Get the chart's data with the variation of the weights over time (with multiple records)
     *
     * @return void Devuelve los datos de la gráfica con la variación de los pesos en el tiempo (con múltiples registros) | Returns the chart's data with the variation of the weights over time (with multiple records)
     */
    public function getGraficabyIds()
    {
        if (isset($_POST['charts'])) {
            $registro = new Registro($this->adapter);
            $allRegistros = $registro->getAll();
            $identificadores = isset($_POST['chk']) ? $_POST['chk'] : array();
            $nombres = array();
            $dataPointsGraficabyIds = array();

            for ($i = 0; $i < count($identificadores); $i++) {
                $pesos = null;
                $dataPointsGraficabyId = null;
                $dataPointsGraficabyId = array();
                $pesos = explode(";", $registro->getById($identificadores[$i])->brewData);
                array_push($nombres, $registro->getById($identificadores[$i])->name);
                if (count($pesos) > 1) {
                    for ($j = 0; $j < count($pesos); $j++) {
                        array_push($dataPointsGraficabyId, array("x" => $j, "y" => $pesos[$j]));
                    }
                }
                array_push($dataPointsGraficabyIds, $dataPointsGraficabyId);
            }
        }

        if (empty($identificadores)) {
            $dataPointsGraficabyIds = null;
        }

        $this->view("index", array(
            "allRegistros" => $allRegistros,
            "dataPointsGraficabyIds" => $dataPointsGraficabyIds,
            "identificadores" => $identificadores,
            "nombres" => $nombres
        ));
    }

    /**
     * getGraficabyIdProphet: Recuperación de los datos de la gráfica con la variación de los pesos en el tiempo por cada segundo y los pesos con la predicción de Prophet
     * getGraficabyIdProphet: Get the chart's data with the variation of the weights over time per second and the weights with Prophet's prediction
     *
     * @return void Devuelve los datos de la gráfica con la variación de los pesos en el tiempo por cada segundo y los pesos con la predicción de Prophet | Returns the chart's data with the variation of the weights over time per second and the weights with Prophet's prediction
     */
    public function getGraficabyIdProphet()
    {
        if (isset($_GET["id2"])) {
            $identificador = $_GET["id2"];

            $registro = new Registro($this->adapter);
            $allRegistros = $registro->getAll();
            $allRegistrosbyId = $registro->getById($identificador);
            $pesos = explode(";", $allRegistrosbyId->brewData);
            $totalTime = $allRegistrosbyId->totalTime;
            $createdAt = $allRegistrosbyId->createdAt;

            if (count($pesos) > 1) {
                $seconds = 0;
                $format = 'Y-m-d H:i:s';
                $format2 = 'Y-m-d H:i:s.u';

                $dataPointsGraficabyIdSeconds = array();
                $instances = array();
                $pesosTemp = array();
                $pesosS = array();
                $franjas = round(count($pesos) / $totalTime);
                $seconds = 0;
                $pos = 0;
                $pos2 = 0;

                for ($i = 0; $i < $totalTime; $i++) {
                    $seconds = $seconds + 1;
                    $createdAtDateTime = null;
                    $createdAtDateTime = DateTime::createFromFormat($format, $createdAt);
                    $createdAt0 = null;
                    $createdAt0 = $createdAtDateTime->modify('-' . $totalTime . 'second');
                    $time = null;
                    $time = $createdAt0->modify('+' . round($seconds * 1000) . 'ms');
                    array_push($instances, $time->format($format2));
                    $pos = $pos2;
                    $pos2 = $pos + $franjas;
                    $pesosTemp = null;
                    $pesosTemp = array_slice($pesos, $pos2, $franjas);
                    $media = null;
                    $media = array_sum($pesosTemp) / $franjas;
                    array_push($pesosS, $media);
                    array_push($dataPointsGraficabyIdSeconds, array("label" => $time->format($format2), "y" => $media));
                }
            }
        } else {
            $dataPointsGraficabyIdSeconds = null;
        }

        $pesosStr = implode(';', $pesosS);
        $instancesStr = implode(';', $instances);
        $filePesos = 'pesos.txt';
        $fileInstances = 'instances.txt';
        file_put_contents($filePesos, $pesosStr);
        file_put_contents($fileInstances, $instancesStr);

        shell_exec(''.$this->powershellDirectory.' conda activate base');
        shell_exec(''.$this->powershellDirectory.' '.$this->anacondaDirectory.' scriptProphet.py');

        $pesosProphetStr = file_get_contents('pesosProphet.txt');
        $pesosProphet = explode(";", $pesosProphetStr);

        $instancesProphetStr = file_get_contents('instancesProphet.txt');
        $instancesProphet = explode(";", $instancesProphetStr);

        $dataProphetStr = file_get_contents('dataProphet.txt');
        $dataProphet = explode(";", $dataProphetStr);

        $dataPointsProphet = array();

        for ($i = 0; $i < round($totalTime * 0.3); $i++) {
            array_push($dataPointsProphet, array("label" => $instancesProphet[$i], "y" => $pesosProphet[$i]));
        }

        $dataPointsProphet = array_merge($dataPointsGraficabyIdSeconds, $dataPointsProphet);

        $this->view("index", array(
            "allRegistros" => $allRegistros,
            "identificador" => $identificador,
            "dataPointsGraficabyIdSeconds" => $dataPointsGraficabyIdSeconds,
            "dataPointsProphet" => $dataPointsProphet,
            "dataProphet" => $dataProphet
        ));
    }

    /**
     * getGraficabyIdProphetFit: Recuperación de los datos de la gráfica con la variación de los pesos en el tiempo y los pesos con la predicción de Prophet (con Ajuste de Curva)
     * getGraficabyIdProphetFit: Get the chart's data with the variation of the weights over time and the weights with Prophet's prediction (with Curve Fitting)
     *
     * @return void Devuelve los datos de la gráfica con la variación de los pesos en el tiempo y los pesos con la predicción de Prophet | Returns the chart's data with the variation of the weights over time and the weights with Prophet's prediction
     */
    public function getGraficabyIdProphetFit()
    {
        if (isset($_GET["id2"])) {
            $identificador = $_GET["id2"];

            $registro = new Registro($this->adapter);
            $allRegistros = $registro->getAll();
            $allRegistrosbyId = $registro->getById($identificador);
            $pesos = explode(";", $allRegistrosbyId->brewData);
            $totalTime = $allRegistrosbyId->totalTime;
            $createdAt = $allRegistrosbyId->createdAt;

            if (count($pesos) > 1) {
                $dataPointsGraficabyIdBase = array();
                $instances = array();
                $pesosS = array();
                $seconds = 0;
                $format = 'Y-m-d H:i:s';
                $format2 = 'Y-m-d H:i:s.u';

                for ($i = 0; $i < count($pesos) - 1; $i++) {
                    $seconds = $totalTime / count($pesos) + $seconds;
                    $createdAtDateTime = null;
                    $createdAtDateTime = DateTime::createFromFormat($format, $createdAt);
                    $createdAt0 = null;
                    $createdAt0 = $createdAtDateTime->modify('-' . $totalTime . 'second');
                    $time = null;
                    $time = $createdAt0->modify('+' . round($seconds * 1000) . 'ms');
                    array_push($instances, $time->format($format2));
                    array_push($pesosS, $pesos[$i]);
                    array_push($dataPointsGraficabyIdBase, array("label" => $time->format($format2), "y" => $pesos[$i]));
                }
            }
        } else {
            $dataPointsGraficabyIdBase = null;
        }

        $pesosStr = implode(';', $pesosS);
        $instancesStr = implode(';', $instances);
        $filePesos = 'pesos.txt';
        $fileInstances = 'instances.txt';
        file_put_contents($filePesos, $pesosStr);
        file_put_contents($fileInstances, $instancesStr);

        shell_exec(''.$this->powershellDirectory.' conda activate base');
        shell_exec(''.$this->powershellDirectory.' '.$this->anacondaDirectory.' scriptProphetFit.py');
        
        $pesosFitStr = file_get_contents('pesosFit.txt');
        $pesosFit = explode(";", $pesosFitStr);

        $pesosProphetStr = file_get_contents('pesosProphet.txt');
        $pesosProphet = explode(";", $pesosProphetStr);

        $instancesProphetStr = file_get_contents('instancesProphet.txt');
        $instancesProphet = explode(";", $instancesProphetStr);

        $dataProphetStr = file_get_contents('dataProphet.txt');
        $dataProphet = explode(";", $dataProphetStr);

        $dataPointsFit = array();

        for ($i = 0; $i < count($pesos) - 2; $i++) {
            array_push($dataPointsFit, array("label" => $instances[$i], "y" => $pesosFit[$i]));
        }

        $dataPointsProphet = array();

        for ($i = 0; $i < count($pesosProphet); $i++) {
            array_push($dataPointsProphet, array("label" => $instancesProphet[$i], "y" => $pesosProphet[$i]));
        }

        $dataPointsProphet = array_merge($dataPointsFit, $dataPointsProphet);

        $this->view("index", array(
            "allRegistros" => $allRegistros,
            "identificador" => $identificador,
            "dataPointsGraficabyIdBase" => $dataPointsGraficabyIdBase,
            "dataPointsFit" => $dataPointsFit,
            "dataPointsProphet" => $dataPointsProphet,
            "dataProphet" => $dataProphet
        ));
    }

    /**
     * getGraficabyId: Recuperación de los datos de la gráfica con la variación de los pesos en el tiempo (Opción 1: instante por peso)
     * getGraficabyId: Get the chart's data with the variation of the weights over time (Option 1: instant by weight)
     *
     * @return void Devuelve los datos de la gráfica con la variación de los pesos en el tiempo | Returns the chart's data with the variation of the weights over time
     */
    public function getGraficabyId()
    {
        if (isset($_GET["id2"])) {
            $identificador = $_GET["id2"];

            $registro = new Registro($this->adapter);
            $allRegistros = $registro->getAll();
            $allRegistrosbyId = $registro->getById($identificador);
            $pesos = explode(";", $allRegistrosbyId->brewData);

            if (count($pesos) > 1) {
                $dataPointsGraficabyId = array();

                for ($i = 0; $i < count($pesos); $i++) {
                    array_push($dataPointsGraficabyId, array("x" => $i, "y" => $pesos[$i]));
                }
            } else {
                $dataPointsGraficabyId = null;
            }

            $this->view("index", array(
                "allRegistros" => $allRegistros,
                "dataPointsGraficabyId" => $dataPointsGraficabyId,
                "identificador" => $identificador
            ));
        }
    }

    /**
     * getGraficabyId2: Recuperación de los datos de la gráfica con la variación de los pesos en el tiempo (Opción 2: instante por peso diferente)
     * getGraficabyId2: Get the chart's data with the variation of the weights over time (Option 2: instant by different weight)
     *
     * @return void Devuelve los datos de la gráfica con la variación de los pesos en el tiempo | Returns the chart's data with the variation of the weights over time
     */
    public function getGraficabyId2()
    {
        if (isset($_GET["id2"])) {
            $identificador = $_GET["id2"];

            $registro = new Registro($this->adapter);
            $allRegistros = $registro->getAll();
            $allRegistrosbyId = $registro->getById($identificador);
            $pesos = explode(";", $allRegistrosbyId->brewData);

            if (count($pesos) > 1) {
                $dataPointsGraficabyId = array();

                for ($i = 0; $i < count($pesos); $i++) {
                    if ($i > 0 && ($pesos[$i] != $pesos[$i - 1])) {
                        array_push($dataPointsGraficabyId, array("x" => $i, "y" => $pesos[$i]));
                    }
                }
            } else {
                $dataPointsGraficabyId = null;
            }

            $this->view("index", array(
                "allRegistros" => $allRegistros,
                "dataPointsGraficabyId" => $dataPointsGraficabyId,
                "identificador" => $identificador
            ));
        }
    }

    /**
     * getGraficabyId3: Recuperación de los datos de la gráfica con la variación de los pesos en el tiempo (Opción 3: instante por peso diferente en parte entera)
     * getGraficabyId3: Get the chart's data with the variation of the weights over time (Option 3: instant by different weight in the integer part)
     *
     * @return void Devuelve los datos de la gráfica con la variación de los pesos en el tiempo | Returns the chart's data with the variation of the weights over time 
     */
    public function getGraficabyId3()
    {
        if (isset($_GET["id2"])) {
            $identificador = $_GET["id2"];

            $registro = new Registro($this->adapter);
            $allRegistros = $registro->getAll();
            $allRegistrosbyId = $registro->getById($identificador);
            $pesos = explode(";", $allRegistrosbyId->brewData);

            if (count($pesos) > 1) {
                $dataPointsGraficabyId = array();

                for ($i = 0; $i < count($pesos); $i++) {
                    if ($i > 0 && (floor((float) $pesos[$i]) != floor((float) $pesos[$i - 1]))) {
                        array_push($dataPointsGraficabyId, array("x" => $i, "y" => $pesos[$i]));
                    }
                }
            } else {
                $dataPointsGraficabyId = null;
            }

            $this->view("index", array(
                "allRegistros" => $allRegistros,
                "dataPointsGraficabyId" => $dataPointsGraficabyId,
                "identificador" => $identificador
            ));
        }
    }

    /**
     * getGraficabyId4: Recuperación de los datos de la gráfica con la variación de los pesos en el tiempo (Opción 4: pesos medios en distintas franjas por instante)
     * getGraficabyId4: Get the chart's data with the variation of the weights over time (Option 4: average weight in N-instant strips)
     *
     * @return void Devuelve los datos de la gráfica con la variación de los pesos en el tiempo | Returns the chart's data with the variation of the weights over time
     */
    public function getGraficabyId4()
    {
        if (isset($_GET["id2"]) && isset($_GET["franjas"])) {
            $identificador = $_GET["id2"];
            $franjas = $_GET["franjas"];

            $registro = new Registro($this->adapter);
            $allRegistros = $registro->getAll();
            $allRegistrosbyId = $registro->getById($identificador);
            $pesos = explode(";", $allRegistrosbyId->brewData);
            $slice = count($pesos) / $franjas;

            if (count($pesos) > 1) {
                $dataPointsGraficabyId = array();

                for ($i = 0; $i < $franjas; $i++) {
                    if ($i == 0) {
                        array_push($dataPointsGraficabyId, array("x" => 0, "y" => $pesos[0]));
                    } else {
                        $array_slice = array_slice($pesos, $slice * ($i - 1), $slice);
                        $media = array_sum($array_slice) / $slice;
                        array_push($dataPointsGraficabyId, array("x" => $slice * $i, "y" => $media));
                    }
                }
            } else {
                $dataPointsGraficabyId = null;
            }

            $this->view("index", array(
                "allRegistros" => $allRegistros,
                "dataPointsGraficabyId" => $dataPointsGraficabyId,
                "identificador" => $identificador
            ));
        }
    }

    /**
     * ordenarId: Ordenación de registros por identificador
     * ordenarId: Sorting records by identifier
     *
     * @return void
     */
    public function ordenarId()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("id");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * ordenarName: Ordenación de registros por nombre
     * ordenarName: Sorting records by name
     *
     * @return void
     */
    public function ordenarName()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("name");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * ordenarCreatedAt: Ordenación de registros por fecha de creación
     * ordenarCreatedAt: Sorting records by creation date
     *
     * @return void
     */
    public function ordenarCreatedAt()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("createdAt");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * ordenarTemperature: Ordenación de registros por temperatura
     * ordenarTemperature: Sorting records by temperature
     *
     * @return void
     */
    public function ordenarTemperature()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("temperature");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * ordenarGrind: Ordenación de registros por grind
     * ordenarGrind: Sorting records by grind
     *
     * @return void
     */
    public function ordenarGrind()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("grind");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * ordenarTasty: Ordenación de registros por tasty
     * ordenarTasty: Sorting records by tasty
     *
     * @return void
     */
    public function ordenarTasty()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("tasty");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * ordenarNote: Ordenación de registros por anotación
     * ordenarNote: Sorting records by note
     *
     * @return void
     */
    public function ordenarNote()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("note");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * ordenarTotalTime: Ordenación de registros por tiempo de duración
     * ordenarTotalTime: Sorting records by the total recording duration time
     *
     * @return void
     */
    public function ordenarTotalTime()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("totalTime");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * ordenarAverageFlowrate: Ordenación de registros por peso medio
     * ordenarAverageFlowrate: Sorting records by average flowrate
     *
     * @return void
     */
    public function ordenarAverageFlowrate()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("averageFlowrate");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * ordenarTotalWeight: Ordenación de registros por peso máximo
     * ordenarTotalWeight: Sorting records by maximum weight
     *
     * @return void
     */
    public function ordenarTotalWeight()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("totalWeight");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * ordenarBrewData: Ordenación de registros por cadena de pesos
     * ordenarBrewData: Sorting records by the string with all record's weights
     *
     * @return void
     */
    public function ordenarBrewData()
    {
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAsc("brewData");

        $this->view("index", array(
            "allRegistros" => $allRegistros
        ));
    }

    /**
     * borrar: Borrado de un registro por identificador
     * borrar: Deleting a record by its identifier
     *
     * @return void
     */
    public function borrar()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            $registro = new Registro($this->adapter);
            $registro->deleteById($id);
        }
        $this->redirect("index", "index");
    }
}
