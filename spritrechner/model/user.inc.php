<?php
class User {
    // User (ID, EmailUK, Passwort, Beschreibung, FotoDateiname)

    // Eigenschaften
    private int $id;
    private string $email;
    private string $passwort;
    private string $beschreibung;
    private string $fotoDateiname;

    // Konstruktor
    function __construct($id, $email, $passwort, $beschreibung, $foto)
    {
        $this->id = $id;
        $this->email = $email;
        $this->passwort = $passwort;
        $this->beschreibung = $beschreibung;
        $this->fotoDateiname = $foto;
    }

    /**
     * Prüft ob das vom User eingegebene Passwort ($loginPasswort)
     * dem Passwort des Users entspricht
     */
    function isPasswort(string $loginPasswort){
        $ok = password_verify($loginPasswort, $this->passwort);
        return $ok;
    }


    // Getter-Methoden
    public function getId() : int {
        return $this->id;
    }

    function getEmail() : string {
        return $this->email;
    }

    function getPasswort() : string {
        return $this->passwort;
    }

    function getBeschreibung() : string {
        return $this->beschreibung;
    }

    function getFotoDateiname() : string {
        return $this->fotoDateiname;
    }

    // SEtter Methode
    function setFotoDateiname(string $fotoDateiname){
        $this->fotoDateiname = $fotoDateiname;
    }

    function setBeschreibung(string $beschreibung){
        // Die Eigenschaft Beschreibung = Übergabeparameter Beschreibung
        $this->beschreibung = $beschreibung;
    }
}
?>