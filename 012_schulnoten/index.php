<?php

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
<?php
// Prüfen ob 1) POST request, 2) ob Noten-Textfeld vorhanden ist
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note'])){
    switch($_POST['note']){
        // wenn 1 eingegeben wurde
        case '1': echo $_POST['note'] . ' ist Sehr Gut.<br/>';
            break;
        case '2': echo $_POST['note'] . ' ist Gut.<br/>';
            break;
        case '3': echo $_POST['note'] . ' ist Befriedigend.<br/>';
            break;
        case '4': echo $_POST['note'] . ' ist Genügend.<br/>';
            break;
        case '5': echo $_POST['note'] . ' ist Nicht Genügend.<br/>';
            break;
        default: 
            echo htmlspecialchars($_POST['note']) . 
                " ist eine ungültige Eingabe.";
    }
}
?>
<form action="index.php" method="post">
<label>Schulnote (Ziffer)</label><br/>
<input type="text" name="note"><br/>
<button name="btsubmit">Ziffer in Text umwandeln</button>
</form>
</body>
</html>
