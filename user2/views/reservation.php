<?php
require_once('../controller/EventController.php');

// Récupérer les données de l'événement
$offreCtr = new EventController();
$res = $offreCtr->getEvent($_GET['id']);
if (!$res) {
    die("Événement introuvable.");
}

// Instanciation du contrôleur
$eventController = new EventController();

// Vérifier si une recherche a été effectuée
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$results = [];
if (!empty($searchTerm)) {
    // Effectuer une recherche dans les événements
    $results = $eventController->searchEvents($searchTerm, $searchTerm, $searchTerm, $searchTerm);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver l'Événement</title>
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
            color: #fff;
        }

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

        .main-content {
            margin: 120px auto 0;
            max-width: 800px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .main-content h1 {
            font-size: 28px;
            text-align: center;
            color: orange;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            color: #fff;
        }

        table th, table td {
            text-align: left;
            padding: 10px 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        table th {
            background: rgba(255, 255, 255, 0.1);
        }

        table td input[type="text"] {
            width: 100%;
            padding: 8px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 5px;
            color: #fff;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
        }

        .form-actions button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .form-actions .btn-confirm {
            background: green;
            color: white;
            transition: background-color 0.3s ease;
        }

        .form-actions .btn-confirm:hover {
            background: darkgreen;
        }

        .form-actions .btn-cancel {
            background: red;
            color: white;
            transition: background-color 0.3s ease;
        }

        .form-actions .btn-cancel:hover {
            background: darkred;
        }

        .search-results {
            margin-top: 20px;
            width: 100%;
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
        <?php else: ?>
            <h1>Réserver l'Événement</h1>
            <form name="form" method="post" action="dashboard.php" onsubmit="return confirmReservation()">
                <table>
                    <tr>
                        <th>Titre de l'événement</th>
                        <td><input type="text" name="titre" value="<?php echo htmlspecialchars($res['titre']); ?>" readonly></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><input type="text" name="date" value="<?php echo htmlspecialchars($res['date']); ?>" readonly></td>
                    </tr>
                    <tr>
                        <th>Heure</th>
                        <td><input type="text" name="heure" value="<?php echo htmlspecialchars($res['heure']); ?>" readonly></td>
                    </tr>
                    <tr>
                        <th>Lieu</th>
                        <td><input type="text" name="lieu" value="<?php echo htmlspecialchars($res['lieu']); ?>" readonly></td>
                    </tr>
                    <tr>
                        <th>Prix du ticket</th>
                        <td><input type="text" name="prix_ticket" value="<?php echo htmlspecialchars($res['prix_ticket']); ?> $" readonly></td>
                    </tr>
                </table>
                <div class="form-actions">
                    <button type="submit" name="confirm" class="btn-confirm">Confirmer</button>
                    <button type="button" class="btn-cancel" onclick="window.location.href='events_recent.php'">Annuler</button>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script>
        function confirmReservation() {
            alert("Votre réservation a été effectuée avec succès !");
            return true;
        }
    </script>
</body>
</html>




