<?php
namespace models;

class Festival {
    private $nom;
    private $dateDebut;
    private $dateFin;
    private $localisation;
    private $cheminPhoto;

    // Constructeur
    public function __construct($nom, $dateDebut, $dateFin, $localisation, $cheminPhoto) {
        $this->nom = $nom;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->localisation = $localisation;
        $this->cheminPhoto = $cheminPhoto;
    }

    // GETTERS
    public function getNom() { return $this->nom; }
    public function getDateDebut() { return $this->dateDebut; }
    public function getDateFin() { return $this->dateFin; }
    public function getLocalisation() { return $this->localisation; }
    public function getCheminPhoto() { return $this->cheminPhoto; }

    // SETTERS
    public function setNom($nom) { $this->nom = $nom; }
    public function setDateDebut($dateDebut) { $this->dateDebut = $dateDebut; }
    public function setDateFin($dateFin) { $this->dateFin = $dateFin; }
    public function setLocalisation($localisation) { $this->localisation = $localisation; }
    public function setCheminPhoto($cheminPhoto) { $this->cheminPhoto = $cheminPhoto; }
}
?>