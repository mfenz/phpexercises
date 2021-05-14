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
// [] <-- erstellt ein leeres Array
// ['a', 'b', 'c'] <-- erstellt ein Array mit Werten
$produkte = ['Banana', 'Apfel', 'Orange', 'Mango'];
// $produkte[] = wert; // fügt ein neues Element im Array ein
$produkte[] = 'Ananas';
// Alle Produkte mit Beistrich getrennt ausgeben
// count($array) <-- wie viele Elemente sind im Array?
echo "<p>Wir haben im Angebot: ";
for($i = 0; $i < count($produkte); $i++) {
    // Alle Produkte ausgeben lassen
    // $arrayname[$index] für den Zugriff auf einzelnes Element
    echo $produkte[$i];
    // wenn ich nicht beim letzten Element bin, Beistrich ausgeben
    if($i != count($produkte) - 1){
        echo ', ';
    }
}
echo "</p>";

// Nur Produkte anzeigen die mit 'a' anfangen oder enden
echo "<p>Welche Produkte mit 'a' gibt es? ";
$ausgabeA = '';
for($i = 0; $i < count($produkte); $i++){
    // Produktname aus Array holen
    $name = $produkte[$i];
    // Beginnt oder endet der Namit mit groß- oder klein a
    // strcasecmp($a, $b) <-- vergleicht ob $a und $ gleich sind
    // (Groß- und Kleinschreibung ist dabei egal)
    // IF-Variante 1
    if(strcasecmp($name[0], 'a') == 0 
        || strcasecmp($name[strlen($name) -1], 'a') == 0)
    {

    }

    // If-Variante 2
    if($name[0] == 'a' || $name[0] == 'A' 
        || $name[strlen($name)-1 ] == 'a' 
        || $name[strlen($name) - 1] == 'A')
    {
        // Prüfen ob bereits zuvor ein Produkt mit a gefunden wurde
        if(strlen($ausgabeA) > 0){
            // Beistrich zu Ausgabe hinzufügen
            $ausgabeA .= ', ';
        }
        // Produktname zu Ausgabe hinzufügen
        $ausgabeA .= $name;
    }
}
// Produkte ausgeben
echo $ausgabeA;
echo "</p>";

?>
</body>
</html>
