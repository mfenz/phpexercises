<?php
// Session starten
session_start();
// Prüfen ob User angemeldet ist
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    // angemeldet
} else {
    // nicht angemeldet, auf Login weiterleiten
    header('Location: ./login.php');
    return;
}

// Bei jedem Aufruf eine DB-Verbindung aufbauen
require_once 'db/dbconnection.inc.php';
// Datei UserManager inkludieren
require_once 'manager/usermanager.inc.php';
// Objekt der Klasse UserManager erzeugen
$userManager = new UserManager($connection);

// Wer ruft diese Seite überhaupt auf?
$userId = $_SESSION['userid'];

// User-Objekt aus der Datenbank laden
$user = $userManager->getUserById($userId);

$errors = [];

if(isset($_POST['btprofilbild'])){
    // Datei Upload

    $uploadFile = 'uploads\\' . $_FILES['profilbild']['name'];
    if(move_uploaded_file($_FILES['profilbild']['tmp_name'], $uploadFile)){
        $user->setFotoDateiname($_FILES['profilbild']['name']);
        $userManager->updateUser($user);
        header('Location: ./profil.php');
    } else {
        $errors[] = 'Es wurde keine Datei angegeben';
    }
}


?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php include 'inc/header.inc.php'; ?>
<section class="center-wrapper">
    <h1>Profil</h1>
    <?php
    if(strlen($user->getFotoDateiname()) > 0){
        echo '<img src="uploads/'.$user->getFotoDateiname().'">';
    }
    ?>
    <p>E-Mail: <?php echo htmlspecialchars($user->getEmail()); ?></p>
    <p>Beschreibung: <?php echo htmlspecialchars($user->getBeschreibung()) ?></p>

    <?php
    // Fehler ausgeben
    if(count($errors) > 0){
        echo '<div class="error">';
        // Fehler stehen als String im array $errors
        // Über jeden Eintrag iterieren, und den Eintrag ausgeben lassen
        foreach($errors as $error){
            // Schleifenkörper
            echo "<p>$error</p>";
        }
        echo '</div>';
    }
    ?>
    <form action="profil.php" method="post">
        Beschreibung: <textarea name="beschreibung"></textarea><br/>
        <input type="submit" name="btbearbeiten" value="Bearbeiten">
    </form>

    <form enctype="multipart/form-data" action="profil.php" method="post">
        Profilbild hochladen: 
        <input type="file" name="profilbild" accept="image/jpeg, image/jpg, image/png"><br/>
        <input type="submit" name="btprofilbild" value="Profilbild hochladen">
    </form>
</section>
</body>
</html>
