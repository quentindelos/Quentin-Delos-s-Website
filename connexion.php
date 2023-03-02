<?php
session_start();
if(!isset($_SESSION["name"])){
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

    if(isset($_POST['login'])){
        if(!empty($_POST['name_or_email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
            if ($_POST["password"] === $_POST["confirm_password"]){
                $name_or_email = htmlspecialchars($_POST['name_or_email']);
                $password = sha1($_POST['password']);
        
                $recupUser = $bdd->prepare('SELECT * FROM auth WHERE (name = :name_or_email OR email = :name_or_email) AND password = :password');
                $recupUser->execute(array(':name_or_email' => $name_or_email, ':password' => $password));
        
                $user = $recupUser->fetch();
                if($user){
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['password'] = $password;
                    $_SESSION['id_membre'] = $user['id_membre'];
                    header('Location: /pages/espace-membre'); 
                } else {
                    echo "<script type='text/javascript'>alert('Les identifiants que tu as mis ne sont pas corrects.');</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Les mots de passe ne correspondent pas.');</script>";
            }
        }
    }

    if(isset($_POST['register'])){
        if(!empty($_POST['name']) AND !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
            $name = htmlspecialchars($_POST['name']);
            $checkname = $bdd->query("SELECT * FROM auth WHERE name='$name'");
            $result = $checkname->fetch();
                if (!$result) {
                    $email = htmlspecialchars($_POST['email']);
                    $checkemail = $bdd->query("SELECT * FROM auth WHERE email='$email'");
                    $result = $checkemail->fetch();
                        if (!$result) {
                            if ($_POST["password"] === $_POST["confirm_password"]){
                                $password = sha1($_POST['password']);
        
                                $insertUser = $bdd->prepare('INSERT INTO auth(name, email, password)VALUES(?, ?, ?)');
                                $insertUser->execute(array($name, $email, $password));
        
                                $recupUser = $bdd->prepare('SELECT * FROM auth WHERE name = ? AND email = ? AND password = ?');
                                $recupUser->execute(array($name, $email, $password));
        
                                if($recupUser->rowCount() > 0){
                                    $_SESSION['name'] = $name;
                                    $_SESSION['email'] = $email;
                                    $_SESSION['password'] = $password;
                                    $_SESSION['id_membre'] = $recupUser->fetch()['id_membre'];
                                    header('Location: /pages/espace-membre'); 
                                }
                            } else {
                                echo "<script type='text/javascript'>alert('Les mots de passe ne correspondent pas.');</script>";
                            }
                        } else {
                            echo "<script type='text/javascript'>alert('L\'adresse mail existe déjà.');</script>";
                        }
                } else {
                    echo "<script type='text/javascript'>alert('Le pseudo est déjà utilisé.');</script>";
                }
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
    <link rel="shortcut icon" href="/styles/img/lock.ico" type="image/x-icon">
    <link rel="stylesheet" href="/styles/connexion.css">
    <title>Authentification</title>
</head>
<body>
    <div class="container">
        <div class="orangeBG">
            <div class="box signin">
                <h2>Déjà un compte ?</h2>
                <button class="signinbtn">Connexion</button>
            </div>
            <div class="box signup">
                <h2>Déjà un compte ?</h2>
                <button class="signupbtn">Inscription</button>
            </div>
        </div>
        <div class="form-box">
            <div class="form signinform">
                <form method="POST">
                    <h3>Connexion</h3>
                    <input type="text" name="name_or_email" placeholder="Pseudo ou Email" required>
                    <input type="password" name="password" id="password1" placeholder="Mot de passe" required>
                    <input type="password" name="confirm_password" id="password2" placeholder="Confirmer mot de passe" required>
                    <label for="show-password">Afficher les mots de passe <input type="checkbox" id="show-password-login"></label>
                    <input type="submit" name="login" value="Connecter">
                </form> 
            </div>
            <div class="form signupform">
                <form method="POST">
                    <h3>Inscription</h3>
                    <input type="text" name="name" placeholder="Pseudo" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" id="password3" placeholder="Mot de passe" required>
                    <input type="password" name="confirm_password" id="password4" placeholder="Confirmer mot de passe" required>
                    <label for="show-password">Afficher les mots de passe <input type="checkbox" id="show-password-register"></label>
                    <input type="submit" name="register" value="S'inscrire">
                </form> 
            </div>
        </div>
    </div>

    <script>
        //affiche le mot de passe dans le formulaire
        const showPasswordCheckbox1 = document.getElementById("show-password-login");
        const passwordField1 = document.getElementById("password1");
        const passwordField2 = document.getElementById("password2");
        const showPasswordCheckbox2 = document.getElementById("show-password-register");
        const passwordField3 = document.getElementById("password3");
        const passwordField4 = document.getElementById("password4");

        showPasswordCheckbox1.addEventListener("change", function () {
            if (showPasswordCheckbox1.checked) {
                passwordField1.type = "text";
                passwordField2.type = "text";
            } else {
                passwordField1.type = "password";
                passwordField2.type = "password";
            }
        });
        showPasswordCheckbox2.addEventListener("change", function () {
            if (showPasswordCheckbox2.checked) {
                passwordField3.type = "text";
                passwordField4.type = "text";
            } else {
                passwordField3.type = "password";
                passwordField4.type = "password";
            }
        });
    </script>

    <script src="/scripts/auth.js"></script>
</body>
</html>