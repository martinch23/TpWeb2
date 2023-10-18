<?php

class ChapterView
{
    private $authHelper;
    function __construct()
    {
        $this->authHelper = new AuthHelper();
    }

    function ShowChapters($capitulos)
    {
        $isLogged = $this->authHelper->isLogged();
        include 'templates/chaptersList.phtml';
    }
    public function showError($error)
    {
        $isLogged = $this->authHelper->isLogged();
        require 'templates/error.phtml';
    }

    function showAddCapitulo($series)
    {
        $isLogged = $this->authHelper->isLogged();
        include 'templates/addChapter.phtml';
    }
    public function showEditForm($capitulo)
    {
        $isLogged = $this->authHelper->isLogged();
        require 'templates/formulario_chapters.phtml';
    }
}
