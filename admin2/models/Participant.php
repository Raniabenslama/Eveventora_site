<?php

class Participant {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Récupérer tous les participants pour un événement donné
    public function getParticipantsByEvent($event_id) {
        $query = "SELECT * FROM participant WHERE event_id = :event_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un participant à un événement
    public function addParticipant($data) {
        $query = "INSERT INTO participant (event_id, nom, email, telephone) 
                  VALUES (:event_id, :nom, :email, :telephone)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':event_id', $data['event_id'], PDO::PARAM_INT);
        $stmt->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $data['telephone'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Supprimer un participant (si nécessaire)
    public function deleteParticipant($participant_id) {
        $query = "DELETE FROM participant WHERE participant_id = :participant_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':participant_id', $participant_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Mettre à jour les informations d'un participant (optionnel)
    public function updateParticipant($data) {
        $query = "UPDATE participant 
                  SET nom = :nom, email = :email, telephone = :telephone 
                  WHERE participant_id = :participant_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $data['telephone'], PDO::PARAM_STR);
        $stmt->bindParam(':participant_id', $data['participant_id'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Récupérer les détails d'un participant spécifique (optionnel)
    public function getParticipantById($participant_id) {
        $query = "SELECT * FROM participant WHERE participant_id = :participant_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':participant_id', $participant_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
