/*Adaptar contenido del model para capitulos de las series agregar elementos faltantes de las tablas SQL*/

<?php
class ChapterModel
{
    private $db;
    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=serieflix_db;charset=utf8', 'root', '');
    }

    function GetChapters($season = null)
    {
        if ($id_serie !== "all") {
            $sentencia = $this->db->prepare("SELECT * FROM capitulo Where id_serie = ?");
            $sentencia->execute(array($id_serie));
        } else {
            $sentencia = $this->db->prepare(
                "SELECT 
                id_capitulo id,
                nombre nombre,
                duración duracion,
                id_serie serie,  
                FROM 
                capi INNER JOIN serie ON capitulo.id_serie = id_serie 
                ORDER BY serie.serie ASC"
            );
            $sentencia->execute();
        }
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function InsertChapter($nombre, $duracion, $serie, $id_capitulo)
    {
        if ($id_capitulo !== NULL) {
            $sentencia = $this->db->prepare("INSERT INTO chapter(nombre,duracion,serie,id_capitulo) VALUES(?,?,?,?)");
            $sentencia->execute(array($nombre, $duracion, $serie, $id_capitulo));
        } else {
            $sentencia = $this->db->prepare("INSERT INTO chapter(nombre,duracion,serie,id_capitulo) VALUES(?,?,?,?)");
            $sentencia->execute(array($nombre, $duracion, $serie, $id_capitulo));
        }
    }

    function UpdateChapter($nombre, $duracion, $serie, $id_capitulo)
    {
        if ($id_capitulo !== NULL) {
            $sentencia = $this->db->prepare('UPDATE capitulo SET nombre=?,duracion=?,serie=?,id_capitulo=?, WHERE id=?');
            $sentencia->execute(array($nombre, $duracion, $serie, $id_capitulo));
        } else {
            $sentencia = $this->db->prepare('UPDATE chapter SET nombre=?,duracion=?,serie=?,id_capitulo=?WHERE id=?');
            $sentencia->execute(array($nombre, $duracion, $serie, $id_capitulo));
        }
    }

    function DeleteChapter($id)
    {
        $aux = $this->db->prepare("SELECT id_serie FROM capitulo WHERE id_capitulo=?");
        $aux->execute([$id]);
        $sentencia = $this->db->prepare("DELETE FROM capitulo WHERE id_capitulo=?");
        $sentencia->execute(array($id));
        return $aux->fetch(PDO::FETCH_OBJ);
    }
    function DeleteAllChapters($id)
    {
        $sentencia = $this->db->prepare("DELETE FROM capitulo WHERE id_serie=?");
        $sentencia->execute(array($id));
    }
    function GetChapter($id)
    {
        $sentencia = $this->db->prepare("SELECT 
        id_capitulo,
        nombre,
        duración,
        id_serie,
        chapter.writer,
        chapter.description,
        chapter.emision_date,
        chapter.thumbnail_path,
        chapter.id_season,
        FROM capitulo
	WHERE id_capitulo=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
}
//finished
