<?php
session_start();
$_SESSION['admin_id'] = 1;
require_once '../config/config.php';
require_once '../models/AdminModel.php';

// Vérifiez que l'administrateur est connecté
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$pdo = new PDO('mysql:host=localhost;dbname=eventora', 'root', '');
$admin = new Admin($pdo);

// Récupérer les données de l'administrateur à partir de l'ID de session
$adminId = $_SESSION['admin_id'];
$adminData = $admin->getAdminById($adminId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: #f9f9f9;
        }

        /* Top Header */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #EEE9F0;
            border-bottom: 1px solid #ddd;
        }

        .top-header .logo {
            font-size: 24px;
            font-weight: bold;
            color: #3F3A35;
        }

        .top-header .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-header .profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .top-header .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .top-header .profile-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            z-index: 1;
            min-width: 120px;
        }

        .top-header .profile-dropdown:hover .profile-dropdown-content {
            display: block;
        }

        .top-header .profile-dropdown-content a {
            color: black;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .top-header .profile-dropdown-content a:hover {
            background-color: #EEE9F0;
        }

        /* Sidebar */
        .sidebar {
            background-color: #EEE9F0;
            width: 220px;
            padding: 20px 10px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            border-right: 1px solid #ddd;
            position: fixed;
            top: 50px;
            bottom: 0;
            overflow-y: auto;
        }

        .sidebar a {
            text-decoration: none;
            color: #000;
            padding: 12px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            background-color:#D7BBE2;
        }

        .sidebar a:hover {
            background-color: rgb(191, 150, 207);
        }

        .sidebar a.active {
            background-color:#8E44AD;
            color: white;
        }

        .sidebar a span {
            margin-left: 10px;
        }

        /* Main Content */
        .main {
            margin-left: 240px;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .header form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header form input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .header form button {
            padding: 8px 15px;
            background-color:#D7BBE2;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .header form button:hover {
            background-color: rgb(191, 150, 207);
        }

        .add-event-btn {
            background-color: #D7BBE2;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        .add-event-btn:hover {
            background-color: rgb(191, 150, 207);
        }

        .events-placeholder {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            min-height: 300px;
        }

        .event-item {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .event-item:last-child {
            border-bottom: none;
        }

        .event-item h3 {
            margin: 0;
            font-size: 18px;
        }

        .event-item p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .event-item span {
            font-weight: bold;
            color: #333;
        }
        /* Edit Button */
.edit-btn {
    padding: 8px 15px;
    background-color: #4CAF50; /* Green */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    margin-right: 10px;
}

.edit-btn:hover {
    background-color: #45a049; /* Darker Green */
}

/* Delete Button */
.delete-btn {
    padding: 8px 15px;
    background-color: #f44336; /* Red */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.delete-btn:hover {
    background-color: #d32f2f; /* Darker Red */
}
.participants-btn {
    padding: 8px 15px;
    background-color: #007bff; /* Blue */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.participants-btn:hover {
    background-color: #0056b3; /* Darker Blue */
}

        /* Style général pour le profil */
       

        /* Main Content */
        .main {
            margin-left: 240px; 
            padding: 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .form-container h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="file"], textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
     <!-- Top Header -->
     <div class="top-header">
        <div class="logo">Eventora</div>
        <div class="profile">
            <div class="profile-dropdown">
                <img src="photo.png" alt="Profile Icon">
                <div class="profile-dropdown-content">
                    <a href="profile.php">My Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
     
        <a href="eventCreator.php" >Events</a>
        <a href="profile.php" class="active">Profile</a>
        <a href="../mail/inbox.php" >Emails</a>
    </div>


    <div class="main">
        <div class="form-container">
            <h2>Modifier mon Profil</h2>
            <form action="profile_action.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="admin_id" value="<?= htmlspecialchars($adminData['id']) ?>">
                <input type="hidden" name="current_profile_picture" value="<?= htmlspecialchars($adminData['profile_picture']) ?>">

                <!-- Image de profil -->
                <div>
                    <label for="profile_picture" style="font-weight: bold;">Image de profil :</label>
                    <div>
                        <img src="<?= htmlspecialchars($adminData['profile_picture']) ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                    </div>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                </div>

                <!-- Nom d'utilisateur -->
                <div>
                    <label for="username" style="font-weight: bold;">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($adminData['username']) ?>" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" style="font-weight: bold;">Email :</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($adminData['email']) ?>" required>
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" style="font-weight: bold;">Mot de passe (laisser vide pour conserver l'ancien) :</label>
                    <input type="password" id="password" name="password">
                </div>

                <div>
                    <input type="submit" value="Mettre à jour">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
