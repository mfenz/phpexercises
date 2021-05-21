<?php
// Bei jedem Aufruf eine DB-Verbindung aufbauen
require_once 'inc/dbconnection.inc.php';

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Willkommen!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<header class="center-wrapper">
    <div class="title">Deutschkurse GmbH</div>
    <div class="menu">
        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./kontaktformular.php">Kontakt</a></li>
            <li><a href="./kontaktanfragen.php">Kontaktanfragen</a></li>
            <li><a href="./login.php">Login</a></li>
            <li><a href="./logout.php">Logout</a></li>
            <li><a href="./registrieren.php">Registrieren</a></li>
        </ul>
    </div>
</header>
</body>
</html>
