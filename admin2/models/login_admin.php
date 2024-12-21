<?php
class Login_admin {
    private $id;
    private $email;
    private $password;
    

    public function __construct($id = "", $email = "", $password = ""){
        $this->email = $email;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    
}
?>

    
   