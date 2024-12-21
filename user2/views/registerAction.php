<?php
session_start();
include_once('../controller/userController.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : "";
    $password = isset($_POST['password']) ? trim($_POST['password']) : "";
    $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : "";

    // Vérifications
    if (empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($password) || empty($confirmPassword)) {
        $errorMessage = "Tous les champs sont obligatoires.";
        header("Location: login.php?error=" . urlencode($errorMessage));
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Adresse e-mail invalide.";
        header("Location: login.php?error=" . urlencode($errorMessage));
        exit();
    }

    if ($password !== $confirmPassword) {
        $errorMessage = "Les mots de passe ne correspondent pas.";
        header("Location: login.php?error=" . urlencode($errorMessage));
        exit();
    }

    // Enregistrement de l'utilisateur
    $userController = new UserController();
    $inserted = $userController->registerUser($nom, $prenom, $email, $telephone, $password);

    if ($inserted) {
        header("Location: login.php?success=true");
        exit();
    } else {
        $errorMessage = "Erreur lors de l'inscription. Veuillez réessayer.";
        header("Location: login.php?error=" . urlencode($errorMessage));
        exit();
    }
}
?>
