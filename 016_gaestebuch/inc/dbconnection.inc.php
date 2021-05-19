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