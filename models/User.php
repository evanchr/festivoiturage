<?php

namespace models;

class User {
    private $nom;
    private $prenom;
    private $age;
    private $pseudo;
    private $password;
    private $admin;

    // Constructeur
    public function __construct($nom, $prenom, $age, $pseudo, $password, $admin) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->admin = $admin;
    }

    // GETTER
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getAge() { return $this->age; }
    public function getPseudo() { return $this->pseudo; }
    public function getPassword() { return $this->password; }
    public function getAdmin() { return $this->admin; }

    // SETTER
    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setAge($age) { $this->age = $age; }
    public function setPseudo($pseudo) { $this->pseudo = $pseudo; }
    public function setPassword($password) { $this->password = $password; }
    public function setAdmin($admin) { $this->admin = $admin; }
}

?>
