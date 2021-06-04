<?php
// Datei manager/usermanager.inc.php

// User-Klasse inkludieren
require_once __DIR__.'/../model/user.inc.php';

class UserManager {
    // Eigenschaft
    private PDO $connection;

    // Konstruktor (1 Parameter)
    function __construct(PDO $conn)
    {
        $this->connection = $conn;
    }

    function addUser(string $email, string $passwort) : int{

        // Generiert es aus dem eingegebenen Passwort einen Hashwert
        $pwHash = password_hash($passwort, PASSWORD_DEFAULT);

        // Prepared statement
        $ps = $this->connection->prepare(
            'INSERT INTO user 
            (email, passwort, beschreibung, foto_dateiname) 
            VALUES 
            (:email, :passwort, :beschreibung, :fotoDateiname)');

        // Named Parameter mit Wert ersetzen
        $ps->bindValue('passwort', $pwHash);
        $ps->bindValue('email', $email);
        $ps->bindValue('beschreibung', '');
        $ps->bindValue('fotoDateiname', '');

        // SQL Statement ausführen
        $ps->execute();

        // ID des neuen Datensatzes zurückgeben
        return $this->connection->lastInsertId();
    }

    /**
     * Sucht den User anhand der übergebenen ID
     * Gibt den User zurück falls er gefunden wurde, ansonsten false
     */
    function getUserById(int $id){
        $ps = $this->connection->prepare(
            'SELECT * 
            FROM user 
            WHERE id = :id');
        $ps->bindValue('id', $id);
        $ps->execute();

        // Prüfen ob ein Datensatz gefunden wurde
        // fetch() geht von einem Datensatz zum Nächsten
        if($row = $ps->fetch()){
            $id = $row['id'];
            $email = $row['email'];
            $passwort = $row['passwort'];
            $beschreibung = $row['beschreibung'];
            $fotoDateiname = $row['foto_dateiname'];
            // Beende die Methode und gebe ein Objekt der Klasse User zurück
            return new User($id, $email, $passwort, $beschreibung, $fotoDateiname);
        }

        // Kein Datensatz wurde gefunden
        return false;
    }

    /**
     * Sucht den User anhand der übergebenen E-Mail Adresse
     * Gibt den User zurück falls er gefunden wurde, ansonsten false
     */
    function getUserByEmail(string $email){
        // Prepared Statement erstellen
        $ps = $this->connection->prepare(
            'SELECT * 
            FROM user 
            WHERE email = :email ');
        // Named Parameter mit Wert ersetzen
        $ps->bindValue('email', $email);
        // SQL Query an DB senden und ausführen
        $ps->execute();

        // Prüfen ob ein Datensatz gefunden wurde
        // fetch() geht von einem Datensatz zum Nächsten
        if($row = $ps->fetch()){
            $id = $row['id'];
            $email = $row['email'];
            $passwort = $row['passwort'];
            $beschreibung = $row['beschreibung'];
            $fotoDateiname = $row['foto_dateiname'];
            // Beende die Methode und gebe ein Objekt der Klasse User zurück
            return new User($id, $email, $passwort, $beschreibung, $fotoDateiname);
        }

        // Kein Datensatz wurde gefunden
        return false;
    }

    /**
     * Meldet einen User am System an
     * Gibt true zurück wenn Login erfolgreich war, ansonsten false
     */
    function login(string $email, string $passwort){
        // User anhand der E-Mail Adresse in DB suchen
        $user = $this->getUserByEmail($email);
        // Wenn User gefunden
        if($user !== false){
            // Passwort prüfen
            $passwortOK = $user->isPasswort($passwort);

            // Wenn Passwort korrekt ist --> anmelden
            if($passwortOK){
                // User in der Session speichern
                $_SESSION['loggedin'] = true;
                $_SESSION['userid'] = $user->getId();
                return true;
            }
        }
        // Wenn User nicht gefunden, oder Passwort falsch --> Fehler
        return false;
    }

    function updateUser(User $user){
        $ps = $this->connection->prepare(
            'UPDATE user 
            SET beschreibung = :beschreibung, 
            foto_dateiname = :fotoDateiname 
            WHERE id = :id ');
        $ps->bindValue('beschreibung', $user->getBeschreibung());
        $ps->bindValue('fotoDateiname', $user->getFotoDateiname());
        $ps->bindValue('id', $user->getID());
        $ps->execute();
    }

}
?>