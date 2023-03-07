<?php
session_start();

// Si l'agent n'est pas connecté
if(!isset($_SESSION["name"])){
    header("Location: /connexion");
exit(); 
}

// Bouton déconnexion
if(isset($_POST['logout'])){
    session_destroy();
    header('location: /');
}

// Si l'utilisateur fait parti des SNIR
$emailSnir = ["delosquentin@gmail.com", "nicolaslegal59@gmail.com", "pierremaz31@outlook.com", "brieuc.huot@gmail.com", "cyril.maguire@outlook.fr", "enzothiourt@gmail.com", "alexandredoremus@gmail.com", "an.senouci13@gmal.com"];
if (isset($_SESSION["email"]) && in_array($_SESSION["email"], $emailSnir)) {
    echo "<h1>Bienvenu chez les SNIR " . $_SESSION["name"] ."</h1>";
} else {
    header('location: espace_membre');
}
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/espace_snir.css">
    <link rel="stylesheet" href="/styles/img/favicon-baggio.ico" type="image/x-icon">
    <title>Espace SNIR</title>
</head>
<body>
    <a href="../">Retour à la page d'accueil</a>
    <br>
    <br>
    <form method="POST">
        <input type="submit" name="logout" value="Déconnexion">
    </form>
</body>
</html>