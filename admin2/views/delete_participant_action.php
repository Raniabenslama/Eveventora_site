<?php
require_once '../controllers/ParticipantController.php';
require_once '../config/config.php';

// Initialiser la base de données
$db = new PDO('mysql:host=localhost;dbname=eventora', 'root', '');

// Initialiser le contrôleur
$participantController = new ParticipantController($db);

// Récupérer l'ID du participant et l'événement depuis GET
$participant_id = $_GET['participant_id'];
$event_id = $_GET['event_id'];

// Supprimer le participant
$participantController->deleteParticipant($participant_id, $event_id);
?>
