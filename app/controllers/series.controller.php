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
}
