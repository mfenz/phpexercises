<?php
// Prüft ob das übergebene Jahr ein Schaltjahr ist
// Return true wenn Schaltjahr; ansonsten false
function istSchaltjahr($jahr){
    /*
    Ist die Jahreszahl durch vier teilbar, aber nicht durch 100, 
    ist es ein Schaltjahr. 2008 fällt unter diese Regel.
    Ist die Jahreszahl durch 100 teilbar, aber nicht durch 400, 
    ist es kein Schaltjahr. 2100 wird kein Schaltjahr sein.
    Ist die Jahreszahl durch 400 teilbar, 
    dann ist es ein Schaltjahr. Deshalb war das Jahr 2000 ein Schaltjahr.
    */
    // durch 4 teilbar, aber nicht durch 100
    if($jahr % 4 == 0 && $jahr % 100 != 0){
        return true;
    }
    // durch 100 teilbar, aber nicht durch 400
    if($jahr % 100 == 0 && $jahr % 400 != 0){
        return false;
    }
    // durch 400 teilbar
    if($jahr % 400 == 0){
        return true;
    }
    return false;
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
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jahr'])) {
    // Prüfen ob Eingabe nur aus Zahlen besteht
    // ctype_digit(str) prüft ob die Eingabe nur aus Ziffern besteht
    if(ctype_digit($_POST['jahr'])) {
        // wenn die Eingabe nur aus Zahlen besteht, prüfen ob Schaltjahr?
        echo htmlspecialchars($_POST['jahr']). ' ';
        if(istSchaltjahr($_POST['jahr'])){
            echo  'ist ein Schaltjahr<br/>';
        } else {
            echo 'ist kein Schaltjahr';
        }
    } else {
        echo "<p>Bitte nur Zahlen eingeben!</p>";
    }
}
?>
<form action="index.php" method="post">
    <label>Jahr</label><br/>
    <input type="text" name="jahr"><br/>
    <button name="btsubmit">Schaltjahr?</button>
</form>
</body>
</html>
