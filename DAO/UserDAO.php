<?php

namespace DAO;
require_once 'DAO/DAO.php';

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

    // vérifier si un user existe
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

    // vérifier si un user est admin
    public function admin(object $user) {
        $login = $user->getPseudo();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM user WHERE pseudo = :login AND admin = :vrai");
        $pdostat->bindValue(':login', $login);
        $pdostat->bindValue(':vrai', 1);
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
        $admin = $user->getAdmin();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("INSERT INTO user (nom, prenom, age, pseudo, password, admin) VALUES (:nom, :prenom, :age, :login, :password, :admin); ");
        $pdostat->bindValue(':nom', $nom);
        $pdostat->bindValue(':prenom', $prenom);
        $pdostat->bindValue(':age', $age);
        $pdostat->bindValue(':login', $login);
        $pdostat->bindValue(':password', $password);
        $pdostat->bindValue(':admin', $admin);
        $pdostat->execute();
        if($pdostat->rowCount()==0){
            return false;
        } else {
            return true;
        }
    }

    // mettre à jour un profil user
    public function update(object $user, String $oldlogin) {
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $age = $user->getAge();
        $newlogin = $user->getPseudo();
        $password = $user->getPassword();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("UPDATE user SET nom = :nom, prenom = :prenom, age = :age, pseudo = :newlogin, password = :password WHERE pseudo = :oldlogin;");
        $pdostat->bindValue(':nom', $nom);
        $pdostat->bindValue(':prenom', $prenom);
        $pdostat->bindValue(':age', $age);
        $pdostat->bindValue(':newlogin', $newlogin);
        $pdostat->bindValue(':password', $password);
        $pdostat->bindValue(':oldlogin', $oldlogin);
        $pdostat->execute();
        if($pdostat->rowCount()==0){
            return false;
        } else {
            return true;
        }
    }

    // supprimer un user
    public function delete(object $user) {
        $pseudo = $user->getPseudo();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("DELETE FROM user WHERE pseudo = :pseudo;");
        $pdostat->bindValue(':pseudo', $pseudo);
        if($pdostat->execute()){
            return true;
        } else {
            return false;
        }
    }

    // récupérer les infos d'un user selon son pseudo
    public function getUser(object $user) {
        $pseudo = $user->getPseudo();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM user WHERE pseudo = :pseudo;");
        $pdostat->bindValue(':pseudo', $pseudo);
        return $pdostat;
    }

    // lister tous les users
    public static function listeAllUser() {
        $connexion = self::connectStatic();
        $pdostat = $connexion->prepare("SELECT * FROM user WHERE admin = 0");
        $pdostat->execute();
        return $pdostat->fetchAll(\PDO::FETCH_ASSOC);
    }

    // lister tous les admins
    public static function listeAllAdmin() {
        $connexion = self::connectStatic();
        $pdostat = $connexion->prepare("SELECT * FROM user WHERE admin = 1");
        $pdostat->execute();
        return $pdostat->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>