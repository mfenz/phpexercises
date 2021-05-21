<?php
// Bei jedem Aufruf eine DB-Verbindung aufbauen
require_once 'inc/dbconnection.inc.php';
require_once 'inc/gaestebucheintragmanager.inc.php';

// Objekt der Klasse GaestebuchEintragManager erstellen
// new GaestebuchEintragManager($conn) <-- erstellt ein Objekt
// new ist das Schlüsselwort um ein Objekt zu erstellen
$eintragManager = new GaestebuchEintragManager($connection);


// Errors-Array (alle Fehler darin speichern)
$errors = [];
if(isset($_POST['btsubmit'])){
    // strlen: Anzahl der Zeichen im String (Länge)
    // trim: löscht alle Leerzeichen am Anfang und Endes
    // des Strings weg
    if(strlen(trim($_POST['name'])) == 0){
        $errors['name'] = 'Bitte einen Namen eingeben.';
    }
    if(strlen(trim($_POST['email'])) == 0){
        $errors['email'] = 'Bitte eine E-Mail Adresse eingeben.';
    }
    if(strlen(trim($_POST['text'])) == 0){
        $errors['text'] = 'Bitte einen Text eingeben.';
    }

    // Wenn User alle Werte eingegeben hat --> Daten speichern
    if(count($errors) == 0){
        // Gästebucheintrag in die Datenbank einfügen

        
        // Mit dem Object-Operator (->) auf das Objekt zugreifen
        // Auf die Methode addGaestebuchEintrag zugreifen (aufrufen)
        $id = $eintragManager->addGaestebuchEintrag($_POST['name'], 
                                            $_POST['email'], 
                                            $_POST['text']);
        // Leitet den User auf die gegebene Location weiter
        // Führt damit einen Redirect durch
        header("Location: ./index.php?inserted=$id");
    }
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
<h2>Im Gästebuch eintragen</h2>
<?php
// Fehlermeldungen ausgeben (falls vorhanden)
// prüfen ob Fehler vorhanden sind (falls ja: div Container erstellen)
if(count($errors) > 0) {
    // div Container für Fehler ausgeben
    echo '<div class="error">';
    // Assoziatives $errors Array mit foreach-Schleife durchlaufen
    foreach($errors as $key => $value) {
        // in einem <p> die Fehlermeldung ausgeben lassen
        echo "<p>$value</p>";
    }
    echo '</div>';
}
// Prüfen ob der GET-Parameter inserted gesetzt ist
// falls ja: Meldung ausgeben, dass GB-Eintrag erfolgreich durchgeführt wurde
if(isset($_GET['inserted'])){
    echo '<div class="success">';
    echo "<p>Gästebucheintrag erfolgreich erhalten.</p>";
    echo '</div>';
}
?>
<!-- action: wo das Formular hingeschickt werden soll -->
<form action="index.php" method="post">
    <div>
        <label>Name</label><br/>
        <input type="text" name="name">
    </div>
    <div>
        <label>Email</label><br/>
        <input type="text" name="email">
    </div>
    <div>
        <label>Text</label><br/>
        <textarea name="text" rows="10"></textarea>
    </div>
    <input type="submit" name="btsubmit" value="Eintragen">
</form>
<h1>Gästebucheinträge</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Datum</th>
            <th>Namen</th>
            <th>Email</th>
            <th>Text</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // In einer Schleife alle Gästebucheinträge ausgeben lassen

        // Alle bisherigen Gästebucheinträge aus der Datenbank holen
        // getGaestebucheintraege() <-- liefert ein Array von Objekten
        // der Klasse GaestebuchEintrag zurück
        $eintraege = $eintragManager->getGaestebucheintraege();

        // $value <-- jeder einzelne Gästebucheintrag
        // $value ist hier ein Objekt der Klasse Gaestebucheintrag
        // über Getter-Methoden auf die private-Eigenschaften des Objekts zugreifen
        foreach($eintraege as $key => $value){
            echo '<tr>';
            echo '<td>' . htmlspecialchars($value->getId()) . '</td>';
            echo '<td>' . htmlspecialchars($value->getDatum()->format('d.m.Y H:i:s')) . '</td>';
            echo '<td>' . htmlspecialchars($value->getName()) . '</td>';
            echo '<td>' . htmlspecialchars($value->getEmail()) . '</td>';
            echo '<td>' . htmlspecialchars($value->getText()) . '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
</body>
</html>
