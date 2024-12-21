<?php

include_once('../models/login_admin.php');
include_once('../config/config.php');
include_once('../models/signup_admin.php');

class Login_adminController extends Connexion {

    public function __construct() {
        parent::__construct();
    }

    // Fonction pour connecter un administrateur
    public function loginAdmin($email, $password) {
        // Vérifier si l'email existe
        $stmt = $this->pdo->prepare("SELECT * FROM signup_admin WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $admin = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère les données de l'administrateur

            // Vérifier si le mot de passe est correct
            if (password_verify($password, $admin['password'])) {
                // Créer un objet Login_admin et retourner
               // header();
            } else {
                return "Incorrect password!";
            }
        } else {
            return "No account found with this email!";
        }
    }
}
?>
