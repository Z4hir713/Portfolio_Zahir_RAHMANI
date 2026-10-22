<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $destinataire = "zahir.rahmani08@gmail.com"; 
    $sujet = "Nouveau message de contact de $nom";
    $corps_message = "Nom: $nom\n";
    $corps_message .= "E-mail: $email\n";
    $corps_message .= "Message:\n$message";

    $entetes = "De: $email";

    // Utilisez la fonction mail() pour envoyer l'e-mail
    mail($destinataire, $sujet, $corps_message, $entetes);

    // Redirection après l'envoi du formulaire
    header("Location: confirmation.html");
}
?>