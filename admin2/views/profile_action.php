<?php
session_start();
require_once('../controllers/AdminController.php');
require_once('../models/AdminModel.php');

// Vérifiez que l'administrateur est connecté
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Initialiser l'objet PDO
$pdo = new PDO('mysql:host=localhost;dbname=eventora', 'root', '');

// Créer les instances nécessaires
$adminCtr = new AdminController($pdo);
$admin = new Admin($pdo);

// Récupérer l'ID de l'administrateur à partir de la session
$adminId = $_SESSION['admin_id'];

// Récupérer les données de l'administrateur à partir de l'ID de session
$adminData = $admin->getAdminById($adminId);

// Récupérer les données du formulaire
$username = $_POST['username'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

// Gérer l'upload de la photo si elle est présente
$photoPath = null;
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $photoPath = $admin->uploadPhoto($_FILES['profile_picture']);
}

// Mettre à jour les informations de l'administrateur via le contrôleur
$adminCtr->updateProfileAction($adminId, $username, $email, $password, $photoPath);

// Rediriger vers la page du profil après mise à jour
header('Location: profile.php');
exit;
?>
