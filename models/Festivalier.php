<?php

namespace models;

class Festivalier {
    private $id;
    private $nom;
    private $prenom;
    private $age;
    private $genre;
    private $festival;
    private $ville;
    private $dateAller;
    private $dateRetour;
    private $description;
    private $createur;

    // Constructeur
    public function __construct($id, $nom, $prenom, $age, $genre, $festival, $ville, $dateAller, $dateRetour, $description, $createur) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->genre = $genre;
        $this->festival = $festival;
        $this->ville = $ville;
        $this->dateAller = $dateAller;
        $this->dateRetour = $dateRetour;
        $this->description = $description;
        $this->createur = $createur;
    }

    // GETTER
    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getAge() { return $this->age; }
    public function getGenre() { return $this->genre; }
    public function getFestival() { return $this->festival; }
    public function getVille() { return $this->ville; }
    public function getDateAller() { return $this->dateAller; }
    public function getDateRetour() { return $this->dateRetour; }
    public function getDescription() { return $this->description; }
    public function getCreateur() { return $this->createur; }

    // SETTER
    public function setId($id) { $this->id = $id; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setAge($age) { $this->age = $age; }
    public function setGenre($genre) { $this->genre = $genre; }
    public function setFestival($festival) { $this->festival = $festival; }
    public function setVille($ville) { $this->ville = $ville; }
    public function setDateAller($dateAller) { $this->dateAller = $dateAller; }
    public function setDateRetour($dateRetour) { $this->dateRetour = $dateRetour; }
    public function setDescription($description) { $this->description = $description; }
    public function setCreateur($createur) { $this->createur = $createur; }
}
?>