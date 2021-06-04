<?php
// Session starten
// Session-Cookie wird an den Besucher geschickt
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    // angemeldet
    header('Location: ./profil.php');
    return;
} else {
    // nicht angemeldet, auf Login weiterleiten
}

// Bei jedem Aufruf eine DB-Verbindung aufbauen
require_once 'db/dbconnection.inc.php';
// UserManager-Datei inkludieren
require_once 'manager/usermanager.inc.php';
// UserManager-Objekt erzeugen (um auf login-Methode zugreifen zu können)
$userManager = new UserManager($connection);

$errors = [];

if(isset($_POST['btsubmit'])){
    if(strlen(trim($_POST['email'])) == 0){
        $errors[] = 'Bitte die E-Mail Adresse eingeben.';
    }
    if(strlen(trim($_POST['password'])) == 0){
        $errors[] = 'Bitte das Passwort eingeben.';
    }
    if(count($errors) == 0){
        // Login durchführen
        $loginErfolgreich = $userManager->
                                login($_POST['email'], $_POST['password']);
        if($loginErfolgreich == true){
            // Auf das Profil weiterleiten
            header('Location: ./profil.php');
        } else {
            $errors[] = 'E-Mail / Passwort prüfen.';
        }
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
    <h1>Login</h1>
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
    <form action="login.php" method="post">
        <div>
            <label>Email</label><br/>
            <input type="text" name="email">
        </div>
        <div>
            <label>Passwort</label><br/>
            <input type="password" name="password">
        </div>
        <input type="submit" name="btsubmit" value="Login">
    </form>
</section>
</body>
</html>
