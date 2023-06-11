<?php

namespace DAO;
require_once 'DAO/DAO.php';

class FestivalDAO extends DAO {

    public function __construct($c) {
        parent::__construct($c);
    }

    // vérifier l'existence d'un festival par son nom
    public function exists(object $festival) {
        $nom = $festival->getNom();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM festival WHERE nom = :nom");
        $pdostat->bindValue(':nom', $nom);
        $pdostat->execute();
        if($pdostat->rowCount()==0){
            return false;
        } else {
            return true;
        }
    }

    // créer un festival
    public function create(object $festival) {
        $nom = $festival->getNom();
        $dateDebut = $festival->getDateDebut();
        $dateFin = $festival->getDateFin();
        $localisation = $festival->getLocalisation();
        $cheminPhoto = $festival-> getCheminPhoto();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("INSERT INTO festival (nom, dateDebut, dateFin, localisation, cheminPhoto) VALUES (:nom, :dateDebut, :dateFin, :localisation, :photo)");
        $pdostat->bindValue(':nom', $nom);
        $pdostat->bindValue(':dateDebut', $dateDebut);
        $pdostat->bindValue(':dateFin', $dateFin);
        $pdostat->bindValue(':localisation', $localisation);
        $pdostat->bindValue(':photo', $cheminPhoto);
        $pdostat->execute();
        if($pdostat->rowCount()==0){
            return false;
        } else {
            return true;
        }
    }

    // mettre à jour un festival
    public function update(object $festival, String $oldNom) {
        $nom = $festival->getNom();
        $dateDebut = $festival->getDateDebut();
        $dateFin = $festival->getDateFin();
        $localisation = $festival->getLocalisation();
        $cheminPhoto = $festival-> getCheminPhoto();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("UPDATE festival SET nom = :nom, dateDebut = :dateDebut, dateFin = :dateFin, localisation = :localisation, cheminPhoto = :photo WHERE nom = :oldNom");
        $pdostat->bindValue(':nom', $nom);
        $pdostat->bindValue(':dateDebut', $dateDebut);
        $pdostat->bindValue(':dateFin', $dateFin);
        $pdostat->bindValue(':localisation', $localisation);
        $pdostat->bindValue(':oldNom', $oldNom);
        $pdostat->bindValue(':photo', $cheminPhoto);
        $pdostat->execute();
        if($pdostat->rowCount()==0){
            return false;
        } else {
            return true;
        }
    }

    // supprimer un festival
    public function delete(object $festival) {
        $nom = $festival->getNom();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("DELETE FROM festival WHERE nom = :nom");
        $pdostat->bindValue(':nom', $nom);
        if($pdostat->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getFestival(object $festival) {
        $nom = $festival->getNom();
        $connexion = $this->connect;
        $pdostat = $connexion->prepare("SELECT * FROM festival WHERE nom = :nom");
        $pdostat->bindValue(':nom', $nom);
        $pdostat->execute();
        return $pdostat;
    }

    public static function listeAll() {
        $connexion = self::connectStatic();
        $pdostat = $connexion->prepare("SELECT * FROM festival ORDER BY nom ASC");
        $pdostat->execute();
        return $pdostat->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>