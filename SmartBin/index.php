<!-- Página principal -->
<!-- Main page -->

<?php
//Configuración global en castellano o inglés y configuración inicial de los gráficos
//Global configuration in Spanish or English and initial graphics settings
if (!isset($_COOKIE['idioma'])) {
    $_COOKIE['idioma'] = 'es';
}
if (!isset($_COOKIE['zoom'])) {
    $_COOKIE['zoom'] = "true";
}
if (!isset($_COOKIE['fondo'])) {
    $_COOKIE['fondo'] = "false";
}
if (!isset($_COOKIE['exporte'])) {
    $_COOKIE['exporte'] = "true";
}
if ($_COOKIE['idioma'] == "es") {
    require_once 'config/globalEs.php';
} else if ($_COOKIE['idioma'] == "en") {
    require_once 'config/globalEn.php';
}

//Base para los controladores
//Base for controllers
require_once 'core/ControladorBase.php';

//Funciones para el controlador frontal
//Functions for the front controller
require_once 'core/ControladorFrontal.func.php';

//Se cargan controladores y acciones
//Controllers and actions are loaded
if (isset($_GET["controller"])) {
    $controllerObj = cargarControlador($_GET["controller"]);
    lanzarAccion($controllerObj);
} else {
    $controllerObj = cargarControlador(CONTROLADOR_DEFECTO);
    lanzarAccion($controllerObj);
}
