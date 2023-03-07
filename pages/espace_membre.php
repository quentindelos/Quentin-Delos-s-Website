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
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/espace_snir.css">
    <link rel="shortcut icon" href="/styles/img/quentin.ico" type="image/x-icon">
    <title>Espace Membre</title>
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