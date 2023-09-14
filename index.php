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
<!-- ------------------ Header ------------------ -->
    <div class="openBar">
        <i class="fas fa-bars" onclick="openmenu()"></i>
    </div>
    <div id="header" onclick="closemenu()">
        <div class="container">
            <nav>
                <h1 class="logo"><u><a href="/"><span>Q</span>uentin.</a></u></h1>
                <ul id="sidemenu">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#about">Présentation</a></li>
                    <li><a href="#knowledge">Compétences</a></li>
                    <li><a href="#portfolio">Centres d'intérêt</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="header-text">
                <p>Apprenti à la <a href="https://www.culture.gouv.fr/Regions/DRAC-Hauts-de-France" target="_blank" title="Qu'est-ce-que la DRAC ?"><u><span>DRAC - HDF</span></u></a></p>
                <h1>Hey, Bienvenue sur mon <span>profil</span>.</h1>
            </div>
        </div>
    </div>
    <div class="btnscroll">
        <a href="#" title="Remonte en haut de la page">
            <i class="fa-solid fa-arrow-up"></i>
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
                    <p>Jeune diplômé, je viens d'avoir mon Bac et je suis actuellement en BTS SNIR en alternance car j'ai eu l'opportunité d'être embauché en tant qu'apprenti au service informatique au ministère de la Culture.</p>
                    <br>
                    <div class="tab-titles">
                        <p class="tab-links active-link" onclick="opentab('education')">Enseignements</p>
                        <p class="tab-links" onclick="opentab('experience')">Expériences</p>
                        <p class="tab-links" onclick="opentab('skills')">Diplômes et Langues</p>
                    </div>
                    <div class="tab-contents active-tab" id="education">
                        <ul>
                            <li><span>De 2022 à aujourd'hui</span><br>UFA César Baggio - Lille<br><strong>BTS SNIR</strong> en alternance</li>
                            <li><span>De 2019 à 2022</span><br>Lycée César Baggio - Lille<br><strong>Bac Pro SN</strong> option <a href="http://lycee-guynemer.com/formations/bac-pro-sn-option-c/#:~:text=Le%20titulaire%20du%20bac%20pro,la%20programmation%20de%20syst%C3%A8mes%20embarqu%C3%A9s." title="Qu'est-ce que c'est ?" target="_blank">RISC</a></li>
                            <li><span>De 2016 à 2019</span><br>Collège Notre-Dame de la Providence - Orchies</li>
                        </ul>
                    </div>
                    <div class="tab-contents" id="experience">
                        <ul>
                            <li><span>D'octobre 2022 à aujourd'hui</span><br><a href="https://www.culture.gouv.fr/Regions/DRAC-Hauts-de-France" target="_blank" title="Qu'est-ce-que la DRAC ?">Direction Régionale des Affaires Culturelles</a>, Hauts-de-France<br>Apprentissage en BTS SNIR</li>
                            <li><span>De novembre 2022 à aujourd'hui</span><br>Ambassadeur du Pass Culture, Lille<br>Ambassadeur en lien avec le <a href="https://www.musee-lam.fr/fr" title="Redirige vers le site du LaM" target="_blank">LaM</a></li>
                        <br>    
                            <li><span>2022 | 1 mois</span><br><a href="https://myfix-store.business.site" target="_blank" title="Redirige vers leur site internet">Myfix</a><br>Stage effectué en classe de Terminale</li>
                            <li><span>2021 | 1 mois</span><br><a href="https://www.yrycom.com" target="_blank" title="Redirige vers leur site internet">YRYcom</a><br>Stage effectué en classe de Terminale</li>
                            <li><span>2020 | 1 mois</span><br>Fnac<br>Stage effectué en classe de 1ère</li>
                            <li><span>2020 | 2 semaines</span><br><a href="https://www.google.com/maps/@50.5272472,3.1716347,3a,59.5y,247.66h,88.03t/data=!3m10!1e1!3m8!1sBymQ5Vb75tFnlipWtPv27g!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3DBymQ5Vb75tFnlipWtPv27g%26cb_client%3Dmaps_sv.tactile.gps%26w%3D203%26h%3D100%26yaw%3D36.541912%26pitch%3D0%26thumbfov%3D100!7i16384!8i8192!9m2!1b1!2i54?entry=ttu" target="_blank" title="Redirige vers le lieu de la boutique">JC SOS PC MICRO</a><br>Stage effectué en classe de 2nd</li>
                            <li><span>2019 | 1 semaine</span><br>ASTI (Service informatique de la SNCF)<br>Stage effectué en classe de 3ème</li>
                        </ul>
                    </div>
                    <div class="tab-contents" id="skills">
                        <ul>
                            <li><span>2024</span><br>Permis de conduire A2 moto</li>
                            <li><span>2023</span><br>Habilitation électrique<br>Habilitable au niveau <a href="https://www.cepelec.com/formations/formations-habilitation-electrique/habilitation-electrique-b0-h0v-br-bc-b1v-b2v-be-essais/#:~:text=La%20lettre%20B%20de%20B1V,aussi%20nomm%C3%A9e%20B1(V)." target="_blank" title="À quoi ça correspond ?">B1V</a> & <a href="https://www.securinorme.com/prevention-au-travail/290-quelles-sont-les-differentes-categories-dhabilitations-electriques-#:~:text=Habilitation%20%C3%A9lectrique%20BR%20%2D%20BS&text=L'habilitation%20%C3%A9lectrique%20BR%20permet,de%20maintenance%20ou%20de%20d%C3%A9pannage." target="_blank" title="À quoi ça correspond ?">BR</a></li>
                            <li><span>2022</span><br>Permis de conduire B voiture</li>
                            <li><span>2022</span><br>Bac Pro SN option RISC<br>Mention Bien</li>
                            <li><span>2019</span><br>Brevet de secourisme<br>Niveau PSC1</li>
                            <li><span>2019</span><br>Brevet général<br>Mention Assez Bien</li>
                        <br>
                            <li><span>Français</span><br>Niveau C2</li>
                            <li><span>Anglais</span><br>Niveau C1</li>
                            <li><span>Allemand</span><br>Niveau A2</li>
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
                    <i class="fas fa-code"></i>
                    <h2>Développement web</h2>
                    <p>Étant plus jeune j'ai "connu" le monde de l'informatique grace au développement web car il se rapproche de la programmation mais réunit aussi d'autres corps des métiers de l'informatique comme la cybersécurité, l'administration réseau, la domotique et j'en passe.
                        <br>C'est donc depuis ce temps-là que j'ai toujours eu envie de faire l'informatique mon métier.</p>
                    <br><hr><br>
                    <p><u>Language utilisé :</u></p>
                        <ul>
                            <li>PHP</li>
                            <li>SqL</li>
                            <li>HTML, CSS, JavaScript</li>
                            <li>Java</li>
                            <li>C & C++</li>
                        </ul>
                    <br>
                    <p><u>Mes projets :</u></p>
                    <a href="/pages/Mine-Clicker/" target="_blank" title="Clique pour voir un de mes projets"><strong>Mine-Clicker</strong></a> | 
                    <a href="https://github.com/quentindelos/Quentin-Delos-s-Website" target="_blank" title="Clique pour voir un de mes projets"><strong>QuentinDelos.fr</strong></a> | 
                    <a href="https://github.com/quentindelos/UXDesign-DRAC" target="_blank" title="Clique pour voir un de mes projets"><strong>UX-Desing DRAC</strong></a>
                </div>
                <div>
                    <i class="fa-brands fa-linux"></i>
                    <h2>Linux</h2>
                    <p>Durant le confinement en 2019 j'ai pris le temps de me familiariser avec Linux sur mon Raspberry Pi 4 (4Gb).
                        <br>Avec ce dernier j'en ai fait un <strong>NAS</strong>, un hébergeur de sites web en local avec <strong>NGINX</strong>, puis un VPN avec <strong>OpenVPN</strong>.
                        <br>J'ai également un serveur Minecraft en ligne sur mon Raspberry.</p>
                    <br><hr><br>
                    <p><u>Techno utilisé :</u></p>
                        <ul>
                            <li>Linux</li>
                            <li>NGINX / Apache</li>
                            <li>Linux server</li>
                            <li>Server hosting</li>
                            <li>Proxmox</li>
                        </ul>
                </div>
                <div>
                    <i class="fa-brands fa-windows"></i>
                    <h2>Administration</h2>
                    <p>Manipulation de Windows Server (2012, 2016 et 2019).
                        <br>Programmation de switch et de routeur Cisco et HP.
                        <br>Jusqu'à la mise en place d'une <strong>GPO</strong> avec un <strong>Active Directory</strong>.
                        <br>Je maîtrise une grande partie du support informatique grace à <strong>GLPI</strong> et d'autres logiciels d'administration comme <strong>WAPT</strong>.</p>
                    <br><hr><br>
                    <p><u>Outils / Services utilisé :</u></p>
                        <ul>
                            <li>Outils RSAT Windows</li>
                            <li>Audit AD</li>
                            <li>Serveur d'impression</li>
                            <li>WS MDT</li>
                            <li>Master PXE boot</li>
                            <br>
                            <li>WAPT</li>
                            <li>GLPI</li>
                            <li>Visual Studio & Visual Studio Code</li>
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
                        <h3>Musique</h3>
                        <p>Passioné de musique (Rock, Métal, Old-school etc).<br>Je me suis mis à la guitare grâce aux morceaux Nirvana, Rammstein, Queens, etc...</p>
                        <button class="btnlayer" title="Vidéo de moi à la guitare"><a href="https://www.youtube.com/embed/tRbLFN9HMIY?start=197" target="_blank"><i class="fas fa-external-link-alt"></i></button></a>
                    </div>
                </div>
                <div class="work">
                    <img src="/src/styles/img/ender3v2_custom.png" alt="Creality Ender 3 V2 custom">
                    <div class="layer">
                        <h3 title="Conception assistée par ordinateur">C.A.O</h3>
                        <p>Comme le bricolage, la "conception assistée par ordinateur" fait parti de mes passe-temps. Le fait d'avoir abouti mon projet ainsi que de l'avoir conçu de A à Z est pour moi la satisfaction ultime.</p>
                        <button class="btnlayer" title="Mes réalisations en 3D"><a href="https://www.dropbox.com/sh/40q3vomkrps58im/AACa7qG0Ev54H0NJ55kqCy9Ua?dl=0" target="_blank"><i class="fas fa-external-link-alt"></i></button></a>
                    </div>
                </div>
                <div class="work">
                    <img src="/src/styles/img/fitness.png" alt="Salle de fitness">
                    <div class="layer">
                        <h3>Sport</h3>
                        <p>De nature sportif, petit j'ai commencé par du foot puis rapidement je me suis m'y aux arts martiaux.<br>À commencer par du karaté ainsi que de la boxe Thaïlandaise.<br>Actuellement, je suis inscrit dans une salle de musculation.</p>
                    </div>
                </div>
                <div class="work">
                    <img src="/src/styles/img/106_S16.png" alt="106 S16 noire">
                    <div class="layer">
                        <h3>Mécanique</h3>
                        <p>Ma première voiture est une 106 S16 que je "rénove" car elle a plus de 20 ans.<br>N'ayant aucune formation en mécanique j'apprends petit à petit grâce aux nombreuses vidéos sur internet et sur des forums.</p>
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
                    <p><i class="fas fa-paper-plane"></i><a href="mailto:delosquentin@gmail.com" target="_blank" title="Clique pour m'envoyer un mail directement">delosquentin@gmail.com</a></p>
                    <p><i class="fa-solid fa-phone"></i><a href="tel:+33783667334" title="Mon téléphone portable pro">07 83 66 73 34</a></p>
                    <div class="social-icons">
                        <a href="https://www.linkedin.com/in/delosquentin" target="_blank" title="Mon profil Linkedin"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="https://github.com/quentindelos" target="_blank" title="Mon profil GitHub"><i class="fa-brands fa-github"></i></a>
                        <a href="https://www.instagram.com/quentin.pdf" target="_blank" title="Mon profil Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.facebook.com/quentin.deIos" target="_blank" title="Mon profil Facebook"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://www.youtube.com/@quentin_delos" target="_blank" title="Ma chaine YouTube"><i class="fa-brands fa-youtube"></i></a>
                        <a href="https://open.spotify.com/user/dquentin-" target="_blank" title="Mon profil Spotify"><i class="fa-brands fa-spotify"></i></a>
                    </div>
                    <div class="downloadPdf">
                        <a href="/src/CV-DELOS-Quentin.pdf" download class="btn" title="Clique pour télécharger mon CV">Télécharger mon CV  <i class="fa-solid fa-file-pdf"></i></a>
                    </div>
                </div>
                <div class="contact-right">
                    <form method="POST">
                        <input type="text" name="name" placeholder="Votre nom, prénom" maxlength="50" required>
                        <input type="email" name="email" placeholder="Votre email" maxlength="90" required>
                        <textarea type="text" rows="6" name="message" placeholder="Votre message" maxlength="1000" required></textarea>
                        <button type="submit" name="send" class="btn">Envoyer</button>
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
                <strong><a href='/pages/espace_snir'>Espace SNIR</a> | <a href='/pages/espace_membre'>Espace membre</a></strong>
                    <form method='POST'>
                        <button type='submit' name='logout' class='btnLogout'>Déconnexion  <i class='fa-solid fa-right-from-bracket'></i></button>
                    </form>
            </div>";
    }
?>
    <script src="/src/scripts/index.js"></script>
</body>
</html>