<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

$nom     = trim(strip_tags($_POST["nom"] ?? ""));
$email   = filter_var($_POST["email"] ?? "", FILTER_VALIDATE_EMAIL);
$message = trim($_POST["message"] ?? "");

if ($nom === "" || !$email || $message === "") {
    http_response_code(400);
    exit("Formulaire invalide.");
}

$nom = str_replace(["\r", "\n"], " ", $nom);

$destinataire = "zahir.rahmani08@gmail.com";
$sujet = mb_encode_mimeheader("Nouveau message de contact de $nom", "UTF-8");
$corps = "Nom: $nom\nE-mail: $email\n\nMessage:\n$message";

$entetes  = "From: contact@ton-domaine.fr\r\n";   // adresse de ton domaine
$entetes .= "Reply-To: $email\r\n";
$entetes .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($destinataire, $sujet, $corps, $entetes)) {
    header("Location: confirmation.html");
    exit;
}

http_response_code(500);
echo "Une erreur est survenue, merci de réessayer ou de me contacter par email.";
