<?php

function showhome()
{
    require_once 'templates/header.php';
    echo "<h1> esto es el home </h1>";
    require_once 'templates/footer.php';
}


function showPelicula($id)
{
    require_once 'templates/header.php';
    echo "<h1> esto es una pelicula </h1>";
    require_once 'templates/footer.php';
}

function show404()
{
    require_once 'templates/header.php';
    echo "<h1> error 404</h1>";
    require_once 'templates/footer.php';
}
