<?php

class User {
    private $userId;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $password;

    public function __construct($userId, $nom, $prenom, $email, $telephone, $password) {
        $this->userId = $userId;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->password = $password;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    
}

?>
