<?php

require_once '../models/Participant.php'; // Assurez-vous que le chemin est correct

class ParticipantController {
    private $participantModel;

    public function __construct($db) {
        $this->participantModel = new Participant($db);
    }

    // Lister les participants pour un événement donné
    public function listParticipants($event_id) {
        try {
            $participants = $this->participantModel->getParticipantsByEvent($event_id);
            include '../views/list.php'; // Chemin vers la vue
        } catch (Exception $e) {
            echo "Erreur lors de la récupération des participants : " . $e->getMessage();
        }
    }

    // Ajouter un nouveau participant
    public function createParticipant($data) {
        try {
            $result = $this->participantModel->addParticipant($data);
            if ($result) {
                header("Location: participants.php?event_id=" . $data['event_id']); // Redirection après ajout
            } else {
                echo "Erreur lors de l'ajout du participant.";
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Supprimer un participant
    public function deleteParticipant($participant_id, $event_id) {
        try {
            $result = $this->participantModel->deleteParticipant($participant_id);
            if ($result) {
                header("Location: participants.php?event_id=" . $event_id); // Redirection après suppression
            } else {
                echo "Erreur lors de la suppression du participant.";
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
