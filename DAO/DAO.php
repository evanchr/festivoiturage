<?php

namespace DAO;

abstract class DAO
{
    protected $connect;

    public function __construct($c)
    {
        $this->connect = $c;
    }

    // Redéfinition de la méthode connect 
    protected static function connectStatic()
    {
        try {
            //$connexion = new \PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');
            $connexion = new \PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root');

            $connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $connexion;
        } catch (\PDOException $e) {
            // Gérer les erreurs de connexion
            exit("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }


    public abstract function exists(object $obj);
    public abstract function create(object $obj);
    public abstract function update(object $obj, String $oldlog);
    public abstract function delete(object $obj);
}
?>