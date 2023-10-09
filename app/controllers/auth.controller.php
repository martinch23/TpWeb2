<?php
require_once './app/views/auth.view.php';
require_once './app/models/auth.model.php';



class AuthController
{
    private $model;
    private $view;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }


    public function showLogin()
    {
        $this->view->showLogin();
    }
}
