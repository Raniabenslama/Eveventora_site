<?php
include_once('../../controller/contactController.php');

$contactController = new ContactController();

if (isset($_POST['btn-send'])) {
    // Récupérer et sécuriser les données de l'utilisateur
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Vérifier que les champs ne sont pas vides
    if (!$email || empty($name) || empty($subject) || empty($message)) {
        echo '<script>alert("Tous les champs sont requis !");</script>';
        exit;
    }

    // Créer un objet Contact
    $newContact = new Contact(null, $name, $email, $subject, $message);

    // Insérer dans la base de données
    if ($contactController->insertContact($newContact)) {
        // Préparer l'email
        $adminEmail = "jouhainadhahri74@gmail.com"; // Email de l'administrateur
        $mailSubject = "Message de $name : $subject";
        $mailBody = "<p>Nom : $name</p><p>Email : $email</p><p>Message :</p><p>$message</p>";

        // Envoyer l'email
        if ($contactController->sendMail($adminEmail, $mailSubject, $mailBody)) {
            header("Location: contact.php?success");
            exit;
        } else {
            echo '<script>alert("Erreur lors de l\'envoi de l\'email. Essayez plus tard.");</script>';
        }
    } else {
        echo '<script>alert("Erreur lors de l\'insertion dans la base de données.");</script>';
    }
} else {
    header('Location: contact.php');
    exit;
}
?>
