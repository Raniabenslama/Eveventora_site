<?php
class Signup_admin {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
   
    

    public function __construct($id = "", $nom = "", $prenom = "", $email = "", $password = ""){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        
    }

    public function getId() {
        return $this->id;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }

  


  
 

    
}
?>

    
   