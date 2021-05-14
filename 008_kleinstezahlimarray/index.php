<?php  
// Funktion: findeMinInArray
// Parameter: $zahlen (Array von Zahlen)
// Funktionen werden mit Schlüsselwort function definiert
function findeMinInArray($zahlen) {
    // kleinste mit erstem Element im Array initialisieren
    $kleinste = $zahlen[0];
    // Jedes Array-Element, der Reihe nach, durchschauen
    for($i = 0; $i < count($zahlen); $i++) {
        // Prüfen ob Array-Element kleiner ist als bisher kleinste Zahl
        if($zahlen[$i] < $kleinste) {
            // Zahl ersetzen
            // $variable = wert;
            $kleinste = $zahlen[$i];
        }
    }
    // Am Ende der for-Schleife ist die kleinste Zahl bekannt

    // kleinste Zahl zurückgeben
    // return beendet die Funktion
    // und gibt den Wert der Variable $kleinste zurück
    return $kleinste;
}

// Beispiel-Ausgabe
// Die kleinste Zahl im Array [70, 73, 15, 7, 80] ist 7. 
function printMinInArray($zahlen){
    echo "<p>Die kleinste Zahl im Array [";
    // Alle Zahlen ausgeben
    for($i = 0; $i < count($zahlen); $i++){
        // Einzelne Zahl ausgeben
        echo $zahlen[$i];
        // Wenn wir NICHT beim letzten Array-Index sind, Beistrich ausgeben
        if($i != count($zahlen) - 1){
            echo ', ';
        }
    }
    echo "] ist ";
    // Funktion findeMinInArray aufrufen
    // Diese liefert als Rückgabewert die kleinste Zahl im übergebenen Array
    // Direkte Ausgabe vom Ergebnis der Funktion
    // Aufruf der Funktion: functionsName($parameter);
    echo findeMinInArray($zahlen);
    echo "</p>";
}
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
$zahlen1 = [70, 73, 15, 7, 80];
// Die kleinste Zahl im Array [70, 73, 15, 7, 80] ist 7. 
// Funktion aufrufen, Zahlen-Array übergeben
// $zahlen1 <-- Argument 
printMinInArray($zahlen1);

$zahlen2 = [534, 34, 1523455, 937, 16];
printMinInArray($zahlen2);

$zahlen3 = [563, 12, 43, 9737, 1623];
printMinInArray($zahlen3);
?>
</body>
</html>
