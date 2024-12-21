<?php
include_once('../database/connexion.php');
include_once('../models/user.php');

class EventController extends Connexion {
    function __construct() {
        parent::__construct();
    }

    function getEvent($event_id) {
        $query = "SELECT * FROM event WHERE event_id=?";
        $res = $this->pdo->prepare($query);
        $res->execute(array($event_id));
        $array = $res->fetch();
        return $array;
    }
    function getRecentEvents() {
        $query = "SELECT * FROM event ORDER BY date DESC LIMIT 4"; // Remplacez 'date' par le nom exact de la colonne
        $res = $this->pdo->prepare($query);
        $res->execute();
        $array = $res->fetchAll();
        return $array;
    }
    
    

    public function insert($titre, $date, $heure, $lieu, $description, $prix_ticket, $image_path) {
        $query = "INSERT INTO event (titre, date, heure, lieu, description, prix_ticket, image_path) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $res = $this->pdo->prepare($query);
        return $res->execute(array($titre, $date, $heure, $lieu, $description, $prix_ticket, $image_path));
    }
    

    function delete($event_id) {
        $query = "DELETE FROM event WHERE event_id=?";
        $res = $this->pdo->prepare($query);
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

    function edit($event_id, $titre, $date, $heure, $lieu, $description, $prix_ticket, $image_path) {
        $query = "UPDATE event 
                  SET titre=?, date=?, heure=?, lieu=?, description=?, prix_ticket=?, image_path=? 
                  WHERE event_id=?";
        $res = $this->pdo->prepare($query);
        return $res->execute(array($titre, $date, $heure, $lieu, $description, $prix_ticket, $image_path, $event_id));
    }

    function handleImageUpload($file) {
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $imagePath = $uploadDir . basename($file['name']);

            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Move uploaded file
            if (move_uploaded_file($file['tmp_name'], $imagePath)) {
                return $imagePath;
            } else {
                throw new Exception("Failed to upload the file.");
            }
        }
        return null; // No file uploaded
    }
    public function searchEvents($searchTerm = '',  $eventDate = '', $location = '') {
        $query = "SELECT * FROM event WHERE 
                    titre LIKE ? OR 
                    date LIKE ? OR 
                    lieu LIKE ?";
        $params = [
            '%' . $searchTerm . '%',
            '%' . $searchTerm . '%',
            '%' . $searchTerm . '%'
        ];
    
        // Préparer et exécuter la requête
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
    
        // Retourner les résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}


?>