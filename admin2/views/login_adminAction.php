<?php
include_once('../controllers/login_adminController.php'); // Inclure le contrôleur

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    
    $loginController = new Login_adminController();

    
    $result = $loginController->loginAdmin($email, $password);

    if ($result instanceof Login_admin) {
        
        header("Location: eventCreator.php"); 
        exit; 
    } else {
        
        echo $result;
    }
}
?>
