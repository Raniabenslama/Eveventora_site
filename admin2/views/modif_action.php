<?php
require_once('../controllers/eventController.php');
require_once('../models/event.php');

$eventCtr = new EventController();
$event = new Event();


$event->setTitre($_POST['titre']);
$event->setDate($_POST['date']);
$event->setHeure($_POST['heure']);
$event->setLieu($_POST['lieu']);
$event->setDescription($_POST['description']);
$event->setPrix_ticket($_POST['prix_ticket']);

$id = $_POST['event_id']; 

$eventCtr->edit($id, $event->getTitre(), $event->getDate(), $event->getHeure(), $event->getLieu(), $event->getDescription(), $event->getPrix_ticket());

header('Location:eventCreator.php');
?>