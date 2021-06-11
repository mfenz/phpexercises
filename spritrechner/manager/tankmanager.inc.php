<?php
// manager/tankmanager.inc.php

// Tankbeleg-Klasse inkludieren
require_once __DIR__.'/../model/tankbeleg.inc.php';

class TankManager {
    
    private PDO $connection;

    function __construct(PDO $conn)
    {
        $this->connection = $conn;
    }

    // Tankbeleg in DB speichern
    function addTankbeleg(int $userId, float $km, float $liter, 
        float $betrag, DateTime $zeitpunkt) : int {
        $ps = $this->connection->prepare(
            'INSERT INTO tankbeleg 
            (userid, km, liter, betrag, datum) 
            VALUES 
            (:userid, :km, :liter, :betrag, :datum) ');
        $ps->bindValue('userid', $userId);
        $ps->bindValue('km', $km);
        $ps->bindValue('liter', $liter);
        $ps->bindValue('betrag', $betrag);
        $ps->bindValue('datum', $zeitpunkt->format('Y-m-d H:i:s'));

        $ps->execute();
        
        return $this->connection->lastInsertId();
    }

    // Alle Tankbelege für einen User aus DB laden
    function getTankbelegeByUserId(int $userId){
        $ps = $this->connection->prepare(
            'SELECT t.id AS tId, t.userid AS tUserId, 
            t.km AS tKm, t.liter AS tLiter, t.betrag AS tBetrag, 
            t.datum AS tDatum, 
            u.id AS uID, u.email AS uEmail, u.passwort AS uPasswort,
            u.beschreibung AS uBeschreibung, 
            u.foto_dateiname AS uFotoDateiname
            FROM tankbeleg t
            INNER JOIN user u ON(t.userid = u.id)
            WHERE userid = :userid ');

        $ps->bindValue('userid', $userId);
        $ps->execute();

        $results = [];
        while($row = $ps->fetch()){
            // Datensätze einlesen und Objekte erstellen

            // zuerst ein User-Objekt erzeugen (weil ein Tankbeleg)
            // ein Objekt der Klasse User benötigt
            $user = new User($row['uID'], $row['uEmail'], 
                $row['uPasswort'], $row['uBeschreibung'], 
                $row['uFotoDateiname']);

            // Tankbeleg-Objekt erzeugen
            $tankbeleg = new Tankbeleg($row['tId'], $user, 
                    $row['tKm'], $row['tLiter'], $row['tBetrag'], 
                    DateTime::createFromFormat('Y-m-d H:i:s', $row['tDatum']));

            // Tankbeleg zum Results-Array hinzufügen
            $results[] = $tankbeleg;
        }
        return $results;
    }
}

?>