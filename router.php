<?php
include_once 'app/controllers/series.controller.php'; //incluyo el archivo controller ya que lo uso abajo (en $controller....)



define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


$action = 'home'; // accion por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) { // en la primer posicion tengo la accion real
    case 'login':
        $controller = new AuthController;
        $controller->showLogin();
        break;
    case 'home':
        $controller = new SeriesController(); //llamo al controlador para relacionarlo
        $controller->showSeries();
        break;
}
