<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail Admin/User</title>
    <style>
        /* Style général pour le body */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Alignement à gauche */
            justify-content: flex-start; /* Contenu aligné en haut */
            background: url("../images/bac.jpg") no-repeat center center/cover;
            font-family: Arial, sans-serif;
        }

        /* Couche semi-transparente pour améliorer la lisibilité */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Couche noire avec transparence */
            z-index: -1;
        }

        /* Style pour le titre */
        h1 {
            margin: 20px;
            margin-right: 950px; 
            margin-bottom: 120px;
            color: #ECF8F6; /* Couleur personnalisée */
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            align-self: center; /* Centrage horizontal du titre */
        }

        /* Conteneur principal centré */
        .container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            justify-content: center;
            align-items: center;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1); /* Arrière-plan transparent blanc */
            border-radius: 20px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            align-self: center; /* Centrage horizontal du conteneur */
        }

        /* Style pour chaque cadre */
        .card {
            width: 200px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.7); /* Blanc semi-transparent */
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            text-decoration: none;
            color: #333;
            font-size: 1.2rem;
            font-weight: bold;
        }

        /* Animation au survol */
        .card:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body>
    <!-- Overlay pour l'arrière-plan -->
    <div class="overlay"></div>

    <!-- Titre de la page -->
    <h1>EventTora</h1>

    <!-- Conteneur des cartes -->
    <div class="container">
        <!-- Carte Admin -->
        <a href="admin2/views/signup_admin.php" class="card">
            Partie Admin
        </a>

        <!-- Carte User -->
        <a href="user2/views/login.php" class="card">
            Partie User
        </a>
    </div>
</body>
</html>
