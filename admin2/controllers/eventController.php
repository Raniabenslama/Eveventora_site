<?php
include_once('../models/event.php');
include_once('../config/config.php');

class EventController extends Connexion{
    function __construct(){
        parent::__construct();
    }

    function getEvent($event_id){
        $query="select * from event where event_id=? ";
        $res = $this->pdo->prepare($query);
        $res->execute(array($event_id));
        $array= $res->fetch();
        return $array;
    }

    function insert($titre, $date, $heure, $lieu, $description, $prix_ticket)
    {
        $query="insert into event(titre, date, heure, lieu, description, prix_ticket) values(?, ?, ?, ?, ?, ?)";
        $res=$this->pdo->prepare($query);
        return $res->execute(array($titre, $date, $heure, $lieu, $description, $prix_ticket));
    }

    function delete($event_id)
    {
        $query="delete from event where event_id=?";
        $res=$this->pdo->prepare($query);
        return $res->execute(array($event_id));
    }

    function liste($searchTerm = '') {
        if (!empty($searchTerm)) {
            $query = "SELECT * FROM event WHERE titre LIKE ?";
            $res = $this->pdo->prepare($query);
            $res->execute(array('%' . $searchTerm . '%'));
        } else {
            $query = "SELECT * FROM event";
            $res = $this->pdo->prepare($query);
            $res->execute();
        }
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    function edit($event_id, $titre, $date, $heure, $lieu, $description, $prix_ticket) {
        $query = "update event set titre=?, date=?, heure=?, lieu=?, description=?, prix_ticket=? WHERE event_id=?";
        $res = $this->pdo->prepare($query);
        return $res->execute(array($titre, $date, $heure, $lieu, $description, $prix_ticket, $event_id)); // Add $event_id here
    }

    
    
    
    
}



?>