<?php
session_start();
if(!isset($_SESSION["name"])){
    header("Location: /connexion");
exit(); 
}
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/espace_membre.css">
    <link rel="shortcut icon" href="/styles//img/quentin.ico" type="image/x-icon">
    <title>Espace membre</title>
</head>
<body>
    <a href="../">Retour à la page d'accueil</a>
</body>
</html>