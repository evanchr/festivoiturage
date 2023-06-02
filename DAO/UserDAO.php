<?php

namespace DAO;
require_once 'DAO/DAO.php';
use models\User;

class UserDAO extends DAO {

    public function __construct($c) {
        parent::__construct($c);
    }

    // vérifier l'existence de l'association pseudo/mot de passe dans la bd
    public function exists(object $user) {
        $login = $user->getPseudo();
        $password = $user->getPassword();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM user WHERE pseudo = :login AND password = :password");
        $pdostat->bindValue(':login', $login);
        $pdostat->bindValue(':password', $password);
        $pdostat->execute();
        return $pdostat;
    }

    public function create(object $user) {
        // Logique pour créer un utilisateur dans la base de données
        return false;
    }

    public function update(object $user) {
        // Logique pour mettre à jour un utilisateur dans la base de données
        return false;
    }

    public function delete(object $user) {
        // Logique pour supprimer un utilisateur de la base de données
        return false;
    }
}

?>