<?php
session_start();

// Si l'agent n'est pas connecté
if(!isset($_SESSION["name"])){
    header("Location: /pages/connexion");
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
    <link rel="stylesheet" href="/src/styles/pages.css">
    <link rel="shortcut icon" href="/src/styles/img/quentin.ico" type="image/x-icon">    
    <title>Espace Membre</title>
</head>
<body>
    <form method="POST">
        <input type="submit" name="logout" value="Déconnexion">
    </form>

<!-- ------------------ Footer ------------------ -->
    <div class="footer">
        <p>Copyright © Quentin. Made by Quentin Delos for personal use</p>
        <br>
        <a href="/pages/espace_snir">Espace SNIR</a> | <a href="../">Retour à la page d'accueil</a>
    </div>
</body>
</html>