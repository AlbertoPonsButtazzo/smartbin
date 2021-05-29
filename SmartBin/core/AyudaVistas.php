<?php

/**
 * AyudaVistas: clase con ayudas para cargar las vistas
 * AyudaVistas: class with aid to load the views
 */
class AyudaVistas
{
    /**
     * url: Definición de la url de la vista
     * url: Definition of the views's url
     *
     * @param  string $controlador Parámetro que representa el nombre del controlador | Parameter representing the controller's name
     * @param  string $accion Parámetro que representa el nombre de la acción | Parameter representing the action's name
     * @return string Devuelve la url de la vista | Returns the views's url
     */
    public function url($controlador = CONTROLADOR_DEFECTO, $accion = ACCION_DEFECTO)
    {
        return "index.php?controller=" . $controlador . "&action=" . $accion;;
    }
}
