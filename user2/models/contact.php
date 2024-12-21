<?php
class Contact {
    private $contId;
    private $nom;
    private $email;
    private $subject;
    private $message;

    public function __construct($contId, $nom, $email, $subject, $message) {
        $this->contId = $contId;
        $this->nom = $nom;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function getContId() {
        return $this->contId;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
}
?>
