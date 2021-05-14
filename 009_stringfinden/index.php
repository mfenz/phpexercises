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
// Text: Das Wetter ist schön
// Suche: ist
// --> "ist" befindet sich an der Stelle x
// Suche: nicht
// --> "nicht" wurde nicht gefunden. 
?>
<h1>Text finden</h1>
<?php
// suchen!
// prüfen ob Formular abgeschickt wurde (ob Button geschickt wurde)
if(isset($_POST['btsubmit'])){
    // Formular-Input-Felder in Script einlesen
    // anhand des name-Attributs
    $text = $_POST['text'];
    $suche = $_POST['suche'];
    // Herausfinden ob $suche in $text enthalten ist?
    $position = strpos($text, $suche);
    if($position === false){
        // wir haben $suche NICHT in $text gefunden
        echo '<div class="not-found">';
        echo "\"$suche\" wurde nicht in \"$text\" gefunden.";
        echo "</div>";
    } else {
        // wir haben $suche in $text gefunden
        echo '<div class="found">';
        echo "Wir konnten \"$suche\" in \"$text\" finden";
        echo '</div>';
    }
}
?>
<!-- action: wo das Formular hingeschickt werden soll -->
<form action="index.php" method="post">
    <div>
        <label>Text</label><br/>
        <textarea name="text"></textarea>
    </div>
    <div>
        <label>Suche nach</label><br/>
        <input type="text" name="suche">
    </div>
    <input type="submit" name="btsubmit" value="SUCHEN">
    <!-- <button name="btsubmit">Suchen</button> -->
</form>
</body>
</html>
