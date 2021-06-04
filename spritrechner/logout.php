<?php
// Immer am Anfang der Date session_start() aufrufen um 
// auf die SessionVariablen zugreifen zu können
session_start();
// Bei jedem Aufruf eine DB-Verbindung aufbauen
require_once 'db/dbconnection.inc.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    // angemeldet
} else {
    // nicht angemeldet, auf Login weiterleiten
    header('Location: ./login.php');
    return;
}

if(isset($_POST['btlogout'])){
    // Abmelden
    $_SESSION['loggedin'] = false;
    $_SESSION['userid'] = '';
    // Session löschen
    session_destroy();
    // Redirect auf index.php
    header('Location: index.php?loggedout=true');
    return;
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Abmelden</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php include 'inc/header.inc.php'; ?>
<section class="center-wrapper">
    <h1>Abmelden</h1>
    <form action="logout.php" method="post">
        <button name="btlogout">Abmelden</button>
    </form>
</section>
</body>
</html>
