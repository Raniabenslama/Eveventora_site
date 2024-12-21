<?php
session_start();

// Vérifier si une session est active et si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // Supprimer toutes les variables de session
    $_SESSION = [];

    // Détruire la session côté serveur
    session_destroy();
}

// Rediriger vers la page de connexion
header("Location: login.php");
exit();
?>
