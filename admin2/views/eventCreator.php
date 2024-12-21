<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <style>
        /* Existing styles... */
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

    <!-- Main Content -->
    <div class="main">
        <div class="header">
            <h1>Events</h1>
            <form method="GET" action="eventCreator.php">
                <input type="text" name="search" placeholder="Search events...">
                <button type="submit">Search</button>
            </form>
            <a href="addEvent.php" class="add-event-btn">+ Add Event</a>
        </div>

        <div class="events-placeholder">
            <?php
            require_once('../controllers/eventController.php');
            $us = new EventController();

            // Retrieve search term
            $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
            $res = $us->liste($searchTerm);

            if (empty($res)) {
                echo "<p>No events found!</p>";
            } else {
                foreach ($res as $row) {
                    echo "
                        <div class='event-item'>
                            <h3>{$row['titre']}</h3>
                            <p><span>Date:</span> {$row['date']}</p>
                            <p><span>Hour:</span> {$row['heure']}</p>
                            <p><span>Place:</span> {$row['lieu']}</p>
                            <p><span>Description:</span> {$row['description']}</p>
                            <p><span>Ticket Price:</span> {$row['prix_ticket']} $</p><br>
                            <p>
    <a href='modif.php?id={$row['event_id']}' class='edit-btn'>Edit</a>
    <a href='sup.php?id={$row['event_id']}' class='delete-btn'>Delete</a>
     <a href='participants.php?event_id={$row['event_id']}' class='participants-btn'>Participant List</a>
</p>
                        </div>
                    ";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
