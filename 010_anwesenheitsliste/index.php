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
<h1>Anwesenheitsliste</h1>
<?php
// Schauen ob Formular abgesendet wurde
if(isset($_POST['btsubmit'])){
    // Werte aus Formular einlesen
    $name = $_POST['name'];
    $email = $_POST['email'];

    // fopen($filename, $mode) <-- öffnet eine Datei
    // $filename <-- Pfad zu einer Datei
    // $mode <-- Option, wie auf die Datei zugegriffen werden darf
    // $mode 'a' <-- append
    $filepointer = fopen('anwesenheit.csv', 'a');

    // Prüfen ob Datei geöffnet werden konnte
    if($filepointer) {
        // Datei erfolgreich geöffnet
        // Neuen Eintrag in die Datei schreiben

        // Zeile als CSV-Datei
        // \n <-- Zeilenumbruch in der Datei
        $zeile = "$name;$email;\n";

        // fputs schreibt etwas in die Datei
        fputs($filepointer, $zeile);

        // Zum Schluss IMMER!!! den Filepointer schließen.
        fclose($filepointer);

        echo '<div class="success">';
        echo "\"$name\" wurde erfolgreich eingetragen.";
        echo '</div>';
    } else {
        // Fehler beim Öffnen der DAtei
        echo "Auf die Datei konnte nicht zugegriffen werden.";
        // Script beenden
        exit("Fehler beim Zugriff auf die Datei.");
    }
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
// fopen($fname, $mode)
// $mode 'r' <-- read only
$filepointer = fopen('anwesenheit.csv', 'r');
if($filepointer){

    ?>
    <table>
    <?php
    
    // Datei Zeile für Zeile einlesen
    // fgets <-- liest eine Zeile der Datei ein
    // fgets <-- geht mit jedem Aufruf eine Zeile weiter
    // $line <-- Inhalt der eingelesenen Zeile
    while(($line = fgets($filepointer)) !== false) {
        // CSV Einträge aufteilen (; ist das Trennzeichen)
        // explode <-- teilt den String anhand des Trennzeichens auf
        // explode gibt ein Array zurück
        $csv = explode(';', $line);
        $name = $csv[0];
        $email = $csv[1];
        echo "<tr>";
        // htmlspecialchars($name) <-- wandelt spezielle HTML-Zeichen um
        // gegen unbefugten USER-Input
        echo "<td>" . htmlspecialchars($name) ."</td>";
        echo "<td>" . htmlspecialchars($email) . "</td>";
        echo "</tr>";
    }
    ?>
    </table>
    <?php

} else {
    exit("File konnte nicht geöffnet werden.");
}
?>
</body>
</html>
