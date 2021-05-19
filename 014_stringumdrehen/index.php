<?php
// $text ist der Übergabeparameter
// : string  <-- Diese Funktion darf nur einen Wert vom
// Datentyp string zurückgeben
function reverseString($text) : string { 
    $result = '';
    // strlen <-- Zählt die Anzahl der Zeichen im string
    for($i = strlen($text) - 1; $i >= 0; $i--){
        // Einzelnes Zeichen aus $text holen,
        // an $result hinten drannhängen
        // $result = $result . $text[$i];
        $result .= $text[$i];
    }
    return $result;
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
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
    $reverse = reverseString($_POST['text']);
    // Hello World --> dlroW olleH
    echo htmlspecialchars($_POST['text']) . " --> " . htmlspecialchars($reverse);
}
?>
<form action="index.php" method="post">
    <label>Text</label><br/>
    <input type="text" name="text"><br/>
    <button name="btsubmit">Text umdrehen</button>
</form>
</body>
</html>
