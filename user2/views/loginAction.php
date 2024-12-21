
<?php
session_start();
include_once('../database/connexion.php');
include_once('../controller/userController.php');

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: login.php');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Please enter a valid email address.';
        header('Location: login.php');
        exit;
    }

    // Check credentials
    $userController = new UserController();
    $user = $userController->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        // Successful authentication
        $_SESSION['user'] = [
            'id' => $user['user_id'],
            'email' => htmlspecialchars($user['email']),
            'nom' => htmlspecialchars($user['nom']),
            'prenom' => htmlspecialchars($user['prenom'])
        ];
        header('Location: dashboard.php'); // Redirect to dashboard
        exit;
    } else {
        // Invalid credentials
        $_SESSION['error'] = 'Invalid email or password.';
        header('Location: login.php');
        exit;
    }
}
?>
