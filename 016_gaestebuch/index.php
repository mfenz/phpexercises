<?php
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
<h2>Im Gästebuch eintragen</h2>
<!-- action: wo das Formular hingeschickt werden soll -->
<form action="index.php" method="post">
    <div>
        <label>Name</label><br/>
        <input type="text" name="name">
    </div>
    <div>
        <label>Email</label><br/>
        <input type="text" name="email">
    </div>
    <div>
        <label>Text</label><br/>
        <textarea name="text" rows="10"></textarea>
    </div>
    <input type="submit" name="btsubmit" value="Eintragen">
</form>
</body>
</html>
