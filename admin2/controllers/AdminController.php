<?php
require_once '../config/config.php';
require_once '../models/AdminModel.php';

class AdminController {

    private $adminModel;

    // Initialiser le contrôleur avec une instance de PDO
    public function __construct(PDO $pdo) {
        $this->adminModel = new Admin($pdo);
    }

    public function showProfile($adminId) {
        try {
            // Vérifiez si l'ID de l'administrateur est stocké dans la session
            session_start();
            if (!isset($_SESSION['admin_id'])) {
                throw new Exception("Veuillez vous connecter.");
            }
    
            // Utilisez l'ID de la session pour récupérer les informations de l'administrateur
            $admin = $this->adminModel->getAdminById($_SESSION['admin_id']);
            if (!$admin) {
                throw new Exception("Administrateur introuvable.");
            }
    
            // Inclure la vue pour afficher le profil
            include '../views/profile.php';
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    

    // Mettre à jour le profil de l'administrateur
    public function updateProfileAction($adminId, $username, $email, $password, $photoPath) {
        // Si un mot de passe est fourni, le hacher
        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $passwordHash = null; // Si aucun mot de passe n'est donné, garder l'ancien
        }

        // Mise à jour des informations dans la base de données
        $this->adminModel->updateAdmin($adminId, $username, $email, $passwordHash, $photoPath);
    }

    // Gérer le formulaire de mise à jour (via POST)
    public function handleProfileUpdate($adminId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $username = $_POST['username'] ?? null;
                $email = $_POST['email'] ?? null;
                $password = $_POST['password'] ?? null;
                $photoPath = null;

                // Gérer le téléchargement de la photo si elle est présente
                if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                    $photoPath = $this->adminModel->uploadPhoto($_FILES['photo']);
                }

                // Mettre à jour le profil
                $this->updateProfileAction($adminId, $username, $email, $password, $photoPath);

                // Rediriger après la mise à jour
                header('Location: profile.php?id=' . $adminId);
                exit;
            } catch (Exception $e) {
                echo "Erreur lors de la mise à jour : " . $e->getMessage();
            }
        }
    }
}
?>
