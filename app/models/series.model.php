<?php
require_once 'model.php';

class SeriesModel extends Model
{

    function getSeries()
    {
        $query = $this->db->prepare('SELECT * FROM series');
        $query->execute();
        $series = $query->fetchAll(PDO::FETCH_OBJ);

        return $series;
    }

    function insertSerie($titulo, $genero)
    {
        $query = $this->db->prepare('INSERT INTO series (titulo, genero) VALUES(?,?)');
        $query->execute([$titulo, $genero]);
    }

    function getSerieCapitulos($idSerie)
    {
        $query = $this->db->prepare('SELECT c.*, titulo FROM capitulos c join series s on (c.id_serie = s.id_serie) where c.id_serie = ?');
        $query->execute([$idSerie]);
        $capitulos = $query->fetchAll(PDO::FETCH_OBJ);

        return $capitulos;
    }

    function deleteSerie($id_serie)
    {
        $query = $this->db->prepare('DELETE FROM series WHERE id_serie = ?');
        $query->execute([$id_serie]);
    }
    function updateSeries($id, $titulo, $genero)
    {
        $query = $this->db->prepare('update series set titulo = ?, genero = ? where id_serie = ?');
        $query->execute([$titulo, $genero, $id]);
    }

    function getSerie($id)
    {
        $query = $this->db->prepare('SELECT * FROM series where id_serie = ?');
        $query->execute([$id]);
        $serie = $query->fetch(PDO::FETCH_OBJ);

        return $serie;
    }
}
