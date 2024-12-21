<?php
include_once '../config/config.php';

class Admin {
    private $pdo;

    // Le constructeur prend une instance de PDO comme paramètre
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Récupérer les données de l'administrateur par ID
    public function getAdminById($adminId) {
        $stmt = $this->pdo->prepare("SELECT * FROM admin WHERE id = :id");
        $stmt->execute(['id' => $adminId]);
        return $stmt->fetch();
    }

    // Récupérer un administrateur par son nom d'utilisateur
    public function getAdminByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM admin WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }


    // Gérer le téléchargement de la photo de profil
    public function uploadPhoto($file) {
        // Dossier cible pour enregistrer la photo
        $uploadDir = '../uploads/profile_pictures/';
        $uploadFile = $uploadDir . basename($file['name']);

        // Déplacer l'image téléchargée dans le répertoire
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            return $uploadFile;
        } else {
            return null; // En cas d'erreur
        }
    }

    // Méthode pour mettre à jour les informations de l'administrateur
    public function updateAdmin($id, $username, $email, $password, $profile_picture) {
        $query = "UPDATE admin SET username = :username, email = :email, password = :password, profile_picture = :profile_picture WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':profile_picture', $profile_picture);
        $stmt->bindParam(':id', $id);

        // Exécuter la requête
        return $stmt->execute();
    }
}

?>
