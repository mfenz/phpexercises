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
$i x $eingabe = $i * $eingabe
1 x 1 = 1
2 x 1 = 2
...
9 x 1 = 9
10 x 1 = 10

*/
// Auslesen von http://localhost/?zahl=7
$eingabe = $_GET['zahl'];

for($i = 1; $i <= 10; $i++){
    // Für jedes neue $i das Ergebnis berechnen
    $ergebnis = $i * $eingabe;
    // Ausgabe
    echo "<p>$i x $eingabe = $ergebnis</p>";
}

?>
</body>
</html>
