<?php
// Klasse Gaestebucheintrag inkludieren
require_once 'gaestebucheintrag.inc.php';

// Verwaltet Gästebucheintrage
// Schreibt Gästebucheinträge in die Datenbank
// Liest Gästebucheinträge aus der Datenbank
// --> GästebuchEintragManager greift auf die Datenbank zu
class GaestebuchEintragManager {
    // Eigenschaften
    private PDO $connection;

    // Konstruktor
    // Über den Konstruktor die Connection übergeben
    function __construct(PDO $conn)
    {
        // Übergabeparameter auf Eigenschaft zuweisen
        $this->connection = $conn;
    }

    // Funktion (gehört dann zum Objekt der Klasse)
    // Funktionen die innerhalb einer Klasse geschrieben werden
    // nennt man auch Methoden
    // Fügt einen Gästebucheintrag in die Datenbank ein
    // $name, $email, und $text sind Übergabaparamter dieser Methode
    function addGaestebuchEintrag(string $name, string $email, string $text) : int {
        // $this->connection bezieht sich auf die Eigenschaft $connection
        // ->  ist der Object Operator, damit kann auf Inhalte eines Objekts
        // wie z. B. Eigenschaften oder Methoden zugegriffen werden
        $ps = $this->connection->prepare('INSERT INTO gaestebucheintrag 
                                        (name, email, text) 
                                        VALUES 
                                        (:name, :email, :text) ');
        // Für die Platzhalter Werte einsetzen
        $ps->bindValue('name', $name);
        // für den Platzhalter :email den Wert der Variable $email einsetzen
        $ps->bindValue('email', $email);
        $ps->bindValue('text', $text);

        // SQL Statement ausführen
        $ps->execute();

        // ID des neuen Gästebucheintrags herausfinden
        $id = $this->connection->lastInsertId();


        $to = "empfaenger@example.com";
        $subject = "My subject";
        $txt = "Neuer Gästebucheintrag von $name! $text";
        $headers = "From: webmaster@example.com" . "\r\n" .
        "CC: jemand@example.com";

        mail($to,$subject,$txt,$headers);


        // ID zurückgeben
        return $id;
    }

    // Liest alle Gästebucheinträge aus der Datenbank aus
    function getGaestebucheintraege(){
        // Selektiert alle Datensätze der Tabelle gaestebucheintrag
        // Nur die Anfrage schreiben (jedoch noch nicht abschicken!!)
        $ps = $this->connection->prepare('SELECT * FROM gaestebucheintrag ');
        // SQL Query ausführen
        $ps->execute();
        
        // In dieses Array alle gefundenen Gästebucheinträge einfügen
        $result = [];
        
        // mit Hilfe einer Schleife jeden gefundenen Datensatz anschauen
        // fetch() holt einen einzelnen Datensatz aus dem Resultat der 
        // SQL-Anfrage heraus (eine Zeile aus dem Ergebnis)
        while($row = $ps->fetch()){
            // $row['id'] <-- bezieht sich auf id-Spalte des Datensatzes
            $id = $row['id'];
            // $row['datum'] wird von der createFromFormat Methode geparst
            // createFromFormat analysiert den gegebenen String und wandelt
            // diesen in ein DateTime Objekt um
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $row['datum']);
            $name = $row['name'];
            $email = $row['email'];
            $text = $row['text'];

            // Objekt der Klasse Gaestebucheintrag erstellen
            // new Schlüsselwort: um ein neues Objekt einer Klasse zu erstellen
            // Objekt mit den Werten befüllen die wir uns gerade aus der 
            // Datenbank geholt haben
            $eintrag = new Gaestebucheintrag($id, $datum, $name, $email, $text);

            // Objekt in das Array speichern
            // fügt in das Array $result das Objekt unter $eintrag ein
            $result[] = $eintrag;
        }

        // Rückgabe des Arrays mit allen Objekten (Gästebucheinträge)
        return $result;
    }

}
?>