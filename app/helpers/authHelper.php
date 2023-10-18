<?php
class AuthHelper
{
    public function __construct()
    {
    }

    public function login($user)
    {
        session_start();
        $_SESSION['ID_USER'] = $user->id_usuario;
        $_SESSION['EMAIL'] = $user->email;
    }

    public function logout()
    {
        if (!isset($_SESSION))
            session_start();
        session_destroy();
    }

    public function isLogged()
    {
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['ID_USER'])) return true;
        return false;
    }
}
