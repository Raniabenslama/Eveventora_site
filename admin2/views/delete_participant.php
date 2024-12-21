<?php
require_once '../controllers/ParticipantController.php';
require_once '../config/config.php'; // Inclure votre configuration de connexion DB

// Initialiser la base de données
$db = new PDO('mysql:host=localhost;dbname=eventora', 'root', '');

// Initialiser le contrôleur
$participantController = new ParticipantController($db);

// Vérifier si les données POST existent
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $participant_id = $_POST['participant_id'];
    $event_id = $_POST['event_id'];

    // Supprimer le participant
    $participantController->deleteParticipant($participant_id, $event_id);
}
?>
