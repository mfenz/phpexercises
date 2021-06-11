<?php
// Datei model/tankbeleg.inc.php

require_once 'user.inc.php';

class Tankbeleg {
    private int $id;
    private User $user;
    private float $km;
    private float $liter;
    private float $betrag;
    private DateTime $zeitpunkt;

    function __construct(int $id, User $user, float $km, float $liter,
        float $betrag, DateTime $zeitpunkt)
    {
        $this->id = $id;
        $this->user = $user;
        $this->km = $km;
        $this->liter = $liter;
        $this->betrag = $betrag;
        $this->zeitpunkt = $zeitpunkt;
    }

    function getId() : int {
        return $this->id;
    }
    function getUser() : User {
        return $this->user;
    }
    function getKm() : float {
        return $this->km;
    }
    function getLiter() : float {
        return $this->liter;
    }
    function getBetrag() : float {
        return $this->betrag;
    }
    function getZeitpunkt() : DateTime {
        return $this->zeitpunkt;
    }
}

?>