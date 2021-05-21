<?php
// Modellierung eines einzelnen Gästebucheintrags
// --> woraus ein einzelner Gästebucheintrag besteht
// Dazu wird eine Klasse erstellt (Klasse ist sowas wie ein Bauplan)
// --> Bauplan für einen einzelnen Gästebucheintrag

// class Klassenname { INHALT DER KLASSE }
class GaestebuchEintrag {
    // Eigenschaften der Klasse GaestebuchEintrag
    private int $id; 
    private DateTime $datum;
    private string $name;
    private string $email;
    private string $text;

    // Konstruktor: dient zur Initialisierung der Eigenschaften
    // wird aufgerufen wenn ein Objekt der Klasse GaestebuchEintrag
    // erzeugt wird
    function __construct(int $id, DateTime $datum, string $name, 
                        string $email, string $text)
    {
        // Zuweisung der Übergabeparameter auf die Eigenschaften
        $this->id = $id;
        $this->datum = $datum;
        $this->name = $name;
        $this->email = $email;
        $this->text = $text;
    }

    // Angabe ohne private, public, protected --> automatisch public
    // public: von jeder Klasse aus (von überall aus) sichtbar und zugreifebar
    // Diese Methode getId() ist public! Von überall aus sichtbar
    function getId() : int {
        // Rückgabe der private-Eigenschaft ID
        // Über Getter-Methoden kann auf private-Eigenschaften zugegriffen
        // werden
        return $this->id;
    }

    function getDatum() : DateTime {
        return $this->datum;
    }

    function getName() : string {
        return $this->name;
    }

    function getEmail() : string {
        return $this->email;
    }

    function getText() : string {
        return $this->text;
    }
}
?>