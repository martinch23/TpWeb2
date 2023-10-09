<?php
class SeriesModel
{

    //ahora genero en constructor, lo pienso como una propiedad de la clase (private $db), y en este caso vamos a usarlo para abrir la conexion a la BBDD, 
    //y no repetir este paso en cada funcion que haga despues abajo:

    private $db; //1° agrego la propiedad


    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=base de datos tp;charset=utf8', 'root', '');
    }

    function getSeries()
    {
        $query = $this->db->prepare('SELECT * FROM series');
        $query->execute();

        // $tasks es un arreglo de tareas
        $series = $query->fetchAll(PDO::FETCH_OBJ);

        return $series;
    }
}
