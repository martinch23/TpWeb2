<?php
include_once 'app/models/series.model.php';
include_once 'app/views/series.view.php';


class SeriesController
{

    private $model;
    private $view;

    function __construct()
    {
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
        require 'templates/formulario_series.phtml';
    }

    public function addSerie()
    {


        $titulo = $_POST['titulo'];
        $genero = $_POST['genero'];


        // validaciones
        if (empty($titulo) || empty($genero)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertSerie($titulo, $genero);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar la serie");
        }
    }

    function showCapitulos($idSerie)
    {
        $capitulos = $this->model->getSerieCapitulos($idSerie);
        $this->view->showCapitulos($capitulos);
    }

    function removeSerie($id_serie)
    {

        $this->model->deleteSerie($id_serie);
        header('Location: ' . BASE_URL);
    }

    function editSeries($id)
    {
        $titulo = $_POST['titulo'];
        $genero = $_POST['genero'];
        if (empty($titulo) || empty($genero)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }
        $this->model->updateSeries($id, $titulo, $genero);
        header('Location: ' . BASE_URL);
    }

    function ShowEditForm($id)
    {
        $serie = $this->model->getSerie($id);
        $this->view->editSeries($serie);
    }
}
