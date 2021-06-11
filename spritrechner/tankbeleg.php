<?php
// Session starten
session_start();
// Prüfen ob User angemeldet ist
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    // angemeldet
} else {
    // nicht angemeldet, auf Login weiterleiten
    header('Location: ./login.php');
    return;
}


// Bei jedem Aufruf eine DB-Verbindung aufbauen
require_once 'db/dbconnection.inc.php';
// Klasse Tankmanager inkludieren
require_once 'manager/tankmanager.inc.php';

// Objekt der Klasse TankManager erzeugt
$tankManager = new TankManager($connection);

$errors = [];

if(isset($_POST['btsubmit'])){
    if(strlen(trim($_POST['km'])) == 0){
        $errors[] = "Bitte KM angeben";
    }
    if(strlen(trim($_POST['liter'])) == 0){
        $errors[] = "Bitte Liter angeben";
    }
    if(strlen(trim($_POST['betrag'])) == 0){
        $errors[] = "Bitte Betrag angeben";
    }
    if(strlen(trim($_POST['datum'])) == 0){
        $errors[] = "Bitte das Datum angeben";
    }
    if(strlen(trim($_POST['zeit'])) == 0){
        $errors[] = "Bitte die Zeit angeben";
    }

    // 10.06.2021 13:14
    $zeitpunkt = DateTime::createFromFormat('d.m.Y H:i', 
                    $_POST['datum'] . ' ' . $_POST['zeit']);
    if($zeitpunkt === false){
        $errors[] = "Bitte das Datums-Format prüfen";
    }

    if(count($errors) == 0){
        // Tankbeleg in DB einfügen

        $tankManager->addTankbeleg($_SESSION['userid'], 
                    $_POST['km'], $_POST['liter'], $_POST['betrag'], 
                    $zeitpunkt);

        header('Location: ./profil.php');
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Tankbeleg</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php include 'inc/header.inc.php'; ?>
<section class="center-wrapper">
    <h1>Tankbeleg erfassen</h1>
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
    <form action="tankbeleg.php" method="post">
        <div>
            <label>Gefahrene Distanz (km)</label><br/>
            <input type="text" name="km">
        </div>
        <div>
            <label>Getankte Menge (l)</label><br/>
            <input type="text" name="liter">
        </div>
        <div>
            <label>Bezahlter Betrag (€)</label><br/>
            <input type="text" name="betrag">
        </div>
        <div>
            <label>Datum (tt.mm.jjjj)</label><br/>
            <input type="text" name="datum">
        </div>
        <div>
            <label>Uhrzeit (hh:mm)</label><br/>
            <input type="text" name="zeit">
        </div>
        <input type="submit" name="btsubmit" value="Tankbeleg erfassen">
    </form>
</section>
</body>
</html>
