<?php

/**
 * ControladorFrontal: funciones para el controlador frontal
 * ControladorFrontal: functions for the front controller
 */

/**
 * cargarControlador: Carga el controlador
 * cargarControlador: Load the controller
 *
 * @param  string $controller Parámetro que representa el nombre del controlador | Parameter representing the controller's name
 * @return object Devuelve el controlador | Returns the controller
 */
function cargarControlador($controller)
{
    $controlador = ucwords($controller) . 'Controller';
    $strFileController = 'controller/' . $controlador . '.php';

    if (!is_file($strFileController)) {
        $strFileController = 'controller/' . ucwords(CONTROLADOR_DEFECTO) . 'Controller.php';
    }

    require_once $strFileController;
    return new $controlador();
}

/**
 * cargarAccion: Carga una acción
 * cargarAccion: Load an action
 *
 * @param  object $controllerObj Parámetro que representa el controlador | Parameter representing the controller
 * @param  string $action Parámetro que representa el nombre de la acción | Parameter representing the action's name
 * @return void
 */
function cargarAccion($controllerObj, $action)
{
    $accion = $action;
    $controllerObj->$accion();
}

/**
 * lanzarAccion: Lanzar una acción
 * lanzarAccion: Launch an action
 *
 * @param  object $controllerObj Parámetro que representa el controlador | Parameter representing the controller
 * @return void
 */
function lanzarAccion($controllerObj)
{
    if (isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])) {
        cargarAccion($controllerObj, $_GET["action"]);
    } else {
        cargarAccion($controllerObj, ACCION_DEFECTO);
    }
}
