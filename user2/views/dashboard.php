<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: url("../images/background.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            overflow: hidden;
            color: #fff;
        }

        /* Top Header */
        .top-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: linear-gradient(rgba(39, 39, 39, 0.6), transparent);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .top-header .logo {
            font-size: 24px;
            font-weight: bold;
            color: orange;
        }

        .top-header .search-bar {
            flex: 1;
            display: flex;
            justify-content: center;
            margin: 0 20px;
        }

        .top-header .search-bar input[type="text"] {
            font-size: 15px;
            padding: 8px 10px;
            width: 300px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
            border-radius: 5px;
            outline: none;
            transition: 0.2s ease-in-out;
        }

        .top-header .search-bar input[type="text"]:hover,
        .top-header .search-bar input[type="text"]:focus {
            background: rgba(255, 255, 255, 0.3);
        }

        .top-header .search-bar button {
            padding: 8px 15px;
            margin-left: 10px;
            border: none;
            border-radius: 5px;
            background-color: orange;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .top-header .search-bar button:hover {
            background-color: darkorange;
        }

        .top-header .links a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            margin-left: 15px;
            padding: 8px 12px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        .top-header .links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Main Content */
        .main {
            padding: 120px 20px;
            background: rgba(39, 39, 39, 0.4);
            min-height: 100vh;
        }

        .main h1 {
            font-size: 28px;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Event Cards */
        .event-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .event-card {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
        }

        .event-card img {
            width: 100%;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .event-card h3 {
            font-size: 20px;
            margin: 10px 0;
        }

        .event-card p {
            font-size: 14px;
            color: #ddd;
        }

        .event-card .card-footer {
            margin-top: 10px;
        }

        .event-card .edit-btn {
            display: inline-block;
            padding: 8px 15px;
            margin: 5px;
            background: orange;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .event-card .edit-btn:hover {
            background: darkorange;
        }

        /* Responsive Design */
        @media only screen and (max-width: 786px) {
            .top-header .search-bar input[type="text"] {
                width: 200px;
            }
        }

        @media only screen and (max-width: 540px) {
            .event-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="logo">Eventora</div>
        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Rechercher..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <div class="links">
            <a href="contactv.php">Contact</a>
            <a href="reservation.php">Réservation</a>
            <a href="logout.php">Déconnexion</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <?php
        require_once('../controller/EventController.php');
        $us = new EventController();

        // Récupérer le terme de recherche
        $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

        if (!empty($searchTerm)) {
            // Résultats de la recherche
            echo "<h1>Résultats de la recherche</h1>";
            $results = $us->searchEvents($searchTerm, $searchTerm, $searchTerm, $searchTerm);

            if (empty($results)) {
                echo "<p>Aucun événement trouvé.</p>";
            } else {
                echo "<div class='event-cards'>";
                foreach ($results as $row) {
                    $imagePath = !empty($row['image_url']) ? $row['image_url'] : 'images/default_event.jpg';
                    if (!file_exists($imagePath)) {
                        $imagePath = 'images/default_event.jpg';
                    }
                    echo "
                        <div class='event-card'>
                            <img src='{$imagePath}' alt='Event Image'>
                            <h3>{$row['titre']}</h3>
                            <p><strong>Date :</strong> {$row['date']}</p>
                            <p><strong>Lieu :</strong> {$row['lieu']}</p>
                            <p><strong>Description :</strong> {$row['description']}</p>
                            <div class='card-footer'>
                                <a href='detail.php?id={$row['event_id']}' class='edit-btn'>Voir</a>
                                <a href='reservation.php?id={$row['event_id']}' class='edit-btn'>Réserver</a>
                            </div>
                        </div>
                    ";
                }
                echo "</div>";
            }
        } else {
            // Événements récents
            echo "<h1>Événements récents</h1>";
            $res = $us->getRecentEvents();

            if (empty($res)) {
                echo "<p>Aucun événement trouvé.</p>";
            } else {
                echo "<div class='event-cards'>";
                foreach ($res as $row) {
                    $imagePath = !empty($row['image_url']) ? $row['image_url'] : 'images/default_event.jpg';
                    if (!file_exists($imagePath)) {
                        $imagePath = 'images/default_event.jpg';
                    }
                    echo "
                        <div class='event-card'>
                            <img src='{$imagePath}' alt='Event Image'>
                            <h3>{$row['titre']}</h3>
                            <p><strong>Date :</strong> {$row['date']}</p>
                            <p><strong>Heure :</strong> {$row['heure']}</p>
                            <p><strong>Lieu :</strong> {$row['lieu']}</p>
                            <p><strong>Description :</strong> {$row['description']}</p>
                            <p><strong>Prix du ticket :</strong> {$row['prix_ticket']} $</p>
                            <div class='card-footer'>
                                <a href='detail.php?id={$row['event_id']}' class='edit-btn'>Voir</a>
                                <a href='reservation.php?id={$row['event_id']}' class='edit-btn'>Réserver</a>
                            </div>
                        </div>
                    ";
                }
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>







