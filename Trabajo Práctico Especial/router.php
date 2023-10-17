<?php
include_once 'app/controllers/series.controller.php'; //incluyo el archivo controller ya que lo uso abajo (en $controller....)
include_once 'app/controllers/auth.controller.php';
include_once 'app/controllers/chapterController.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


$action = 'home'; // accion por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
$seriesController = new SeriesController(); //llamo al controlador para relacionarlo
$authController = new AuthController();
$chapterController = new ChapterController();


switch ($params[0]) { // en la primer posicion tengo la accion real

    case 'home':
        $seriesController->showSeries();
        break;
    case 'login':
        $authController->showLogin();
        break;

    case 'auth':
        switch ($params[1]) {
            case 'login':
                $authController->verificarLogin();
                break;
            case 'logout':
                $authController->logout();
                break;
            default:
                break;
        }
        break;
    case 'series':
        if (isset($params[1])) {
            switch ($params[1]) {
                case 'agregar':
                    $seriesController->showAddForm();
                    break;
                case 'add':
                    $seriesController->addSerie();
                    break;
                case 'edit':
                    $seriesController->editSeries($params[2]);
                    break;
                case 'editar':
                    $seriesController->ShowEditForm($params[2]);
                    break;
                case 'eliminar':
                    $seriesController->removeSerie($params[2]);
                    break;
                case 'capitulos':
                    $seriesController->showCapitulos($params[2]);
                    break;
                default:
                    break;
            }
        } else {
            $seriesController->showSeries();
        }
        break;

    case 'capitulos':
        if (isset($params[1])) {
            switch ($params[1]) {
                case 'agregar':
                    $chapterController->showAddForm();
                    break;
                case 'add':
                    $chapterController->addChapter();
                    break;
                case 'editar':
                    $chapterController->ShowEditForm($params[2]);
                    break;
                case 'edit':
                    $chapterController->editChapter($params[2]);
                    break;
                case 'editar':
                    $chapterController->ShowEditForm($params[2]);
                    break;
                case 'eliminar':
                    $chapterController->removeChapter($params[2]);
                    break;
                default:
                    break;
            }
        } else {
            $chapterController->showChapters();
        }
        break;
}
