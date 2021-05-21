<?php
$passwort = '123456';
// Hash + Salt
$hash = password_hash($passwort, PASSWORD_DEFAULT);

echo "Das Passwort $passwort wird zu $hash <br/>";

$loginErfolgreich = password_verify('1234567', $hash);
if($loginErfolgreich) {
    echo "Passwort stimmt!";
} else {
    echo "Passwort stimmt nicht!!";
}

?>