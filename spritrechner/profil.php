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
// Datei TankManager inkludieren
require_once 'manager/tankmanager.inc.php';

// Objekt der Klasse UserManager erzeugen
$userManager = new UserManager($connection);

// Objekt der Klasse TankManager erzeugen
$tankManager = new TankManager($connection);

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
} elseif(isset($_POST['btbearbeiten'])){
    // User-Beschreibung bearbeiten

    // User-Objekt bearbeiten
    $user->setBeschreibung($_POST['beschreibung']);

    // Änderungen am User in der Datenbank übernehmen
    $userManager->updateUser($user);

    header('Location: ./profil.php');
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
        echo '<img class="profilbild" src="uploads/'.$user->getFotoDateiname().'">';
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
        Beschreibung: <textarea name="beschreibung"><?php echo $user->getBeschreibung(); ?></textarea><br/>
        <input type="submit" name="btbearbeiten" value="Bearbeiten">
    </form>

    <form enctype="multipart/form-data" action="profil.php" method="post">
        Profilbild hochladen: 
        <input type="file" name="profilbild" accept="image/jpeg, image/jpg, image/png"><br/>
        <input type="submit" name="btprofilbild" value="Profilbild hochladen">
    </form>

    <h2>Tankbelege</h2>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Datum</th>
                <th>Liter</th>
                <th>Betrag</th>
            </tr>
        </thead>
        <tbody>
<?php
// Laden der Tankbelege für diesen User
$belege = $tankManager->getTankbelegeByUserId($userId);
foreach($belege as $b){
    echo '<tr>';
    echo '<td>';
    echo htmlspecialchars($b->getUser()->getEmail());
    echo '</td>';
    echo '<td>';
    echo $b->getZeitpunkt()->format('d.m.Y h:i');
    echo '</td>';
    echo '<td>';
    echo htmlspecialchars($b->getLiter());
    echo '</td>';
    echo '<td>';
    echo htmlspecialchars($b->getBetrag());
    echo '</td>';
    echo '</tr>';
}
?>
        </tbody>
    </table>

</section>
</body>
</html>
