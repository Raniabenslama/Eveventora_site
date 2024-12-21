<?php
class Connexion {
    protected $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=eventora', 'root', '');
    }

    public function __destruct() {
        $this->pdo = null;
    }

    public function getPDO() {
        return $this->pdo;
    }
}
?>
