<?php
include_once('../controllers/signup_adminController.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $signupController = new Signup_adminController();
    $result = $signupController->addAdmin($nom, $prenom, $email, $password, $confirm_password);

    if ($result instanceof Signup_admin) {
        
        header("Location: login_admin.php?message=Signup successful!");
        exit;
    } else {
        $errorMessage = $result;
        echo $errorMessage;  
    }
}
?>
