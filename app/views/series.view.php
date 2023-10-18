<?php

class SeriesView
{
    private $authHelper;
    function __construct()
    {
        $this->authHelper = new AuthHelper();
    }

    //hago un nuevo metodo (función) de vista
    function ShowSeries($series)
    {
        $isLogged = $this->authHelper->isLogged();
        include 'templates/seriesList.phtml';
    }

    public function showError($error)
    {
        $isLogged = $this->authHelper->isLogged();
        require 'templates/error.phtml';
    }
    function editSeries($serie)
    {
        $isLogged = $this->authHelper->isLogged();
        include 'templates/editSerie.phtml';
    }



    function showCapitulos($capitulos)
    {
        $isLogged = $this->authHelper->isLogged();
        include 'templates/chaptersList.phtml';
    }
}
