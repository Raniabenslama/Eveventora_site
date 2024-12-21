<?php
session_start();
require_once('../controller/UserController.php'); // Importez votre contrôleur utilisateur

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $password = trim($_POST['password']);

    // Validation des champs
    if (empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($password)) {
        $_SESSION['error'] = 'Veuillez remplir tous les champs.';
    } else {
        // Instancier le contrôleur utilisateur
        $userController = new UserController();

        // Enregistrer l'utilisateur
        $isRegistered = $userController->registerUser($nom, $prenom, $email, $telephone, $password);

        if ($isRegistered) {
            $_SESSION['success'] = 'Utilisateur enregistré avec succès. Vous pouvez maintenant vous connecter.';
        } else {
            $_SESSION['error'] = 'Une erreur est survenue lors de l\'enregistrement.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title> Evenement </title>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
*{  
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body{
    background: url("../images/back2.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    overflow: hidden;
}
.wrapper{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 110vh;
    background: rgba(39, 39, 39, 0.4);
}
.nav{
    position: fixed;
    top: 0;
    display: flex;
    justify-content: space-around;
    width: 100%;
    height: 100px;
    line-height: 100px;
    background: linear-gradient(rgba(39,39,39, 0.6), transparent);
    z-index: 100;
}
.nav-logo p{
    color: white;
    font-size: 25px;
    font-weight: 600;
}
.nav-menu ul{
    display: flex;
}
.nav-menu ul li{
    list-style-type: none;
}
.nav-menu ul li .link{
    text-decoration: none;
    font-weight: 500;
    color: #fff;
    padding-bottom: 15px;
    margin: 0 25px;
}
.link:hover, .active{
    border-bottom: 2px solid #fff;
}
.nav-button .btn{
    width: 130px;
    height: 40px;
    font-weight: 500;
    background: rgba(255, 255, 255, 0.4);
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: .3s ease;
}
.btn:hover{
    background: rgba(255, 255, 255, 0.3);
}
#registerBtn{
    margin-left: 15px;
}
.btn.white-btn{
    background: rgba(255, 255, 255, 0.7);
}
.btn.btn.white-btn:hover{
    background: rgba(255, 255, 255, 0.5);
}
.nav-menu-btn{
    display: none;
}
.form-box{
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 512px;
    height: 420px;
    overflow: hidden;
    z-index: 2;
}
.register-container{
    position: absolute;
    left: 4px;
    width: 500px;
    display: flex;
    flex-direction: column;
    transition: .5s ease-in-out;
}

.top span{
    color: #fff;
    font-size: small;
    padding: 10px 0;
    display: flex;
    justify-content: center;
}
.top span a{
    font-weight: 500;
    color: #fff;
    margin-left: 5px;
}
header{
    color: #fff;
    font-size: 20px;
    text-align: center;
    padding: 0px 0 30px 0;
}
.two-forms{
    display: flex;
    gap: 10px;
}
.input-field {
    font-size: 15px;
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    height: 40px;
    width: 100%;
    padding: 0 10px 0 45px;
    border: none;
    border-radius: 30px;
    outline: none;
    transition: .2s ease;
}
.input-field:hover, .input-field:focus{
    background: rgba(255, 255, 255, 0.25);
}
::-webkit-input-placeholder{
    color: #fff;
}
.input-box i{
    position: relative;
    top: -35px;
    left: 17px;
    color: #fff;
}
.submit {
    font-size: 15px;
    font-weight: 500;
    color: black;
    height: 30px; 
    width: 45%;
    border: none;
    border-radius: 30px;
    outline: none;
    background: rgba(255, 255, 255, 0.7);
    cursor: pointer;
    transition: .3s ease-in-out;
}
.submit:hover{
    background: rgba(255, 255, 255, 0.5);
    box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
}
.two-col{
    display: flex;
    justify-content: space-between;
    color: #fff;
    font-size: small;
    margin-top: 10px;
}
.two-col .one{
    display: flex;
    gap: 5px;
}
.two label a{
    text-decoration: none;
    color: #fff;
}
.two label a:hover{
    text-decoration: underline;
}
@media only screen and (max-width: 786px){
    .nav-button{
        display: none;
    }
    .nav-menu.responsive{
        top: 100px;
    }
    .nav-menu{
        position: absolute;
        top: -800px;
        display: flex;
        justify-content: center;
        background: rgba(255, 255, 255, 0.2);
        width: 100%;
        height: 90vh;
        backdrop-filter: blur(20px);
        transition: .3s;
    }
    .nav-menu ul{
        flex-direction: column;
        text-align: center;
    }
    .nav-menu-btn{
        display: block;
    }
    .nav-menu-btn i{
        font-size: 25px;
        color: #fff;
        padding: 10px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        cursor: pointer;
        transition: .3s;
    }
    .nav-menu-btn i:hover{
        background: rgba(255, 255, 255, 0.15);
    }
}
@media only screen and (max-width: 540px) {
    .wrapper{
        min-height: 100vh;
    }
    .form-box{
        width: 100%;
        height: 500px;
    }
    .register-container, .login-container{
        width: 100%;
        padding: 0 20px;
    }
    .register-container .two-forms{
        flex-direction: column;
        gap: 0;
    }
}
</style>
</head>
<body>
<div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p>Eventora .</p>
        </div>
 
        <div class="nav-button">
    <button class="btn white-btn" id="loginBtn" onclick="location.href='login.php';">Sign In</button>
    <button class="btn" id="registerBtn" onclick="location.href='register.php';">Sign Up</button>
</div>

        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        

    <div class="wrapper">
    <div class="form-box">
    <div class="register-container" id="login">
    <div class="top">
        <header>Sign Up</header>
    </div>

        <!-- Afficher les messages -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="message error"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="message success"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-box">
                <input type="text" class="input-field" name="nom" placeholder="Nom" required minlength="2" maxlength="255">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name="prenom" placeholder="Prénom" required minlength="2" maxlength="255">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="email" class="input-field" name="email" placeholder="Adresse e-mail" required>
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <input type="tel" class="input-field" name="telephone" placeholder="Téléphone" required pattern="[0-9]{10,15}">
                <i class="bx bx-phone"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="password" placeholder="Mot de passe" required minlength="6" maxlength="10">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Register">
                <button type="reset" class="submit" style="margin-top: 10px;">Cancel</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>


