<?php
require_once '../controllers/ParticipantController.php';
require_once '../config/config.php';

// Initialiser la base de données
$db = new PDO('mysql:host=localhost;dbname=eventora', 'root', '');

// Initialiser le contrôleur
$participantController = new ParticipantController($db);

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'event_id' => $_POST['event_id'],
        'nom' => $_POST['nom'],
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone'],
    ];
    $participantController->createParticipant($data);
}
?>
