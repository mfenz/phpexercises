<?php

// Verbindet sich mit der Datenbank
// : PDO (Einschränkung des Rückgabedatentyps auf PDO)
function connect() : PDO {
    try {
        // Hier schreiben was möglicherweise einen Fehler 
        // auslösen könnte (z. B. ein falsches Passwort)
    
        // Datenbankverbindung aufbauen
        $host = "localhost";
        $dbName = "bfi";
        $user = "root";
        $password = "";
    
        $connection = new PDO("mysql:dbname=$dbName; host=$host", 
                                $user, $password);
        return $connection;
    
    } catch (PDOException $e) { 
        // catch-Block
        // catch() <-- in den runden Klammern den Fehlertyp angeben
        // auf den reagiert werden soll
    
        // Im Fehlerfall: Script beenden, Fehlermeldung ausgeben lassen
        exit($e->getMessage());
    }
}

// Funktion zur Datenbankverbindung aufrufen
// $connection ist eine PDO Connection
$connection = connect();

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

// Leeres Array, hier die Fehler reinspeichern falls es welche gibt
// im Bezug auf falsche User-Eingaben
$error = [];

// User-Eingabe überprüfen
if(isset($_POST['btsubmit'])) {
    if(strlen($_POST['name']) == 0){
        // Fehler! Name leer
        $error['name'] = "Name eingeben.";
    }
    if(strlen($_POST['email']) == 0){
        $error['email'] = "Email eingeben.";
    }
}

// wenn btsubmit vorhanden ist, und error-Array keine Einträge hat
// Daten in Datenbank speichern
if(isset($_POST['btsubmit']) && count($error) == 0){

    // Prepared Statement
    // Prepared statements haben Platzhalter (:name, :email)
    $ps = $connection->prepare("INSERT INTO anwesenheit 
                                (name, email) VALUES (:name, :email) ");
    // Platzhalter :name
    $ps->bindValue('name', $_POST['name']);
    // Platzhalter :email
    $ps->bindValue('email', $_POST['email']);

    // Query ausführen
    $ps->execute();
    echo "<div class=\"success\">Der Eintrag wurde 
                                erfolgreich hinzugefügt</div>";
} 

// Falls es Fehler gibt, diese hier anzeigen
if(count($error) > 0){
    echo '<div class="error">';
    // foreach($arrayname as $key => $value) {  }
    foreach($error as $key => $value) {
        echo "<p>$value</p>";
    }
    echo '</div>';
}

?>
<h2>Neue Anwesenheit eintragen</h2>
<!-- action: wo das Formular hingeschickt werden soll -->
<form action="index.php" method="post">
    <div>
        <label>Name der Person</label><br/>
        <input type="text" name="name">
    </div>
    <div>
        <label>Email</label><br/>
        <input type="text" name="email">
    </div>
    <input type="submit" name="btsubmit" value="Eintragen">
</form>
<h2>Anwesende Personen</h2>
<?php
// Alle bereits eingetragenen Personen anzeigen
$ps = $connection->prepare('SELECT * FROM anwesenheit ');
// Ausführen
$ps->execute();
// In einer Schleife alle gefundenen Datensätze ausgeben lassen
// fetch() liefert einen Datensatz 
// über $row kann auf den Datensatz zugegriffen werden
while($row = $ps->fetch()){
    $id = $row['id'];
    //          Y-m-d H:i:s
    // Datum 	2021-05-19 13:10:43
    $datum = DateTime::createFromFormat("Y-m-d H:i:s", $row['datum']);
    $name = $row['name'];
    $email = $row['email'];

    // Die Anwesenheit von <Name> (<Email>) wurde um <Datum> erfasst (ID=<ID>)
    echo "<p>Die Anwesenheit von ";
    echo htmlspecialchars($name);
    echo " (";
    echo htmlspecialchars($email);
    echo ") wurde um ";
    echo $datum->format('d.m.y H:i:s'); // dd.mm.yyyy hh::mm:ss
    echo "(ID=$id)";
    echo "</p>";
}
?>
</body>
</html>
