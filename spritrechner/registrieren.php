<?php
session_start();

// Prüfen ob User bereits angemeldet ist?
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    // angemeldet
    header('Location: ./profil.php');
    return;
} else {
    // nicht angemeldet, auf Login weiterleiten
}

// Bei jedem Aufruf eine DB-Verbindung aufbauen
require_once 'db/dbconnection.inc.php';
require_once 'manager/usermanager.inc.php';

$userManager = new UserManager($connection);

$errors = [];

// Prüfen ob btsubmit gesendet wurde
if(isset($_POST['btsubmit'])){
    if(strlen(trim($_POST['email'])) == 0){
        $errors[] = 'Bitte eine E-Mail Adresse eingeben.';
    }
    if(strlen(trim($_POST['password'])) <= 5){
        $errors[] = 'Das Passwort muss aus mindestens 6 Zeichen bestehen.';
    }

    // Wenn es keine Fehler gibt --> Registrierung durchführen
    if(count($errors) == 0){
        $id = $userManager->addUser($_POST['email'], $_POST['password']);

        // Nach dem Registrieren auf die Login-Seite weiterleiten
        header('Location: ./login.php?registriert=true');
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Registrieren</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php include 'inc/header.inc.php'; ?>
<section class="center-wrapper">
    <h1>Account erstellen</h1>
    <?php
    // Fehler ausgeben
    if(count($errors) > 0){
        echo '<div class="error">';
        // Fehler stehen als String im array $errors
        // Über jeden Eintrag iterieren, und den Eintrag ausgeben lassen
        foreach($errors as $error){
            // Schleifenkörper
            echo "<p>$error</p>";
        }
        echo '</div>';
    }
    ?>
    <form action="registrieren.php" method="post">
        <div>
            <label>Email</label><br/>
            <input type="text" name="email">
        </div>
        <div>
            <label>Passwort</label><br/>
            <input type="password" name="password">
        </div>
        <input type="submit" name="btsubmit" value="Registrieren">
    </form>
</section>
</body>
</html>
