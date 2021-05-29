<?php

/**
 * ControladorBase: clase que representa el controlador base
 * ControladorBase: class representing the base controller
 */
class ControladorBase
{
    /**
     * __construct: Constructor de la clase, que incluye la conexión a la base de datos, la entidad base y todos los modelos
     * __construct: Class contructor, which include the connection to the database, the base entity and all the models
     *
     * @return void
     */
    public function __construct()
    {
        require_once 'Conectar.php';
        require_once 'EntidadBase.php';

        foreach (glob("model/*.php") as $file) {
            require_once $file;
        }
    }

    /**
     * view: Carga de la vista y paso de valores a la misma
     * view: Loading the view and passing values ​​to it
     *
     * @param  string $vista Parámetro que representa el nombre de la vista | Parameter representing the view's name
     * @param  array $datos Parámetro que representa los datos que se pasan a la vista | Parameter representing the data passed to the view
     * @return void
     */
    public function view($vista, $datos)
    {
        foreach ($datos as $id_assoc => $valor) {
            ${$id_assoc} = $valor;
        }

        require_once 'core/AyudaVistas.php';

        //Descomentar en caso de uso (ayudas para cargar las vistas): $helper = new AyudaVistas();
        //Uncomment in case of use (aid to load views): $helper = new AyudaVistas();

        require_once 'view/' . $vista . 'View.php';
    }

    /**
     * redirect: Redirección a una vista
     * redirect: Redirection to a view
     *
     * @param  string $controlador Parámetro que representa el nombre del controlador | Parameter representing the controller's name
     * @param  string $accion Parámetro que representa el nombre de la acción | Parameter representing the action's name
     * @return void
     */
    public function redirect($controlador = CONTROLADOR_DEFECTO, $accion = ACCION_DEFECTO)
    {
        header("Location:index.php?controller=" . $controlador . "&action=" . $accion);
    }
}
