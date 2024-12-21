<?php

include_once('../models/signup_admin.php');
include_once('../config/config.php');

class Signup_adminController extends Connexion {

    public function __construct() {
        parent::__construct();
    }

    // Fonction pour ajouter un nouvel administrateur
    public function addAdmin($nom, $prenom, $email, $password, $confirm_password) {
        // Validation des données
        if ($this->validateSignupData($nom, $prenom, $email, $password, $confirm_password)) {

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hachage du mot de passe

            // Vérification si l'email existe déjà
            $stmt = $this->pdo->prepare("SELECT * FROM signup_admin WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<script>
                alert('Email already exists!');
                window.location.href = 'signup_admin.php'; 
            </script>";
            return;
            
                 // L'email existe déjà dans la base de données
            }

            // Insertion de l'administrateur dans la base de données
            $stmt = $this->pdo->prepare("INSERT INTO signup_admin (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                // Retourner l'objet Signup_admin si l'ajout a réussi
                return new Signup_admin("", $nom, $prenom, $email, $hashedPassword);
            } else {
                return "Error in saving data to database!"; // Erreur d'insertion dans la base de données
            }
        } else {
            return "Validation failed. Check input data."; // Échec de la validation des données
        }
    }

    // Fonction pour valider les données d'inscription
    private function validateSignupData($nom, $prenom, $email, $password, $confirm_password) {
        if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($confirm_password)) {
            return false; // Vérification des champs vides
        }

        if ($password !== $confirm_password) {
            return false; // Vérification de la correspondance des mots de passe
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false; // Vérification de la validité de l'email
        }

        return true;
    }
}

?>
