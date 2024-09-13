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
    <link rel="preload" href="/src/styles/font/TripSans-Medium.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="/src/styles/pages.css">
    <link rel="shortcut icon" href="/src/styles/img/annexes.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Annexes</title>
</head>
<body>
<!-- ------------------ Liens ------------------ -->
<div id="tools">
        <div class="container">
            <div class="row">
                <h1 class="sub-title">Listes de liens et d'outils utiles :</h1>
                <br>
                <p>Outils utiles :</p>
                    <ul>
                        <li><a href="https://convertio.co/fr" target="_blank">convertio.co</a></li>
                        <li><a href="https://www.windy.com" target="_blank">windy.com</a></li>
                        <li><a href="https://www.canva.com" target="_blank">canvas.com</a></li>
                    </ul>
                <br><br>
                <p>Outils informatiques :</p>
                    <ul>
                        <li><a href="https://www.it-connect.fr" target="_blank">it-connect.fr</a></li>
                        <li><a href="https://rdr-it.com" target="_blank">rdr-it.com</a></li>
                        <li><a href="https://codepen.io" target="_blank">codepen.io</a></li>
                        <li><a href="https://community.chocolatey.org" target="_blank">chocolatey.org</a></li>
                        <li><a href="https://app.diagrams.net" target="_blank">app.diagrams.net</a></li>
                        <li><a href="https://trello.com/fr" target="_blank">trello.com</a></li>
                        <li><a href="https://speed.cloudflare.com" target="_blank">speed.cloudflare.com</a></li>
                    </ul>
                <br><br>
                <p>Outils de montage :</p>
                    <ul>
                        <li><a href="https://123apps.com/fr" target="_blank">123apps.com</a></li>
                        <li><a href="https://www.photopea.com" target="_blank">photopea.com</a></li>
                        <li><a href="https://clideo.com/editor" target="_blank">clideo.com</a></li>
                    </ul>
                <br><br>
                <p>Liens pratiques :</p>
                    <ul>
                        <li><a href="https://iptvision.pro/product/abonnement-esiptv-pro-code-android" target="_blank">iptvision.pro</a></li>
                        <li><a href="http://agence-iptv.com" target="_blank">agence-iptv.com</a> | Code promo : Reno30</li>
                        <li><a href="https://vostfree.ws" target="_blank">vostfree.ws</a></li>
                        <li><a href="https://voiranime.site" target="_blank">voiranime.site</a></li>
                        <li><a href="https://t.me/s/ZT_officiel" target="_blank">zone-telechargement</a></li>
                        <li><a href="https://t.me/s/Wawacity_officiel" target="_blank">wawacity</a></li>
                        <li><a href="https://weakpass.com/wordlist" target="_blank">weakpass.com</a></li>
                        <li><a href="https://osintframework.com" target="_blank">osintframework.com</a></li>
                    </ul>
                <br><br>
                <p>Se protéger sur internet :</p>
                    <ul>
                        <li><a href="https://chrome.google.com/webstore/detail/urban-vpn-proxy/eppiocemhmnlbhjplcgkofciiegomcon" target="_blank">urban-vpn.com</a></li>
                        <li><a href="https://www.privateinternetaccess.com/buy-vpn-online" target="_blank">privateinternetaccess.com</a></li>
                        <li><a href="https://temp-mail.org/fr" target="_blank">temp-mail.org</a></li>
                        <li><a href="https://quackr.io" target="_blank">quackr.io</a></li>
                    </ul>
                <br><br>
            </div>
        </div>
    </div>    
<!-- ------------------ Footer ------------------ -->
    <div class="footer">
        <p>Made by Quentin Delos for personal use</p>
        <br>
        <strong><a href="../">Retour à la page d'accueil</a></strong>
        <form method='POST'>
            <button type='submit' name='logout' class='btnLogout'>Déconnexion<i class='fa-solid fa-right-from-bracket'></i></button>
        </form>     
    </div>
</body>
</html>