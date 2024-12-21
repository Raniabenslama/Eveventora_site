<?php
require_once('../controllers/eventController.php');
$offreCtr = new EventController();
$res = $offreCtr->getEvent($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify event</title>
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
            background-color: #f1f1f1;
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
            top: 50px; /* Adjusts to leave space for the header */
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
            background-color: #D7BBE2;
        }

        .sidebar a:hover {
            background-color: rgb(191, 150, 207);
        }

        .sidebar a.active {
            background-color: #8E44AD;
            color: white;
        }

        .sidebar a span {
            margin-left: 10px;
        }

        /* Main Content */
        .main {
            margin-left: 240px; /* Leaves space for the fixed sidebar */
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

        .add-event-btn {
            background-color: #d9bfa1;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        .add-event-btn:hover {
            background-color: #c8a589;
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

        /* Main Content */
        .main {
            flex-grow: 1;
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

        input[type="text"], input[type="date"], textarea {
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

        /* Event Table */
        .event-list {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
       
        form {
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
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
 
        <a href="eventCreator.php" class="active">Events</a>
        <a href="profile.php">Profile</a>
        <a href="../mail/inbox.php" >Emails</a>
    </div>

    <div class="main">
    <h1>Modify event</h1>
    <form name="form" method="post" action="modif_action.php" class="form-container">
        <table>
            <tr>
                <td>ID:</td>
                <td><input type="text" name="event_id" readonly="readonly" value="<?php echo $res['event_id'] ?>"></td>
            </tr>
            <tr>
                <td>Event title:</td>
                <td><input type="text" name="titre" value="<?php echo $res['titre'] ?>"></td>
            </tr>
            <tr>
                <td>Date:</td>
                <td><input type="text" name="date" value="<?php echo $res['date'] ?>"></td>
            </tr>
            <tr>
                <td>Hour:</td>
                <td><input type="text" name="heure" value="<?php echo $res['heure'] ?>"></td>
            </tr>
            <tr>
                <td>Place:</td>
                <td><input type="text" name="lieu" value="<?php echo $res['lieu'] ?>"></td>
            </tr>
            <tr>
                <td>About event:</td>
                <td><input type="text" name="description" value="<?php echo $res['description'] ?>"></td>
            </tr>
            <tr>
                <td>Ticket price:</td>
                <td><input type="text" name="prix_ticket" value="<?php echo $res['prix_ticket'] ?>"></td>
            </tr>
           
            <tr>
                <td colspan="2"><input type="submit" value="Modifier" name="mod"></td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>
