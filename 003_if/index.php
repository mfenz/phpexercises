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
    <h1>Zahlenbereiche</h1>
    <h2>Mit if-Verzweigungen</h2>
<?php
$zahl = 10;
if($zahl >= 1 && $zahl <= 5) {
    echo 'Die Zahl ist 1, 2, 3, 4, oder 5.';
} elseif($zahl >= 6 && $zahl <= 10) {
    echo 'Die Zahl ist 6, 7, 8, 9, oder 10.';
    if($zahl == 10){
        echo ' Jackpot!';
    }
} elseif($zahl == 0){
    echo 'Die Zahl darf nicht 0 sein.';
} else {
    // Alle anderen Zahlen
    echo 'Die Zahl ist zu groß oder zu klein.';
}
?>
<h2>Mit switch case</h2>
<?php
switch($zahl) {
    case 0:
        echo 'Die Zahl darf nicht 0 sein.';
        break;
    case 1:
    case 2:
    case 3:
    case 4:
    case 5: 
        echo 'Die Zahl ist 1, 2, 3, 4, oder 5.';
        break;
    case 6:
    case 7:
    case 8:
    case 9: 
        echo 'Die Zahl ist 6, 7, 8, 9, oder 10.';
        break;
    case 10:
        echo 'Die Zahl ist 6, 7, 8, 9, oder 10. ';
        echo 'Jackpot!';
        break;
    default:
        echo 'Die Zahl ist zu groß oder zu klein.';
        break;
}
?>
</body>
</html>
