<?php
include_once('../../database/connexion.php');
include_once('../../models/contact.php');

class ContactController extends Connexion {

    public function __construct() {
        parent::__construct(); 
    }

    public function insertContact(Contact $contact) {
        $pdo = $this->getPDO(); 
        $query = "INSERT INTO contact (Nom, Email, Subject, Message) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        return $stmt->execute([$contact->getNom(), $contact->getEmail(), $contact->getSubject(), $contact->getMessage()]);
    }

    public function getEmail() {
        $pdo = $this->getPDO(); 
        $query = "SELECT Email FROM contact";
        $stmt = $pdo->query($query);
        $emails = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $emails[] = $row['Email'];
        }
        return $emails;
    }

    public function sendMail($to, $subject, $body) {
        $mailFromName = "Admin";
        $mailFrom = "jouhainadhahri74@gmail.com";
        
       
        $mailHeader = 'MIME-Version: 1.0' . "\r\n";
        $mailHeader .= "From: $mailFromName <$mailFrom>\r\n";
        $mailHeader .= "Reply-To: $mailFrom\r\n";
        $mailHeader .= "Return-Path: $mailFrom\r\n";
        $mailHeader .= 'X-Mailer: PHP' . phpversion() . "\r\n";
        $mailHeader .= 'Content-Type: text/html; charset=utf-8' . "\r\n";

        if (mail($to, $subject, $body, $mailHeader)) {
            return true;
        } else {
            return false;
        }
    }
}
?>
