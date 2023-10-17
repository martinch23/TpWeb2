<?php
include_once 'app/models/ChapterModel.php';
include_once 'app/views/Chapter.view.php';
include_once 'app/models/series.model.php';

class ChapterController
{

    private $model;
    private $view;
    private $seriesModel;

    function __construct()
    {
        $this->model = new ChapterModel();
        $this->view = new ChapterView();
        $this->seriesModel = new SeriesModel();
    }

    function showChapters()
    {
        //obtengo los capítulos del modelo
        $capitulos = $this->model->GetChapters();
        //actualizo la vista
        $this->view->ShowChapters($capitulos);
    }
    public function addChapter()
    {
        $nombre = $_POST['nombre'];
        $duracion = $_POST['duracion'];
        $id_serie = $_POST['id_serie'];
        // validaciones
        if (empty($nombre) || empty($duracion) || empty($id_serie)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }
        $this->model->insertChapter($nombre, $duracion, $id_serie);
        header('Location: ' . BASE_URL . '/capitulos');
    }

    function removeSerie($id_capitulo)
    {

        $this->model->deleteChapter($id_capitulo);
        header('Location: ' . BASE_URL);
    }

    function editChapter($id_capitulo)
    {
        $nombre = $_POST['nombre'];
        $duracion = $_POST['duracion'];
        if (empty($nombre) || empty($duracion)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }
        $this->model->updateChapter($id_capitulo, $nombre, $duracion);
        header('Location: ' . BASE_URL . '/capitulos');
    }

    function removeChapter($id_capitulo)
    {
        $this->model->deleteChapter($id_capitulo);
        header('Location: ' . BASE_URL . '/capitulos');
    }

    function showAddForm()
    {
        $series = $this->seriesModel->getSeries();
        $this->view->showAddCapitulo($series);
    }

    function ShowEditForm($idChapter)
    {
        $capitulo = $this->model->GetChapter($idChapter);
        $this->view->showEditForm($capitulo);
    }
}
