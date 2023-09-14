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

// Si l'utilisateur fait parti des SNIR
$emailSnir = ["delosquentin@gmail.com", "nicolaslegal59@gmail.com", "pierremaz31@outlook.com", "brieuc.huot@gmail.com", "cyril.maguire@outlook.fr", "enzothiourt@gmail.com", "alexandredoremus@gmail.com", "an.senouci13@gmal.com"];
if (isset($_SESSION["email"]) && in_array($_SESSION["email"], $emailSnir)) {
    echo "Bienvenue chez les SNIR " . $_SESSION["name"];
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
    <link rel="stylesheet" href="/src/styles/pages.css">
    <link rel="shortcut icon" href="/src/styles/img/baggio.ico" type="image/x-icon">    
    <title>Espace SNIR</title>
</head>
<body>
<!-- ------------------ Contact ------------------ -->
<div id="contact">
        <div class="container">
            <div class="row">
                <div class="contact-left">
                    <h1 class="sub-title">Publie un post</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusantium voluptatibus possimus recusandae. Tempore perspiciatis, eligendi repudiandae omnis minima qui ratione odio saepe distinctio asperiores odit et sequi cumque corporis amet?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui incidunt quasi delectus vitae quas vero consequatur dicta, hic recusandae eum autem minima sint natus dolor, veritatis veniam magni adipisci sed.</p>
                </div>
                <div class="contact-right">
                    <form method="POST">
                        <input type="text" name="name" placeholder="Votre nom et prénom" maxlength="50" required>
                        <input type="email" name="email" placeholder="Votre Email" maxlength="90" required>
                        <textarea type="text" rows="6" name="message" placeholder="Votre message" maxlength="1000" required></textarea>
                        <button type="submit" name="send" class="btn">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
<!-- ------------------ Footer ------------------ -->
<form method="POST">
    <input type="submit" name="logout" value="Déconnexion">
</form>
    <div class="footer">
        <p>Copyright © Quentin. Made by Quentin Delos for personal use</p>
        <br>
        <a href="../">Retour à la page d'accueil</a> | <a href="/pages/espace_membre">Espace Membre</a>
    </div>
</body>
</html>