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
/*
1 x 2 = 2 = 2
2 x 2 = 2 + 2 = 4
3 x 2 = 2 + 2 + 2 = 6
4 x 2 = 2 + 2 + 2 + 2 = 8
5 x 2 = 2 + 2 + 2 + 2 + 2 = 10
6 x 2 = 2 + 2 + 2 + 2 + 2 + 2 = 12
7 x 2 = 2 + 2 + 2 + 2 + 2 + 2 + 2 = 14
8 x 2 = 2 + 2 + 2 + 2 + 2 + 2 + 2 + 2 = 16
9 x 2 = 2 + 2 + 2 + 2 + 2 + 2 + 2 + 2 + 2 = 18
10 x 2 = 2 + 2 + 2 + 2 + 2 + 2 + 2 + 2 + 2 + 2 = 20
*/

// Fehlermeldung ausgeben wenn $_GET['zahl'] nicht gesetzt wurde
// isset <-- prüft ob die Variable existiert (und initialisiert wurde)
if(!isset($_GET['zahl'])){
    echo "<p><strong>ZAHL ANGEBEN!!!</strong></p>";
    // Script mit return beenden
    return;
}
// Hier muss $_GET['zahl'] vorhanden sein
// denn return; im if hätte Script ansonsten beendet
$eingabe = $_GET['zahl'];
for($i = 1; $i <= 10; $i++){
    $ergebnis = $i * $eingabe;

    // Rechenweg 
    $rechenweg = "";
    for($j = 1; $j <= $i; $j++){
        $rechenweg .= "$eingabe ";
        // solange wir nicht beim letzten Schleifendurchgang sind
        // plus hinzufügen
        if($i != $j){
            $rechenweg .= '+ ';
        }
    }

    echo "<p>$i x $eingabe = $rechenweg = $ergebnis </p>";
}
?>
</body>
</html>
