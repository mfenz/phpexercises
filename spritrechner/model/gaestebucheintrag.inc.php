<?php
// Datei model/gaestebucheintrag.inc.php

class Gaestebucheintrag {
    // Eigenschaften
    private int $id;
    private DateTime $datum;
    private string $name;
    private string $email;
    private string $text;

    // Konstruktor
    function __construct(int $id, DateTime $datum, string $name, string $email, string $text)
    {
        $this->id = $id;
        $this->datum = $datum;
        $this->name = $name;
        $this->email = $email;
        $this->text = $text;
    }

    // Getter-Methoden
    public function getId(){
        return $this->id;
    }

    public function getDatum(){
        return $this->datum;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getText(){
        return $this->text;
    }
}

?>