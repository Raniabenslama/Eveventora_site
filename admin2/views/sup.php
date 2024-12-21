<?php
require_once('../controllers/eventController.php');
$eventCtr=new EventController();
$eventCtr->delete($_GET['id']);
header('Location:eventCreator.php');

?>