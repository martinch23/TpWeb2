<?php

class AuthView
{
    private $authHelper;
    function __construct()
    {
        $this->authHelper = new AuthHelper();
    }
    public function showLogin($error = null)
    {
        $isLogged = $this->authHelper->isLogged();
        require 'templates/login.phtml';
    }
}
