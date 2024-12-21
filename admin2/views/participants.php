<?php
require_once '../controllers/ParticipantController.php';
require_once '../config/config.php'; // Fichier de configuration pour la connexion DB

// Initialiser la base de données
$db = new PDO('mysql:host=localhost;dbname=eventora', 'root', '');

// Initialiser le contrôleur
$participantController = new ParticipantController($db);

// Récupérer l'ID de l'événement depuis la requête GET
$event_id = $_GET['event_id'] ?? 0;

// Afficher les participants
$participantController->listParticipants($event_id);
?>
