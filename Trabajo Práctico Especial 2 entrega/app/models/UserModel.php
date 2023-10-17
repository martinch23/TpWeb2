<?php
include_once 'model.php';

class UserModel extends Model
{

    function getUser($mail)
    {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        $query->execute([$mail]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
