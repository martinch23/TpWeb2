
<?php
require_once 'model.php';

class ChapterModel extends Model
{
    function GetChapters()
    {
        $query = $this->db->prepare('SELECT c.*, s.titulo FROM capitulos c join series s on (s.id_serie = c.id_serie)');
        $query->execute();
        $capitulos = $query->fetchAll(PDO::FETCH_OBJ);

        return $capitulos;
    }

    function insertChapter($nombre, $duracion, $id_serie)
    {
        $query = $this->db->prepare('INSERT INTO capitulos (nombre, duracion, id_serie) VALUES(?,?,?)');
        $query->execute([$nombre, $duracion, $id_serie]);

        return $this->db->lastInsertId();
    }

    function deleteChapter($id_capitulo)
    {
        $query = $this->db->prepare('DELETE FROM capitulos WHERE id_capitulo = ?');
        $query->execute([$id_capitulo]);
    }


    function updateChapter($id_capitulo, $nombre, $duracion)
    {
        $query = $this->db->prepare('update capitulos set duracion = ?, nombre = ? where id_capitulo = ?');
        $query->execute([$duracion, $nombre, $id_capitulo]);
    }

    function GetChapter($id)
    {
        $query = $this->db->prepare('SELECT * FROM capitulos c join series s on (s.id_serie=c.id_serie) WHERE id_capitulo = ?');
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
