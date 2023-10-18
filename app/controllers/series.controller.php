<?php
include_once 'app/models/series.model.php';
include_once 'app/views/series.view.php';


class SeriesController
{

    private $model;
    private $view;
    private $authHelper;
    function __construct()
    {
        $this->authHelper = new AuthHelper();
        $this->model = new SeriesModel();
        $this->view = new SeriesView();
    }

    //defino un método de la clase (funcion)
    function showSeries()
    {
        //obtengo las series del modelo
        $series = $this->model->getSeries();
        //actualizo la vista
        $this->view->ShowSeries($series);
    }

    function showAddForm()
    {
        $isLogged = $this->authHelper->isLogged();
        if ($isLogged) {
            require 'templates/formulario_series.phtml';
        }
    }

    public function addSerie()
    {
        $isLogged = $this->authHelper->isLogged();
        if ($isLogged) {
            $titulo = $_POST['titulo'];
            $genero = $_POST['genero'];


            // validaciones
            if (empty($titulo) || empty($genero)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }

            $this->model->insertSerie($titulo, $genero);
            header('Location: ' . BASE_URL);
        }
        header('Location: ' . BASE_URL);
    }

    function showCapitulos($idSerie)
    {
        $capitulos = $this->model->getSerieCapitulos($idSerie);
        $this->view->showCapitulos($capitulos);
    }

    function removeSerie($id_serie)
    {
        $isLogged = $this->authHelper->isLogged();
        if ($isLogged) {
            $this->model->deleteSerie($id_serie);
        }
        header('Location: ' . BASE_URL);
    }

    function editSeries($id)
    {
        $isLogged = $this->authHelper->isLogged();
        if ($isLogged) {
            $titulo = $_POST['titulo'];
            $genero = $_POST['genero'];
            if (empty($titulo) || empty($genero)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }
            $this->model->updateSeries($id, $titulo, $genero);
        }
        header('Location: ' . BASE_URL);
    }

    function ShowEditForm($id)
    {
        $isLogged = $this->authHelper->isLogged();
        if ($isLogged) {
            $serie = $this->model->getSerie($id);
            $this->view->editSeries($serie);
        }
    }
}
