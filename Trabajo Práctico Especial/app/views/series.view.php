<?php

class SeriesView
{

    //hago un nuevo metodo (función) de vista
    function ShowSeries($series)
    {
        include 'templates/seriesList.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
    }
    function editSeries($serie)
    {
        include 'templates/editSerie.phtml';
    }



    function showCapitulos($capitulos)
    {
        include 'templates/chaptersList.phtml';
    }
}
