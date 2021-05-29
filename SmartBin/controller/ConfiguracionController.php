<?php

/**
 * ConfiguracionController: clase que representa el controlador de la vista "Configuración"
 * ConfiguracionController: class representing the controller's view "Configuration"
 */
class ConfiguracionController extends ControladorBase
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
     * index: Acción por defecto que carga la vista "Configuracion" 
     * index: Default action which loads the view "Configuration" 
     *
     * @return void
     */
    public function index()
    {
        $this->view("configuracion", array());
    }

    /**
     * cambiarIdioma: Cambio del idioma en castellano o inglés
     * cambiarIdioma: Change of the language in Spanish or English
     * @return void
     */
    public function cambiarIdioma()
    {
        if (isset($_GET["idioma"]) && isset($_GET["vista"])) {

            if ($_GET["idioma"] == "es") {
                $_COOKIE['idioma'] = 'es';
            } else {
                $_COOKIE['idioma'] = 'en';
            }

            setcookie('idioma', $_COOKIE['idioma']);

            $this->redirect($_GET["vista"], "index");
        }
    }

    /**
     * cambiarZoom: Cambio del modo de zoom de las gráficas 
     * cambiarZoom: Change of the chart's zoom mode
     * @return void
     */
    public function cambiarZoom()
    {
        if (isset($_GET["zoom"])) {

            if ($_GET["zoom"] == "true") {
                $_COOKIE['zoom'] = 'true';
                $mensajeZoom = true;
            } else {
                $_COOKIE['zoom'] = 'false';
                $mensajeZoom = false;
            }

            setcookie('zoom', $_COOKIE['zoom']);

            $this->view("configuracion", array(
                "mensajeZoom" => $mensajeZoom
            ));
        }
    }

    /**
     * cambiarFondo: Cambio del fondo de las gráficas
     * cambiarFondo: Change of the chart's background
     * @return void
     */
    public function cambiarFondo()
    {
        if (isset($_GET["fondo"])) {

            if ($_GET["fondo"] == "true") {
                $_COOKIE['fondo'] = 'true';
                $mensajeFondo = true;
            } else {
                $_COOKIE['fondo'] = 'false';
                $mensajeFondo = false;
            }

            setcookie('fondo', $_COOKIE['fondo']);

            $this->view("configuracion", array(
                "mensajeFondo" => $mensajeFondo
            ));
        }
    }

    /**
     * cambiarFondo: Cambio del modo de exportar de las gráficas
     * cambiarFondo: Change of the chart's export mode
     * @return void
     */
    public function cambiarExporte()
    {
        if (isset($_GET["exporte"])) {

            if ($_GET["exporte"] == "true") {
                $_COOKIE['exporte'] = 'true';
                $mensajeExporte = true;
            } else {
                $_COOKIE['exporte'] = 'false';
                $mensajeExporte = false;
            }

            setcookie('exporte', $_COOKIE['exporte']);

            $this->view("configuracion", array(
                "mensajeExporte" => $mensajeExporte
            ));
        }
    }
}
