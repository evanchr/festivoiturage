<?php

namespace DAO;

require_once 'DAO/DAO.php';

class FestivalierDAO extends DAO
{

    public function __construct($c)
    {
        parent::__construct($c);
    }

    // vérifier l'existence d'une annonce festivalier par son id
    public function exists(object $festivalier){
        $id = $festivalier->getId();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM festivalier WHERE id = :id");
        $pdostat->bindValue(':id', $id);
        $pdostat->execute();
        if ($pdostat->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    // Créer une annonce festivalier
    public function create(object $festivalier){
        $id = $festivalier->getId();
        $nom = $festivalier->getNom();
        $prenom = $festivalier->getPrenom();
        $age = $festivalier->getAge();
        $genre = $festivalier->getGenre();
        $festival = $festivalier->getFestival();
        $ville = $festivalier->getVille();
        $dateAller = $festivalier->getDateAller();
        $dateRetour = $festivalier->getDateRetour();
        $description = $festivalier->getDescription();
        $createur = $festivalier->getCreateur();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("INSERT INTO festivalier (id, nom, prenom, age, genre, festival, ville, dateAller, dateRetour, description, createur) VALUES (:id, :nom, :prenom, :age, :genre, :festival, :ville, :dateAller, :dateRetour, :description, :createur)");
        $pdostat->bindValue(':id', $id);
        $pdostat->bindValue(':nom', $nom);
        $pdostat->bindValue(':prenom', $prenom);
        $pdostat->bindValue(':age', $age);
        $pdostat->bindValue(':genre', $genre);
        $pdostat->bindValue(':festival', $festival);
        $pdostat->bindValue(':ville', $ville);
        $pdostat->bindValue(':dateAller', $dateAller);
        $pdostat->bindValue(':dateRetour', $dateRetour);
        $pdostat->bindValue(':description', $description);
        $pdostat->bindValue(':createur', $createur);
        $pdostat->execute();
        if ($pdostat->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }


    // Mettre à jour une annonce festivalier
    public function update(object $festivalier, string $oldNom){
        $id = $festivalier->getId();
        $nom = $festivalier->getNom();
        $prenom = $festivalier->getPrenom();
        $age = $festivalier->getAge();
        $genre = $festivalier->getGenre();
        $festival = $festivalier->getFestival();
        $ville = $festivalier->getVille();
        $dateAller = $festivalier->getDateAller();
        $dateRetour = $festivalier->getDateRetour();
        $description = $festivalier->getDescription();
        $createur = $festivalier->getCreateur();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("UPDATE festivalier SET id = :id, nom = :nom, prenom = :prenom, age = :age, genre = :genre, festival = :festival, ville = :ville, dateAller = :dateAller, dateRetour = :dateRetour, description = :description, createur = :createur WHERE id = :id");
        $pdostat->bindValue(':id', $id);
        $pdostat->bindValue(':nom', $nom);
        $pdostat->bindValue(':prenom', $prenom);
        $pdostat->bindValue(':age', $age);
        $pdostat->bindValue(':genre', $genre);
        $pdostat->bindValue(':festival', $festival);
        $pdostat->bindValue(':ville', $ville);
        $pdostat->bindValue(':dateAller', $dateAller);
        $pdostat->bindValue(':dateRetour', $dateRetour);
        $pdostat->bindValue(':description', $description);
        $pdostat->bindValue(':createur', $createur);
        $pdostat->execute();
        if ($pdostat->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    // Supprimer une annonce festivalier
    public function delete(object $festivalier){
        $id = $festivalier->getId();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("DELETE FROM festivalier WHERE id = :id");
        $pdostat->bindValue(':id', $id);
        if ($pdostat->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getFestival(object $festival){
        $id = $festival->getId();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM festivalier WHERE id = :id");
        $pdostat->bindValue(':id', $id);
        $pdostat->execute();
        return $pdostat;
    }

    public static function listeAll(){
        $connexion = self::connectStatic();
        $pdostat = $connexion->prepare("SELECT * FROM festivalier ORDER BY id ASC");
        $pdostat->execute();
        return $pdostat->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function listeAllFromUser($pseudo){
        $connexion = self::connectStatic();
        $pdostat = $connexion->prepare("SELECT * FROM festivalier WHERE createur = :user ORDER BY id ASC");
        $pdostat->bindValue(':user', $pseudo);
        $pdostat->execute();
        return $pdostat->fetchAll(\PDO::FETCH_ASSOC);
    }
}
