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
        
                            $insert_Message = $bdd->prepare('INSERT INTO message(name, email, message)VALUES(?, ?, ?)');
                            $insert_Message->execute(array($name, $email, $message));
                            
                                // Envoi de l'email de confirmation
                                $to = $email;
                                $subject = "Confirmation de votre message";
                                $message_mail = "Bonjour " . $name . ",\r\n\r\nVotre message a bien été envoyé. Nous vous remercions pour votre intérêt et nous vous répondrons dans les plus brefs délais.\r\n\r\nCordialement,\r\nQuentin Delos.";
                                $headers = "From: delosquentin@gmail.com";

                                if(mail($to, $subject, $message_mail, $headers)){
                                    echo "L'email de confirmation a été envoyé avec succès.";
                                } else {
                                    echo "Erreur lors de l'envoi de l'email de confirmation.";
                                }

                                // Envoi d'un mail avec le contenu du message
                                $to_me = "delosquentin@gmail.com";
                                $subject_me = "Reception d'un message sur le site";
                                $message_me = "Message de " . $name . ":\r\n\r\n". $message ."\r\n\r\n";
                                
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
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="shortcut icon" href="/styles/img/quentin.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Quentin Delos</title>
</head>
<body>
<!-- ------------------ Header ------------------ -->
    <div id="header">
        <div class="container">
            <nav>
                <h1 class="logo"><a href="/"><span>Q</span>uentin.</a></h1>
                <ul id="sidemenu">
                    <li><a href="/">Accueil</a></li>
                    <li><a href="#about">Présentation</a></li>
                    <li><a href="#services">Compétences</a></li>
                    <li><a href="#portfolio">Centres d'intérêt</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <i class="fas fa-times" onclick="closemenu()"></i>
                </ul>
                <i class="fas fa-bars" onclick="openmenu()"></i>
            </nav>
            <div class="header-text">
                <p>Apprenti à la DRAC - HDF</p>
                <h1>Hi, I'm <span>Quentin</span>.</h1>
            </div>
        </div>
    </div>
    <div class="btnscrool">
        <a href="#">
            <i class="fas fa-arrow-up"></i>
        </a>
    </div>
<!-- ------------------ Présentation ------------------ -->
    <div id="about">
        <div class="container">
            <div class="row">
                <div class="about-col-1">
                    <img src="/styles/img/user.png" alt="photo de Quentin Delos">
                </div>
                <div class="about-col-2">
                    <h1 class="sub-title">Présentation</h1>
                    <br>
                    <p>Jeune diplômé, je viens d'avoir mon Bac et je suis actuellement en BTS SNIR en alternance car j'ai eu l'opportunité d'être embauché en tant qu'apprenti au service informatique au ministère de la Culture.<br>Après l'obtention de mon BTS je compte me diriger vers le développement Web chez Efficom en faisant un Bac +3.</p>
                    <br>
                    <div class="tab-titles">
                        <p class="tab-links active-link" onclick="opentab('education')">Enseignements</p>
                        <p class="tab-links" onclick="opentab('experience')">Expériences</p>
                        <p class="tab-links" onclick="opentab('skills')">Diplômes et Langues</p>
                    </div>
                    <div class="tab-contents active-tab" id="education">
                        <ul>
                            <li><span>De 2022 à aujourd'hui</span><br>UFA César Baggio - Lille | BTS SNIR alternance</li>
                            <li><span>De 2019 à 2022</span><br>Lycée César Baggio - Lille | Bac Pro SN option RISC </li>
                            <li><span>De 2016 à 2019</span><br>Collège Notre-Dame de la Providence - Orchies</li>
                        </ul>
                    </div>
                    <div class="tab-contents" id="experience">
                        <ul>
                            <li><span>D'octobre 2022 à aujourd'hui</span><br>Direction Régionale des affaires culturelles, Hauts-de-France<br>Apprentissage en BTS</li>
                            <li><span>De novembre 2022 à aujourd'hui</span><br>Ambassadeur du Pass Culture, Lille<br>Ambassadeur en lien avec le <a href="https://www.musee-lam.fr/fr" target="_blank">LaM</a></li>
                        <br>    
                            <li><span>2022 | 1 mois</span><br>Myfix<br>Stage effectué en classe de Terminale</li>
                            <li><span>2021 | 1 mois</span><br>YRYcom<br>Stage effectué en classe de Terminale</li>
                            <li><span>2020 | 1 mois</span><br>Fnac<br>Stage effectué en classe de 1ère</li>
                            <li><span>2020 | 2 semaines</span><br>JC SOS PC MICRO<br>Stage effectué en classe de 2nd</li>
                            <li><span>2019 | 1 semaine</span><br>ASTI (SNCF)<br>Stage effectué en classe de 3ème</li>
                        </ul>
                    </div>
                    <div class="tab-contents" id="skills">
                        <ul>
                            <li><span>2022</span><br>Permis de conduire B</li>
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
    <div id="services">
        <div class="container">
            <h1 class="sub-title">Compétences</h1>
            <div class="services-list">
                <div>
                    <i class="fas fa-code"></i>
                    <h2>Développement web</h2>
                    <p>Étant plus jeune j'ai "connu" le monde de l'informatique grace au développement web car il se rapproche de la programmation mais réunit aussi d'autres corps des métiers de l'informatique comme la cybersécurité, l'administration réseau, la domotique et j'en passe.<br>C'est donc depuis ce temps-là que j'ai toujours eu envie de faire l'informatique mon métier.</p>
                    <a href="/Mine-Clicker/index" target="_blank">Mine-Clicker</a>
                </div>
                <div>
                    <i class="fas fa-server"></i>
                    <h2>Linux</h2>
                    <p>Durant le confinement j'ai eu l'idée de me familiariser avec Linux donc je me suis procuré un Raspberry Pi.<br>Avec ce dernier j'en ai fait un NAS, un hébergeur de sites web en local, puis j'y ai rajouté un VPN pour les pubs et autres raisons.<br>J'ai également un serveur Minecraft qui tourne dessus pour jouer avec du monde.</p>
                    <!-- <a href="">En savoir plus</a> -->
                </div>
                <div>
                    <i class="fab fa-app-store"></i>
                    <h2>Outils & App</h2>
                    <p>Je manipule souvent avec Windows Server, de la programmation d'un switch ou d'un routeur jusqu'à la mise en place d'une GPO.<br>J'assure sur le côté support informatique avec GLPI etc...</p>
                    <!-- <a href="">En savoir plus</a> -->
                </div>
            </div>
        </div>
    </div>
<!-- ------------------ Centres d'intérêts ------------------ -->
    <div id="portfolio">
        <div class="container">
            <h1 class="sub-title">Centres d'intérêt</h1>
            <div class="work-list">
                <div class="work">
                    <img src="/styles/img/work-1.png" alt="image de ma guitare">
                    <div class="layer">
                        <h3>Guitare</h3>
                        <p>Depuis que j'écoute de la musique et nottement du rock / métal je me suis mis à la guitare pour pouvoir reproduire de célèbres riffs comme ceux de Rammstein ou de Nirvana et de AC/DC et j'en passe.</p>
                        <!-- <a href=""><i class="fas fa-external-link-alt"></i></a> -->
                    </div>
                </div>
                <div class="work">
                    <img src="/styles/img/work-2.png" alt="Photo de mon installation imprimante 3D">
                    <div class="layer">
                        <h3>Modélisation 3D</h3>
                        <p>Comme le bricolage, le fait d'avoir abouti ton projet et de l'avoir conçu de A à Z est pour moi la satisfaction ultime.</p>
                        <!-- <a href=""><i class="fas fa-external-link-alt"></i></a> -->
                    </div>
                </div>
                <div class="work">
                    <img src="/styles/img/work-3.png" alt="image de mon pc gamer">
                    <div class="layer">
                        <h3>Sport</h3>
                        <p>J'aime énormément le sport, étant petit j'ai commencé par du foot puis rapidement je me suis m'y aux arts martiaux.<br>À commencer par du karaté pendant une année puis de la boxe Thaïlandaise durant 4 ans.<br>À l'heure actuelle, je suis inscrit dans une salle de musculation depuis l'an dernier.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ------------------ Contact ------------------ -->
    <div id="contact">
        <div class="container">
            <div class="row">
                <div class="contact-left">
                    <h1 class="sub-title">Contactez-Moi</h1>
                    <p><i class="fas fa-paper-plane"></i><a href="mailto:delosquentin@gmail.com">delosquentin@gmail.com</a></p>
                    <p><i class="fas fa-phone-square-alt"></i><a href="tel:+33689304058">06 89 30 40 58</a></p>
                    <div class="social-icons">
                        <a href="https://www.linkedin.com/in/delosquentin/" target="_blank"><i class="fab fa-linkedin"></i></a><a href="https://github.com/quentindelos" target="_blank"><i class="fab fa-github"></i></a>
                    </div>
                    <a href="/styles/img/Delos_Quentin's_CV.pdf" download class="btn">Télécharger mon CV (.pdf)</a>
                </div>
                <div class="contact-right">
                    <form method="POST">
                        <input type="text" name="name" placeholder="Votre nom" required>
                        <input type="email" name="email" placeholder="Votre Email" required>
                        <textarea type="text" rows="6" name="message" placeholder="Votre message" required></textarea>
                        <button type="submit" name="send" class="btn">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- ------------------ Footer ------------------ -->
<div class="copyright">
    <p>Copyright © Quentin. Made by Quentin Delos for personal use</p>
    <a href="/pages/espace-membre">Espace membres</a>
</div>
    <!-- Changement de colonnes dans la présentation -->
    <script src="/scripts/index.js"></script>
</body>
</html>