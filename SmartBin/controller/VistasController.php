<?php

/**
 * VistasController: clase que representa el controlador de la vista "Vistas"
 * VistasController: class representing the controller's view "Views"
 */
class VistasController extends ControladorBase
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
    }

    /**
     * index: Acción por defecto, que carga la vista "Vistas" y pasa de valores a la misma
     * index: Default action, which loads the view "Views" and pass values ​​to it
     *
     * @return void
     */
    public function index()
    {
        $registro = new Registro($this->adapter);
        if ($registro->getAll() != null) {
            $allRegistrosCount = count($registro->getAll());
            if ($registro->getBy("brewData", NULL) != null) {
                $allRegistrosGetByBrewDataNULLCount = count($registro->getBy("brewData", NULL));
            } else {
                $allRegistrosGetByBrewDataNULLCount = 0;
            }
            $allRegistrosTotalWeightMax = $this->getArrayTotalWeightMax();
            $allRegistrosBrewDataMin = $this->getArrayPesosMin();

            $dataPointsGrafica1 = $this->getArrayGrafica1();
            $dataPointsGrafica2 = $this->getArrayGrafica2();
            $dataPointsGrafica3 = $this->getArrayGrafica3();
            $dataPointsGrafica4 = $this->getArrayGrafica4();
        } else {
            $allRegistrosCount = null;
            $allRegistrosGetByBrewDataNULLCount = null;
            $allRegistrosTotalWeightMax = null;
            $allRegistrosBrewDataMin = null;

            $dataPointsGrafica1 = null;
            $dataPointsGrafica2 = null;
            $dataPointsGrafica3 = null;
            $dataPointsGrafica4 = null;
        }

        $this->view("vistas", array(
            "allRegistrosCount" => $allRegistrosCount,
            "allRegistrosGetByBrewDataNULLCount" => $allRegistrosGetByBrewDataNULLCount,
            "allRegistrosTotalWeightMax" => $allRegistrosTotalWeightMax,
            "allRegistrosBrewDataMin" => $allRegistrosBrewDataMin,
            "dataPointsGrafica1" => $dataPointsGrafica1,
            "dataPointsGrafica2" => $dataPointsGrafica2,
            "dataPointsGrafica3" => $dataPointsGrafica3,
            "dataPointsGrafica4" => $dataPointsGrafica4
        ));
    }

    /**
     * getArrayPesos: Recuperación del mínimo de todos los pesos
     * getArrayPesos: Get the minimum of all weights
     *
     * @return double Devuelve el mínimo de todos los pesos | Returns the minimum of all weights
     */
    public function getArrayPesosMin()
    {
        $allRegistrosBrewData = array();
        $registro = new Registro($this->adapter);
        $min = 0;

        if ($registro->getNoBy("brewData", NULL) != null) {
            $allRegistrosGetNoByBrewDataNULL = $registro->getNoBy("brewData", NULL);

            foreach ($allRegistrosGetNoByBrewDataNULL as $r) {
                $pesos = null;
                $pesos = explode(";", $r->brewData);

                for ($i = 0; $i < count($pesos); $i++) {
                    if ($pesos[$i] > 0) {
                        array_push($allRegistrosBrewData, $pesos[$i]);
                    }
                }
            }
            $min = min($allRegistrosBrewData);
        } else {
            $min = 0;
        }
        return $min;
    }

    /**
     * getArrayTotalWeight: Recuperación del máximo de todos los pesos máximos
     * getArrayTotalWeight: Get the maximum of all maximum weights
     *
     * @return double Devuelve el máximo de todos los pesos máximos | Returns the maximum of all maximum weights
     */
    public function getArrayTotalWeightMax()
    {
        $allRegistrosTotalWeight = array();
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAll();

        foreach ($allRegistros as $r) {
            array_push($allRegistrosTotalWeight, $r->totalWeight);
        }

        return max($allRegistrosTotalWeight);
    }

    /**
     * getArrayGrafica1: Recuperación de los datos de la gráfica con los pesos medios de los registros
     * getArrayGrafica1: Get the data from the chart with the average weights of the records
     *
     * @return array Devuelve los datos de la gráfica con los pesos medios de los registros | Returns the data from the chart with the average weights of the records
     */
    public function getArrayGrafica1()
    {
        $dataPointsGrafica1 = array();
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAll();

        foreach ($allRegistros as $r) {
            array_push($dataPointsGrafica1, array("label" => $r->name, "y" => $r->averageFlowrate));
        }

        return $dataPointsGrafica1;
    }

    /**
     * getArrayGrafica2: Recuperación de los datos de la gráfica con los pesos medios por fecha
     * getArrayGrafica2: Get the data from the chart with the average weights by date
     *
     * @return array Devuelve los datos de la gráfica con los pesos medios por fecha | Returns the data from the chart with the average weights by date
     */
    public function getArrayGrafica2()
    {
        $dataPointsGrafica2 = array();
        $registro = new Registro($this->adapter);
        $allRegistrosGetAscCreatedAt = $registro->getAsc("createdAt");

        foreach ($allRegistrosGetAscCreatedAt as $r) {
            array_push($dataPointsGrafica2, array("label" => $r->createdAt, "y" => $r->averageFlowrate));
        }

        return $dataPointsGrafica2;
    }

    /**
     * getArrayGrafica3: Recuperación de los datos de la gráfica con los pesos máximos de los registros
     * getArrayGrafica3: Get the data from the chart with the maximum weights of the records
     *
     * @return array Devuelve los datos de la gráfica con los pesos máximos de los registros | Returns the data from the chart with the maximum weights of the records
     */
    public function getArrayGrafica3()
    {
        $dataPointsGrafica3 = array();
        $registro = new Registro($this->adapter);
        $allRegistros = $registro->getAll();

        foreach ($allRegistros as $r) {
            array_push($dataPointsGrafica3, array("label" => $r->name, "y" => $r->totalWeight));
        }

        return $dataPointsGrafica3;
    }

    /**
     * getArrayGrafica4: Recuperación de los datos de la gráfica con los pesos máximos por fecha
     * getArrayGrafica4: Get the data from the chart with the maximum weights by date
     *
     * @return array Devuelve los datos de la gráfica con los pesos máximos por fecha | Returns the data from the chart with the maximum weights by date
     */
    public function getArrayGrafica4()
    {
        $dataPointsGrafica4 = array();
        $registro = new Registro($this->adapter);
        $allRegistrosGetAscCreatedAt = $registro->getAsc("createdAt");

        foreach ($allRegistrosGetAscCreatedAt as $r) {
            array_push($dataPointsGrafica4, array("label" => $r->createdAt, "y" => $r->totalWeight));
        }

        return $dataPointsGrafica4;
    }
}
