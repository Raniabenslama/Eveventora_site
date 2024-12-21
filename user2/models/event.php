<?php

class Event{
    private $titre, $date, $heure, $lieu, $description, $prix_ticket, $image_path;
    function __construct($titre="", $date="", $heure="",  $lieu="", $description="", $prix_ticket="", $image_path = "")
    {
        $this->titre=$titre;
        $this->date=$date;
        $this->heure=$heure;
        $this->lieu=$lieu;
        $this->description=$description;
        $this->prix_ticket=$prix_ticket;
     

    }

    public function getImagePath() {
        return $this->image_path;
    }

    public function setImagePath($image_path) {
        $this->image_path = $image_path;
    }
    //getters
    public function getTitre()
    {
        return $this->titre;
    }

    

    public function getDate()
    {
        return $this->date;
    }

    public function getHeure()
    {
        return $this->heure;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function getPrix_ticket()
    {
        return $this->prix_ticket;
    }
    //setters
    public function setTitre($titre)
    {
        $this->titre=$titre;
    }

   

    public function setDate($date)
    {
        $this->date=$date;
    }

    public function setHeure($heure)
    {
        $this->heure=$heure;
    }

    public function setLieu($lieu)
    {
        $this->lieu=$lieu;
    }

    public function setDescription($description)
    {
        $this->description=$description;
    }

    public function setPrix_ticket($prix_ticket)
    {
        $this->prix_ticket=$prix_ticket;
    }



}


?>