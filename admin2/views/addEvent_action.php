<?php
require_once('../controllers/eventController.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre=$_POST['titre'];
    $date=$_POST['date'];
    $heure=$_POST['heure'];
    $lieu=$_POST['lieu'];
    $description=$_POST['description'];
    $prix_ticket=$_POST['prix_ticket'];
   


    $eventCtr=new EventController();

    $res=$eventCtr->insert($titre, $date, $heure, $lieu, $description, $prix_ticket);

    if($res==true){
        header('Location:eventCreator.php');
    }
}

?>