<?php
// Bei jedem Aufruf eine DB-Verbindung aufbauen
require_once 'db/dbconnection.inc.php';

// Gaestebuch-Manager inkludieren
require_once 'manager/gaestebuchmanager.inc.php';

// GaestebuchManager-Objekt erzeugen
$gaestebuchManager = new GaestebuchManager($connection);

$errors = [];

// Wurde ein neuer Gästebucheintrag abgeschickt?
if(isset($_POST['btsubmit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $text = $_POST['text'];

    if(strlen($name) == 0){
        $errors['name'] = "Name eingeben";
    }
    if(strlen($email) == 0){
        $errors['email'] = "Email eingeben";
    }
    if(strlen($text) == 0){
        $errors['text'] = "Text eingeben";
    }

    if(count($errors) == 0){
        $id = $gaestebuchManager->addGaestebucheintrag($name, $email, $text);

        // Redirect um von POSt-Request auf GET-Request zu kommen
        header('Location: gaestebuch.php?inserted=true&id='.$id);
    }
}

// Alle Gästebucheinträge laden
$gaestebucheintraege = $gaestebuchManager->getGaestebucheintraege();

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Spritrechner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php include 'inc/header.inc.php'; ?>
<section class="center-wrapper">
<h1>Gästebuch</h1>
<h2>Neuen Eintrag hinzufügen</h2>
    
    <form action="gaestebuch.php?" method="POST">
        <?php
        if(count($errors) > 0){
            echo '<div class="error">';
            echo '<p>Bitte beseitigen Sie die folgenden Fehler:</p>';
            echo '<ul>';
            foreach($errors as $key => $value){
                echo "<li>$value</li>";
            }
            echo '</ul>';
            echo '</div>';
        }
        if(isset($_GET['inserted']) && $_GET['inserted'] == true){
            echo '<div class="success">';
            echo '<p>Der Gästbucheintrag wurde gespeichert!</p>';
            echo '</div>';
        }
        ?>
        <div>
            <label>Name *</label><br/>
            <input type="text" name="name">
        </div>
        <div>
            <label>Email *</label><br/>
            <input type="text" name="email">
        </div>
        <div>
            <label>Text *</label><br/>
            <textarea rows="6" name="text"></textarea>
        </div>
        <button name="btsubmit">Absenden</button>
    </form>

    <h2>Alle Einträge</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Datum</th>
                <th>Name</th>
                <th>Email</th>
                <th>Text</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($gaestebucheintraege as $key => $value){
            $id = $value->getId();
            $datum = $value->getDatum()->format('d.m.Y H:i:s');
            $name = htmlspecialchars($value->getName());
            $email = htmlspecialchars($value->getEmail());
            $text = htmlspecialchars($value->getText());

            $text = "<tr>
                <td>$id</td>
                <td>$datum</td>
                <td>$name</td>
                <td>$email</td>
                <td>$text</td>
            </tr>";

            echo $text;
        }
        ?>
        </tbody>
    </table>
</section>
</body>
</html>
