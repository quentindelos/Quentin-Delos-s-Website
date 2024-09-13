<?php
session_start();
    // Paramètres de connexion à la base de données
    $host = "";
    $dbname = "";
    $username = "";
    $password = "";

    // Chaîne de connexion PDO
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    // Connexion à la base de données avec PDO
    try {
        $bdd = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }

    // Informations Client
    include('src/UserInformation.php');
    $IPv4User = UserInfo::get_ip();
    $osUser = UserInfo::get_os();
    $deviceUser = UserInfo::get_device();
    $browserUser = UserInfo::get_browser();


    if(isset($_POST['send'])){
        if(!empty($_POST['name']) AND !empty($_POST['email']) && !empty($_POST['message'])){
            $name = htmlspecialchars($_POST['name']);
            $checkname = $bdd->query("SELECT * FROM message WHERE name='$name'");
            $result = $checkname->fetch();
                if (!$result) {
                    $email = htmlspecialchars($_POST['email']);
                    $checkemail = $bdd->query("SELECT * FROM message WHERE email='$email'");
                    $result = $checkemail->fetch();
                        if (!$result) {
                            $message = htmlspecialchars($_POST['message']);
        
                            $insert_Message = $bdd->prepare('INSERT INTO message(name, email, message, ip_User, os_User, device_User, browser_User)VALUES(?, ?, ?, ?, ?, ?, ?)');
                            $insert_Message->execute(array($name, $email, $message, $IPv4User, $osUser, $deviceUser, $browserUser));
                            
                                // Envoi de l'email de confirmation
                                $subject = "Confirmation de votre message";
                                $message_mail = "Bonjour " . $name . ",\r\nVotre message a bien été envoyé.\r\nJe vous remercie pour votre intérêt et je vous répondrai dans les plus brefs délais.\r\n\r\nSi vous souhaitez me contacter par téléphone pour une consultation quasi instantanée je vous prie de m'appeler avec ce numéro de téléphone : 07 83 66 73 34\r\n\r\nCordialement,\r\nQuentin Delos.";

                                if(mail($email, $subject, $message_mail)){
                                    echo "L'email de confirmation a été envoyé avec succès.";
                                } else {
                                    echo "Erreur lors de l'envoi de l'email de confirmation.";
                                }

                                // Envoi d'un mail avec le contenu du message
                                $to_me = "delosquentin@gmail.com";
                                $subject_me = "Reception d'un message sur le site";
                                $message_me = "Message de " . $name . " :\r\n\r\n". $message ."\r\n\r\nProvient de l'adresse IPv4 : ". $IPv4User ."\r\nProvient d'un ". $deviceUser ." sur un ". $osUser;
                                
                                if(mail($to_me, $subject_me, $message_me)){
                                    echo "L'email de confirmation a été envoyé avec succès.";
                                } else {
                                    echo "Erreur lors de l'envoi de l'email de confirmation.";
                                }

                            header('Location: /'); 
                        } else {
                            echo "<script type='text/javascript'>alert('Un message a déjà été envoyé avec cet email.');</script>";
                        }
                } else {
                echo "<script type='text/javascript'>alert('Un message a déjà été envoyé avec ce nom.');</script>";
            }
        }
    }

    // Déconnexion
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
    <link rel="stylesheet" href="/src/styles/index.css">
    <link rel="shortcut icon" href="/src/styles/img/quentin.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Quentin Delos</title>
</head>
<body>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

<!-- ------------------ Header ------------------ -->
    <div class="openBar">
        <i class="fas fa-bars" onclick="openmenu()"></i>
    </div>
    <div id="header" onclick="closemenu()">
        <div class="container">
            <nav>
                <h1 class="logo"><u><a href="/">Quentin.</a></u></h1>
                <ul id="sidemenu">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#about">Présentation</a></li>
                    <li><a href="#knowledge">Compétences</a></li>
                    <li><a href="#portfolio">Centres d'intérêt</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="header-text">
                <h1>Hey! <span class="auto-type"></span></h1>
                <p>Apprenti à <a href="https://www.lamie-mutuelle.com/a-propos" target="_blank" title="Qu'est-ce-que Lamie Mutuelle ?"><u><span>Lamie Mutuelle</span></u></a>.</p>
            </div>
        </div>
    </div>
    <div class="btnscroll">
        <a href="#" title="Remonte en haut de la page">
            <i class="fa-solid fa-angles-up"></i>
        </a>
    </div>
<!-- ------------------ Présentation ------------------ -->
    <div id="about" onclick="closemenu()">
        <div class="container">
            <div class="row">
                <div class="about-col-1">
                    <img src="/src/styles/img/Quentin.png" alt="photo de Quentin Delos">
                </div>
                <div class="about-col-2">
                    <h1 class="sub-title">Présentation</h1>
                    <br>
                    <p>Actuellement étudiant en informatique avec pour objectif de devenir Administrateur Systèmes et Réseaux.<br>Ma soif de connaissance et ma passion pour l'efficacité dans le travail sont des traits essentiels de ma personnalité.<br>J'ai horreur de voir un projet traîner et je m'efforce toujours de travailler de manière efficace, que ce soit en équipe ou en autonomie.<br>Ma détermination à atteindre mes objectifs et mon engagement à fournir un travail de qualité font de moi un candidat motivé pour relever les défis qui se présenteront à moi dans le domaine de l'informatique.</p>
                    <br>
                    <div class="tab-titles">
                        <p class="tab-links active-link" onclick="opentab('education')">Scolarité</p>
                        <p class="tab-links" onclick="opentab('experience')">Expériences</p>
                        <p class="tab-links" onclick="opentab('skills')">Diplômes</p>
                        <p class="tab-links" onclick="opentab('languages')">Langues</p>
                    </div>
                    <div class="tab-contents active-tab" id="education">
                        <ul>
                            <li><span>De 2024 à 2025</span><br>ESGI - Lille<br><a href="https://www.esgi.fr/programmes/systeme-reseau-cloud-computing.html" title="Qu'est-ce que c'est ?" target="_blank">Bachelor Systèmes, Réseaux et Cloud Computing</a> en alternance</li>
                            <li><span>De 2022 à juin 2024</span><br>UFA César Baggio - Lille<br><strong>BTS Systèmes Numériques option Informatiques et Réseaux</strong> en alternance</li>
                            <li><span>De 2019 à 2022</span><br>Lycée César Baggio - Lille<br><strong>Bac Pro SN</strong> option <a href="http://lycee-guynemer.com/formations/bac-pro-sn-option-c/#:~:text=Le%20titulaire%20du%20bac%20pro,la%20programmation%20de%20syst%C3%A8mes%20embarqu%C3%A9s." title="Qu'est-ce que c'est ?" target="_blank">Réseaux Informatiques et Systèmes Communiquants</a></li>
                            <li><span>De 2016 à 2019</span><br>Collège Notre-Dame de la Providence - Orchies</li>
                        </ul>
                    </div>
                    <div class="tab-contents" id="experience">
                        <ul>
                            <li><span>D'octobre 2024 à aujourd'hui</span><br><a href="https://www.lamie-mutuelle.com/a-propos" target="_blank" title="Qu'est-ce-que Lamie Mutuelle ?">Lamie Mutuelle</a>, Marcq-en-Barœul<br>Apprentissage en Bachelor Systèmes, Réseaux et Cloud Computing</li>
                            <li><span>2022 à 2024</span><br><a href="https://www.culture.gouv.fr/Regions/DRAC-Hauts-de-France" target="_blank" title="Qu'est-ce-que la DRAC ?">Direction Régionale des Affaires Culturelles</a>, Hauts-de-France<br>Apprentissage en BTS SNIR</li>
                            <li><span>De 2022 à 2023</span><br><a href="https://pass.culture.fr/le-programme-ambassadeurs-du-pass-culture/#:~:text=Les%20Ambassadeurs%20représentent%20les%20jeunes,culturelles%20sur%20le%20pass%20Culture." target="_blank" title="Les missions d'Ambassadeur du Pass Culture.">Ambassadeur du Pass Culture</a>, Lille<br>Ambassadeur en lien avec le <a href="https://www.musee-lam.fr/fr" title="Redirige vers le site du LaM" target="_blank">LaM</a></li>
                            <li><span>2020,2021,2022  | 5 mois</span><br>
                            <a href="https://myfix-store.business.site" target="_blank" title="Redirige vers leur site internet">Myfix</a> - 
                            <a href="https://www.yrycom.com" target="_blank" title="Redirige vers leur site internet">YRYcom</a> - 
                            <a href="https://www.google.fr/maps/place/FNAC+Lille/@50.6358486,3.062322,17z/data=!3m1!4b1!4m6!3m5!1s0x47c2d588f1169905:0xcaf7dce352f5fad4!8m2!3d50.6358452!4d3.0649023!16s%2Fg%2F1z264pqwd?entry=ttu" target="_blank">Fnac Lille</a> - 
                            <a href="https://www.google.com/maps/@50.5272472,3.1716347,3a,59.5y,247.66h,88.03t/data=!3m10!1e1!3m8!1sBymQ5Vb75tFnlipWtPv27g!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3DBymQ5Vb75tFnlipWtPv27g%26cb_client%3Dmaps_sv.tactile.gps%26w%3D203%26h%3D100%26yaw%3D36.541912%26pitch%3D0%26thumbfov%3D100!7i16384!8i8192!9m2!1b1!2i54?entry=ttu" target="_blank" title="Redirige vers le lieu de la boutique">JC SOS PC MICRO</a>
                            <br>Stages effectués en classe de Seconde, Première et Terminale</li>
                            <li><span>2019 | 1 semaine</span><br>ASTI (Service informatique de la SNCF)<br>Stage effectué en classe de 3ème</li>
                        </ul>
                    </div>
                    <div class="tab-contents" id="skills">
                        <ul>
                            <li><span>2024</span><br>BTS SNIR</li>
                            <li><span>2023</span><br>Permis de conduire A2 moto</li>
                            <li><span>2023</span><br>Habilitation électrique<br>Habilitable au niveau <a href="https://www.cepelec.com/formations/formations-habilitation-electrique/habilitation-electrique-b0-h0v-br-bc-b1v-b2v-be-essais/#:~:text=La%20lettre%20B%20de%20B1V,aussi%20nomm%C3%A9e%20B1(V)." target="_blank" title="À quoi ça correspond ?">B1V</a> & <a href="https://www.securinorme.com/prevention-au-travail/290-quelles-sont-les-differentes-categories-dhabilitations-electriques-#:~:text=Habilitation%20%C3%A9lectrique%20BR%20%2D%20BS&text=L'habilitation%20%C3%A9lectrique%20BR%20permet,de%20maintenance%20ou%20de%20d%C3%A9pannage." target="_blank" title="À quoi ça correspond ?">BR</a></li>
                            <li><span>2022</span><br>Permis de conduire B voiture</li>
                            <li><span>2022</span><br>Bac Pro SN option RISC<br>Mention Bien</li>
                            <li><span>2019</span><br>Brevet de secourisme<br>Niveau PSC1</li>
                            <li><span>2019</span><br>Brevet général<br>Mention Assez Bien</li>
                        </ul>
                    </div>
                    <div class="tab-contents" id="languages">
                        <ul>
                            <li><span>Français</span><br>Niveau C2 - Langue natale</li>
                            <li><span>Anglais</span><br>Niveau B2 - Usage de la langue tous les jours<br>Voyages, jeux vidéos, formations</li>
                            <li><span>Allemand</span><br>Niveau A2 - Apprentissage au collège (3ans)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ------------------ Compétences ------------------ -->
    <div id="knowledge" onclick="closemenu()">
        <div class="container">
            <h1 class="sub-title">Compétences</h1>
            <div class="knowledge-list">
                <div>
                    <i class="fa-brands fa-php"></i><i class="fa-brands fa-square-js"></i><i class="fa-brands fa-html5"></i><i class="fa-brands fa-css3-alt"></i><i class="fa-brands fa-java"></i>
                    <h2>Développement web</h2>
                    <hr><br>
                    <p><u>Language utilisé :</u></p>
                        <ul>
                            <li>PHP</li>
                            <li>SqL</li>
                            <li>HTML, CSS, JavaScript</li>
                            <li>Java</li>
                            <li>C & C++</li>
                            <li>Bash, PowerShell</li>
                        </ul>
                    <br>
                    <p><u>Mes projets :</u></p>
                    <a href="/pages/Mine-Clicker/" target="_blank" title="Clique pour voir mon projet"><strong>Mine-Clicker</strong></a> | 
                    <a href="https://github.com/quentindelos/qdelos.fr" target="_blank" title="Clique pour voir mon projet"><strong>quentindelos.fr</strong></a> | 
                    <a href="https://github.com/quentindelos/Framework" target="_blank" title="Clique pour voir mon projet"><strong>Mon Framework</strong></a> | 
                    <a href="https://github.com/quentindelos/ProjetFinal_SNIR" target="_blank" title="Clique pour voir mon projet"><strong>Projet Final BTS</strong></a>
                </div>
                <div>
                    <i class="fa-brands fa-linux"></i><i class="fa-solid fa-terminal"></i><i class="fa-solid fa-server"></i>
                    <h2>Technologies</h2>
                    <hr><br>
                    <p><u>Techno utilisé :</u></p>
                        <ul>
                            <li>Linux (Debian)</li>
                            <li>OpenVPN</li>
                            <li>NGINX / Apache</li>
                            <li>Github</li>
                            <li>Hosting server</li>
                            <li>VM Ware ESXI 8 & Workstation 17</li>
                            <li>Proxmox VE</li>
                            <li>Cisco Packet Tracer</li>
                            <li>Microsoft Hyper-V</li>
                        </ul>
                </div>
                <div>
                    <i class="fa-brands fa-windows"></i><i class="fa-solid fa-gears"></i>
                    <h2>Administration</h2>
                    <hr><br>
                    <p><u>Outils / Services utilisé :</u></p>
                        <ul>
                            <li>RSAT Windows</li>
                            <li>Audit Active Directory</li>
                            <li>Serveur d'impression Windows Server</li>
                            <li>Déploiement MDT - WDS</li>
                            <li>WAPT</li>
                            <li>GLPI</li>
                            <li>Nagios</li>
                            <li>Visual Studio / Visual Studio Code</li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
<!-- ------------------ Centres d'intérêts ------------------ -->
    <div id="portfolio" onclick="closemenu()">
        <div class="container">
            <h1 class="sub-title">Centres d'intérêt</h1>
            <div class="work-list">
                <div class="work">
                    <img src="/src/styles/img/guitares.png" alt="image de ma guitare">
                    <div class="layer">
                        <h3>Guitare</h3>
                        <p>Passioné de rock et de metal.<br>Je me suis mis à la guitare en 2022.</p>
                        <button class="btnlayer" title="Vidéo de moi à la guitare"><a href="https://www.youtube.com/embed/tRbLFN9HMIY?start=197" target="_blank"><i class="fas fa-external-link-alt"></i></button></a>
                    </div>
                </div>
                <div class="work">
                    <img src="/src/styles/img/ender3v2_custom.png" alt="Creality Ender 3 V2 custom">
                    <div class="layer">
                        <h3 title="Conception assistée par ordinateur">C.A.O</h3>
                        <p>Comme le bricolage, la Conception Assistée par Ordinateur fait partie de mes passe-temps. J'aime créer mon projet de A à Z et.</p>
                        <button class="btnlayer" title="Mes réalisations en 3D"><a href="https://www.dropbox.com/sh/40q3vomkrps58im/AACa7qG0Ev54H0NJ55kqCy9Ua?dl=0" target="_blank"><i class="fas fa-external-link-alt"></i></button></a>
                    </div>
                </div>
                <div class="work">
                    <img src="/src/styles/img/fitness.png" alt="Salle de fitness">
                    <div class="layer">
                        <h3>Sport</h3>
                        <p>J'ai commencé par du foot, puis rapidement je me suis mis aux arts martiaux.<br>J'ai enchainé avec le karaté pour ensuite faire la boxe Thaïlandaise.<br>Récemment, je suis inscrit dans une salle de musculation.</p>
                    </div>
                </div>
                <div class="work">
                    <img src="/src/styles/img/106_S16.png" alt="106 S16 noire">
                    <div class="layer">
                        <h3>Peugeot 106 S16</h3>
                        <p>J'ai acheté une 106 S16 que je répare pour la remettre en superbe état.<br>N'ayant aucune formation en mécanique j'apprends au fur et à mesure sur internet et sur des forums.</p>
                        <button class="btnlayer" title="Clique pour voir les photos du projet rénovation de ma 106 S16"><a href="https://www.dropbox.com/scl/fo/0anu6w9qv071btn1eqs91/h?rlkey=g9o2kh9tu7tirtvymz6zrl2wz&dl=0" target="_blank"><i class="fas fa-external-link-alt"></i></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ------------------ Contact ------------------ -->
    <div id="contact" onclick="closemenu()">
        <div class="container">
            <div class="row">
                <div class="contact-left">
                    <h1 class="sub-title">Contactez-moi</h1>
                    <p><a href="mailto:delosquentin@gmail.com" target="_blank" title="Clique pour m'envoyer un mail directement"><i class="fa-solid fa-envelope"></i>delosquentin@gmail.com</a></p>
                    <p><a href="tel:+33783667334" title="Mon téléphone portable"><i class="fa-solid fa-phone-volume"></i>07 83 66 73 34</a></p>
                    <div class="social-icons">
                        <a href="https://www.linkedin.com/in/delosquentin" target="_blank" title="Mon profil Linkedin"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="https://github.com/quentindelos" target="_blank" title="Mon profil GitHub"><i class="fa-brands fa-github"></i></a>
                    </div>
                    <div class="downloadPdf">
                        <a href="/src/CV_Quentin_DELOS.pdf" download class="btn" title="Clique pour télécharger mon CV">Télécharger mon CV<i class="fa-solid fa-file-pdf"></i></a>
                    </div>
                </div>
                <div class="contact-right">
                    <form method="POST">
                        <input type="text" name="name" placeholder="Votre nom, prénom" maxlength="50" required>
                        <input type="email" name="email" placeholder="Votre email" maxlength="90" required>
                        <textarea type="text" rows="6" name="message" placeholder="Votre message" maxlength="1000" required></textarea>
                        <button type="submit" name="send" class="btn">Envoyer un message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- ------------------ Footer ------------------ -->
<?php
    if(!isset($_SESSION["name"])){
        echo"
            <div class='footer' onclick='closemenu()'>
                <p>Made by Quentin Delos for personal use.</p>
                <br>
                <strong><a href='/pages/connexion'>Se connecter</a></strong>
            </div>";
    } else {
        echo"
            <div class='footer' onclick='closemenu()'>
                <p>Made by Quentin Delos for personal use.</p>
                <br>
                <strong><a href='/pages/annexes'>Annexes</a></strong>
                    <form method='POST'>
                        <button type='submit' name='logout' class='btnLogout'>Déconnexion<i class='fa-solid fa-right-from-bracket'></i></button>
                    </form>
            </div>";
    }
?>
    <script src="/src/scripts/index.js"></script>
</body>
</html>