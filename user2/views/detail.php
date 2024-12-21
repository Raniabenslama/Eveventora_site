<?php
require_once('../controller/EventController.php');

// Instanciation du contrôleur
$eventController = new EventController();

// Vérifier si une recherche a été effectuée
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$results = [];
if (!empty($searchTerm)) {
    // Effectuer une recherche dans les événements
    $results = $eventController->searchEvents($searchTerm, $searchTerm, $searchTerm, $searchTerm);
}

// Récupérer l'événement sélectionné
$event = null;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $event = $eventController->getEvent($_GET['id']);
    if (!$event) {
        die("Événement introuvable.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Événement</title>
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
        .main-content {
            padding: 120px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 100vh;
            background: rgba(39, 39, 39, 0.4);
        }

        .event-image img {
            max-width: 500px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .event-details h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: orange;
        }

        .event-details p {
            font-size: 18px;
            margin: 10px 0;
            color: #ddd;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background: orange;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: darkorange;
        }

        .reserve-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background: green;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .reserve-btn:hover {
            background-color: darkgreen;
        }

        .search-results {
            margin-top: 20px;
            width: 80%;
            text-align: left;
        }

        .search-results h2 {
            color: orange;
            margin-bottom: 10px;
        }

        .search-results .result {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .search-results .result:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="logo">Eventora</div>
        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Rechercher un événement..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">Rechercher</button>
            </form>
        </div>
        <div class="links">
            <a href="contact.php">Contact</a>
            <a href="reservation.php">Réservation</a>
            <a href="logout.php">Déconnexion</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <?php if (!empty($results)): ?>
            <div class="search-results">
                <h2>Résultats de la recherche :</h2>
                <?php foreach ($results as $row): ?>
                    <div class="result">
                        <p><strong><?php echo htmlspecialchars($row['titre']); ?></strong></p>
                        <p>Date : <?php echo htmlspecialchars($row['date']); ?></p>
                        <p>Lieu : <?php echo htmlspecialchars($row['lieu']); ?></p>
                        <a href="?id=<?php echo $row['event_id']; ?>">Voir les détails</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif ($event): ?>
            <!-- Event Details -->
            <div class="event-image">
                <?php if (!empty($event['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($event['image_url']); ?>" alt="Event Image">
                <?php else: ?>
                    <p>Aucune image disponible</p>
                <?php endif; ?>
            </div>

            <div class="event-details">
                <h1><?php echo htmlspecialchars($event['titre']); ?></h1>
                <p><strong>Date :</strong> <?php echo htmlspecialchars($event['date']); ?></p>
                <p><strong>Heure :</strong> <?php echo htmlspecialchars($event['heure']); ?></p>
                <p><strong>Lieu :</strong> <?php echo htmlspecialchars($event['lieu']); ?></p>
                <p><strong>Description :</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                <p><strong>Prix :</strong> <?php echo htmlspecialchars($event['prix_ticket']); ?> $</p>
                <a href="dashboard.php" class="back-link">Retour</a>
                <a href="reservation.php?id=<?php echo $event['event_id']; ?>" class="reserve-btn">Réserver</a>
            </div>
        <?php else: ?>
            <p>Aucun résultat trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>






