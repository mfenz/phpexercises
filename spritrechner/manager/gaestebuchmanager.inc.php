<?php
// Datei manager/gaestebuchmanager.inc.php

// Gaestebucheintrag-Klasse inkludieren
require_once __DIR__.'/../model/gaestebucheintrag.inc.php';

class GaestebuchManager {
    private PDO $connection;

    function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    function addGaestebucheintrag($name, $email, $text) : int {
        $ps = $this->connection->prepare(
            'INSERT INTO gaestebucheintrag 
            (name, email, text) 
            VALUES 
            (:name, :email, :text) ');
        
        // Named Parameter ersetzen
        $ps->bindValue('name', $name);
        $ps->bindValue('email', $email);
        $ps->bindValue('text', $text);

        // Statement auf der Datenbank ausführen
        $ps->execute();

        // ID des neuen Datensatzes zurückgeben
        return $this->connection->lastInsertId();
    }

    function getGaestebucheintraege() : array {
        $ps = $this->connection->prepare(
            'SELECT * 
            FROM gaestebucheintrag ');
        $ps->execute();

        $results = [];
        while($row = $ps->fetch()){
            $id = $row['id'];
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $row['datum']);
            $name = $row['name'];
            $email = $row['email'];
            $text = $row['text'];

            $results[] = new Gaestebucheintrag($id, $datum, $name, $email, $text);
        }

        // Array von Objekten der Klasse Gaestebucheintrag zurückgeben
        return $results;
    }
}

?>