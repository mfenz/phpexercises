<?php
// Bei jedem Aufruf eine DB-Verbindung aufbauen
require_once 'db/dbconnection.inc.php';

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
