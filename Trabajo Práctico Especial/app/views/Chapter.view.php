<?php

class ChapterView
{

    function ShowChapters($capitulos)
    {

        include 'templates/chaptersList.phtml';
    }
    public function showError($error)
    {
        require 'templates/error.phtml';
    }

    function showAddCapitulo($series)
    {
        include 'templates/addChapter.phtml';
    }
    public function showEditForm($capitulo)
    {
        require 'templates/formulario_chapters.phtml';
    }
}
