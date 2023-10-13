<?php
/*Reemplazar por require once y el view apropiado*/
require_once './Model/ChapterModel.php';
require_once 'UserController.php';
require_once 'SerieController.php';

class ChapterController
{
    private $view;
    private $model;
    private $serie_controller;
    private $user_controller;

    function __construct()
    {
        /*Agregar View*/
        $this->model = new ChapterModel();
        $this->serie_controller = new SerieController();
        $this->user_controller = new UserController();
    }

    function Home()
    {
        $logged = $this->user_controller->CheckLoggedIn();
        $serie = $this->serie_controller->GetSeries();
        $admin = $this->user_controller->checkAdmin();
        $this->view->RenderHome($serie, $logged, $admin);
    }

    function LoadSerie($params = null)
    {
        $serie = $this->serie_controller->GetSeries();
        $serie = $params[':SerieNumber'];
        if ($serie !== 'all') {
            $id_season = $this->serie_controller->GetSerieId($serie);
            $capitulos = $this->model->GetCapitulos($id_serie->id);
        } else {
            $capitulos = $this->model->GetCapitulos($serie);
        }

        $logged = $this->user_controller->CheckLoggedIn();
        $admin = $this->user_controller->checkAdmin();
        $this->view->RenderList($capitulos, $serie, $logged, $admin);
    }


    function CheckIfExists($new_nombre)
    {
        $capitulos = $this->model->GetCapitulos("all");
        foreach ($capitulos as $capitulo) {
            $nombre = $capitulo->nombre;
            if ($nombre == $new_nombre) {
                return true;
            }
        }
    }

    function LoadEdit($params = null)
    {
        $logged = $this->user_controller->CheckLoggedIn();
        $admin = $this->user_controller->checkAdmin();
        if ($logged) {
            if ($admin) {
                $id_edit = $params[':ID'];
                $series = $this->serie_controller->GetSeries();
                $capitulo_to_edit = $this->model->GetCapitulo($id_edit);

                $this->view->RenderEdit($series, $logged, $editar_capitulo, $admin);
            } else {
                $this->view->RenderError('No tienes permisos de super usuario');
            }
        } else {
            $this->view->RenderError('no estas logueado');
        }
    }

    function EditChapter($params = null)
    {
        if (isset($_POST['nombre_edit']) && isset($_POST['duracion']) && isset ($_POST['id_capitulo']) && isset ($_POST['id_serie'])) {
            $logged = $this->user_controller->CheckLoggedIn();
            $admin = $this->user_controller->checkAdmin();
            if ($logged) {
                if ($admin) {
                    $id = $params[':ID'];
                    $this->model->UpdateChapter($_POST['nombre_edit'], $_POST['duracion_edit'], $_POST['id_capitulo_edit'], $_POST['id_serie_edit'], $id
                } else {
                    $this->view->RenderError('no tienes permisos de super admin');
                }
            } else {
                $this->view->RenderError('no estas logueado');
            }
        } else {
            $this->view->RenderError('no completaste todos los campos');
        }
    }

    function deleteFile($path)
    {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return true;
        }
    }

    function DeleteChapter($params = null)
    {
        $logged = $this->user_controller->CheckLoggedIn();
        $admin = $this->user_controller->checkAdmin();
        if ($logged) {
            if ($admin) {
                $id = $params[':ID'];
                
                $id_serie = $this->model->DeleteCapitulo($id);
                $serie_model = new SerieModel();
                $serie = $serie_model->GetSeries($id_serie->id_serie);
                
            } else {
                $this->view->RenderError('no eres super usuario');
            }
        } else {
            $this->view->RenderError('no estas logueado');
        }
    }

    function UploadMode()
    {
        $logged = $this->user_controller->CheckLoggedIn();
        $admin = $this->user_controller->checkAdmin();
        if ($logged) {
            if ($admin) {
                $series = $this->serie_controller->GetSeries();
                $this->view->RenderUploadMode($series, $logged, $admin);
            } else {
                $this->view->RenderError('no eres super usuario');
            }
        } else {
            $this->view->RenderError('no estas logueado');
        }
    }

    function InsertCapitulo()
{
        $logged = $this->user_controller->CheckLoggedIn();
        $admin = $this->user_controller->checkAdmin();
        if ($logged) {
            if ($admin) {
                if (isset($_POST['nombre_input']) && isset($_POST['duracion_input']) && isset($_POST['id_capitulo_input']) && isset($_POST['id_serie_input'])) {
                    if (!$this->CheckIfExists($_POST['nombre_input'])) {
                        $serie = $_POST['serie_input'];
                        $id_serie = $this->serie_controller->GetSerieId($serie);
                        $this->model->InsertCapitulo($_POST['nombre_input'], $_POST['duracion_input'], $_POST['id_capitulo_input'], $_POST['id_serie_input'], $id_serie ->id);
                        
                    } else {
                        $this->view->RenderError('ya tenemos este capitulo');
                    }
                } else {
                    $this->view->RenderError('no completaste todos los campos');
                }
            } else {
                $this->view->RenderError("no eres super usuario");
            }
        } else {
            $this->view->RenderError('no estas logueado');
        }
    }
}
//finished
