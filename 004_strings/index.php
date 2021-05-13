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
// Dateiendung bestimmen
// img_43234.jpg --> jpg
// Brief.docx --> docx
//$file = 'img_43234.jpg';

// ?name=<script>alert("Angriff"); window.location="https://google.at"</script>
// Dateiname über GET-Parameter initialisieren
$file = $_GET['name'];

echo "<p>Sie haben $file eingegeben.</p>";

// suche in $file nach .
$punktIndex = strpos($file, '.');
// gefunden?
if($punktIndex === false){
    echo '<p>Dateiendung konnte nicht bestimmt werden.</p>';
} else {
    // substr($text, alleZeichenAbDemIndex)
    $dateiendung = substr($file, $punktIndex + 1);
    echo "<p>Die Dateiendung von $file ist $dateiendung</p>";
    $anzZeichenDateiname = strlen($file);
    echo "<p>Der Dateiname ist $anzZeichenDateiname Zeichen lang.</p>";
    // substr($text, startIndex, länge) 
    $dateinameOhneEndung = substr($file, 0, $punktIndex);
    echo "<p>Dateiname ohne Endung ist $dateinameOhneEndung</p>";
    $anzZeichenDateinameOhneEndung = strlen($dateinameOhneEndung);
    echo "<p>$dateinameOhneEndung besteht 
            aus $anzZeichenDateinameOhneEndung Zeichen.</p>";
    // ersten und letzten Buchstaben des Dateinamens bestimmen
    // der erste Buchstabe hat den Index 0
    $ersterBuchstabe = $file[0];
    // letzte Buchstabe hat den Index (Länge des Strings) - 1 
    // weil Index bei 0 beginnt
    $letzterBuchstabe = $file[strlen($file) - 1]; 
    echo "<p>Der Dateiname beginnt mit $ersterBuchstabe und 
            endet mit $letzterBuchstabe</p>";
    // Strings mit Punkt-Operator verknüpfen
    // mit strtoupper($str) den angegebenen String in Großbuchstaben umwandeln
    echo "<p>Der Dateiname in Großbuchstaben:" . strtoupper($file) . "</p>";
}

?>
</body>
</html>
