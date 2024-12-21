<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez l'Administrateur</title>
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
            text-align: center;
        }

        .contact-form {
            margin-top: 100px;
            color: #ff5722;
            text-transform: uppercase;
        }

        .contact-form h2 {
            font-size: 32px;
            font-style: italic;
            font-weight: bold;
            text-shadow: 2px 2px 5px #888888;
            color: #BED3C3;
        }

        form {
            margin-top: 50px;
        }

        .form-control {
            width: 400px;
            background: transparent;
            border: none;
            outline: none;
            border-bottom: 1px solid gray;
            color: #fff;
            font-size: 18px;
            margin-bottom: 18px;
        }

        input {
            height: 45px;
        }

        form .submit {
            background: #BED3C3;
            border: transparent;
            color: black;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            height: 50px;
            width: 100px;
            margin-top: 20px;
        }

        form .submit:hover {
            background: #f44336;
            cursor: pointer;
        }

        /* Responsive Design */
        @media only screen and (max-width: 786px) {
            .top-header .search-bar input[type="text"] {
                width: 200px;
            }
        }

        @media only screen and (max-width: 540px) {
            .main {
                padding: 80px 10px;
            }
            .contact-form h2 {
                font-size: 28px;
            }
            .form-control {
                width: 100%;
            }
        }
        form .cancel {
            background: #9e9e9e;
            border: transparent;
            color: white;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            height: 50px;
            width: 100px;
            margin-top: 20px;
            margin-left: 20px;
        }

        form .cancel:hover {
            background: #616161;
            cursor: pointer;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
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
        <div class="contact-form">
            <h2>Contactez l'Administrateur</h2>
            <form method="post" action="contactaction.php">
                <input type="text" name="name" class="form-control" placeholder="Votre nom" required><br>
                <input type="email" name="email" class="form-control" placeholder="Votre email" required><br>
                <input type="text" name="subject" class="form-control" placeholder="Sujet" required><br>
                <textarea name="message" class="form-control" placeholder="Votre message" rows="4" required></textarea><br>
                
                <div class="button-container">
                <input type="submit" name="btn-send" class="submit" value="Envoyer">
                <a href="dashboard.php"><input type="button" value="Annuler" class="cancel"></a>
            </div>
            </form>
        </div>
    </div>
</body>
</html>
