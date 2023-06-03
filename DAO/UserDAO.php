<?php

namespace DAO;
require_once 'DAO/DAO.php';
use models\User;

class UserDAO extends DAO {

    public function __construct($c) {
        parent::__construct($c);
    }

    // vérifier l'existence de l'association pseudo/mot de passe dans la bd
    public function connexion(object $user) {
        $login = $user->getPseudo();
        $password = $user->getPassword();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM user WHERE pseudo = :login AND password = :password");
        $pdostat->bindValue(':login', $login);
        $pdostat->bindValue(':password', $password);
        $pdostat->execute();
        return $pdostat;
    }

    public function exists(object $user) {
        $login = $user->getPseudo();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM user WHERE pseudo = :login");
        $pdostat->bindValue(':login', $login);
        $pdostat->execute();
        if($pdostat->rowcount()==0){
            return false;
        } else {
            return true;
        }
    }

    // créer un profil utilisateur
    public function create(object $user) {
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $age = $user->getAge();
        $login = $user->getPseudo();
        $password = $user->getPassword();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("INSERT INTO `user` (`nom`, `prenom`, `age`, `pseudo`, `password`) VALUES (:nom, :prenom, :age, :login, :password); ");
        $pdostat->bindValue(':nom', $nom);
        $pdostat->bindValue(':prenom', $prenom);
        $pdostat->bindValue(':age', $age);
        $pdostat->bindValue(':login', $login);
        $pdostat->bindValue(':password', $password);
        $pdostat->execute();
        if($pdostat->rowCount()==0){
            return false;
        } else {
            return true;
        }
    }

    public function update(object $user) {
        // Logique pour mettre à jour un utilisateur dans la base de données
        return false;
    }

    public function delete(object $user) {
        $pseudo = $user->getPseudo();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("DELETE FROM `user` WHERE pseudo = :pseudo;");
        $pdostat->bindValue(':pseudo', $pseudo);
        if($pdostat->execute()){
            return true;
        } else {
            return false;
        }
    }
}

?>