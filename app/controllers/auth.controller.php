<?php
require_once './app/views/auth.view.php';
require_once './app/helpers/authHelper.php';
require_once './app/models/UserModel.php';

class AuthController
{
    private $model;
    private $view;
    private $authHelper;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new AuthView();
        $this->authHelper = new AuthHelper();
    }


    public function showLogin()
    {
        if ($this->authHelper->isLogged()) {
            return header('Location: ' . BASE_URL);
        }
        $this->view->showLogin();
    }

    function verificarLogin()
    {
        $mail = $_POST["email"];
        $password = $_POST["password"];
        $dbUser = $this->model->getUser($mail);
        if (isset($dbUser)) {
            if (password_verify($password, $dbUser->password)) {
                $this->authHelper->login($dbUser);
                header('Location: ' . BASE_URL);
                return;
            }
        }
        $this->view->showLogin("Acceso denegado");
    }

    function logout()
    {
        $this->authHelper->logout();
        header('Location: ' . BASE_URL);
    }
}
