<?php
namespace models;

class Vehicle {
    private $id;
    private $type;
    private $places;
    private $dateAller;
    private $dateRetour;
    private $description;
    private $proprietaire;

    // Constructeur
    public function __construct($id, $type, $places, $dateAller, $dateRetour, $description, $proprietaire) {
        $this->id = $id;
        $this->type = $type;
        $this->places = $places;
        $this->dateAller = $dateAller;
        $this->dateRetour = $dateRetour;
        $this->description = $description;
        $this->proprietaire = $proprietaire;
    }

    // GETTER
    public function getId() { return $this->id; }
    public function getType() { return $this->type; }
    public function getPlaces() { return $this->places; }
    public function getDateAller() { return $this->dateAller; }
    public function getDateRetour() { return $this->dateRetour; }
    public function getDescription() { return $this->description; }
    public function getProprietaire() { return $this->proprietaire; }

    // SETTER
    public function setId($id) { $this->id = $id; }
    public function setType($type) { $this->type = $type; }
    public function setPlaces($places) { $this->places = $places; }
    public function setDateAller($dateAller) { $this->dateAller = $dateAller; }
    public function setDateRetour($dateRetour) { $this->dateRetour = $dateRetour; }
    public function setDescription($description) { $this->description = $description; }
    public function setProprietaire($proprietaire) { $this->proprietaire = $proprietaire; }
}
?>