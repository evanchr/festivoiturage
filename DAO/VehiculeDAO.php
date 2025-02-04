<?php

namespace DAO;
require_once 'DAO/DAO.php';

class VehiculeDAO extends DAO {

    public function __construct($c) {
        parent::__construct($c);
    }

    // vérifier l'existence d'une annonce véhicule par son id
    public function exists(object $vehicule) {
        $id = $vehicule->getId();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM vehicule WHERE id = :id");
        $pdostat->bindValue(':id', $id);
        $pdostat->execute();
        if($pdostat->rowCount()==0){
            return false;
        } else {
            return true;
        }
    }

    // créer une annonce véhicule
    public function create(object $vehicule) {
        $type = $vehicule->getType();
        $places = $vehicule->getPlaces();
        $ville = $vehicule->getVille();
        $festival = $vehicule->getFestival();
        $dateAller = $vehicule->getDateAller();
        $dateRetour = $vehicule-> getDateRetour();
        $description = $vehicule-> getDescription();
        $proprietaire = $vehicule-> getProprietaire();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("INSERT INTO vehicule (type, places, ville, festival, dateAller, dateRetour, description, proprietaire) VALUES (:type, :places, :ville, :festival, :dateAller, :dateRetour, :description, :proprietaire)");
        $pdostat->bindValue(':type', $type);
        $pdostat->bindValue(':places', $places);
        $pdostat->bindValue(':ville', $ville);
        $pdostat->bindValue(':festival', $festival);
        $pdostat->bindValue(':dateAller', $dateAller);
        $pdostat->bindValue(':dateRetour', $dateRetour);
        $pdostat->bindValue(':description', $description);
        $pdostat->bindValue(':proprietaire', $proprietaire);
        $pdostat->execute();
        if($pdostat->rowCount()==0){
            return false;
        } else {
            return true;
        }
    }

    // mettre à jour une annonce véhicule
    public function update(object $vehicule, String $oldid) {
        $id = $vehicule->getId();
        $type = $vehicule->getType();
        $places = $vehicule->getPlaces();
        $ville = $vehicule->getVille();
        $festival = $vehicule->getFestival();
        $dateAller = $vehicule->getDateAller();
        $dateRetour = $vehicule-> getDateRetour();
        $description = $vehicule-> getDescription();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("UPDATE vehicule SET type = :type, places = :places, ville = :ville, festival = :festival, dateAller = :dateAller, dateRetour = :dateRetour, description =:description WHERE vehicule.id = :oldid");
        $pdostat->bindValue(':oldid', $oldid);
        $pdostat->bindValue(':type', $type);
        $pdostat->bindValue(':places', $places);
        $pdostat->bindValue(':ville', $ville);
        $pdostat->bindValue(':festival', $festival);
        $pdostat->bindValue(':dateAller', $dateAller);
        $pdostat->bindValue(':dateRetour', $dateRetour);
        $pdostat->bindValue(':description', $description);
        $pdostat->execute();
        if($pdostat->rowCount()==0){
            return false;
        } else {
            return true;
        }
    }

    // supprimer une annonce vehicule
    public function delete(object $vehicule) {
        $id = $vehicule->getId();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("DELETE FROM vehicule WHERE id = :id");
        $pdostat->bindValue(':id', $id);
        if($pdostat->execute()){
            return true;
        } else {
            return false;
        }
    }

    // récupérer les infos d'une annonce véhicule en fonction de l'id
    public function getVehicule(object $vehicule) {
        $id = $vehicule->getId();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM vehicule WHERE id = :id");
        $pdostat->bindValue(':id', $id);
        $pdostat->execute();
        return $pdostat;
    }

    // récupérer toutes les annonces véhicule
    public static function listeAll() {
        $connexion = self::connectStatic();
        $pdostat = $connexion->prepare("SELECT * FROM vehicule ORDER BY id ASC");
        $pdostat->execute();
        return $pdostat->fetchAll(\PDO::FETCH_ASSOC);
    }

    // récupérer toutes les annonces véhicule d'un certain utilisateur
    public static function listeAllFromUser($pseudo) {
        $connexion = self::connectStatic();
        $pdostat = $connexion->prepare("SELECT * FROM vehicule WHERE proprietaire = :user ORDER BY id ASC");
        $pdostat->bindValue(':user', $pseudo);
        $pdostat->execute();
        return $pdostat->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>