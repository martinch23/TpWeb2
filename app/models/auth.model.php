<?php
require_once './app/models/model.php';

class UserModel extends basedatos
{
    public function getByEmail($email)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE email = ?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
