<?php
$summeProdukte = 0.5;
$versandkosten = berechneVersandkosten($summeProdukte);
$gesamt = $summeProdukte + $versandkosten;

// Gibt die Versandkosten für die Bestellung zurück
function berechneVersandkosten($summeProdukte){
    if($summeProdukte <= 50){
        return 9.99;
    } 
    elseif($summeProdukte > 100){
        return 0;
    }
    return 5.99;
}

function berechneVersandkosten2($summeProdukte){
    if($summeProdukte <= 50){
        return 9.99;
    }
    elseif($summeProdukte <= 100){
        return 5.99;
    }
    return 0;
}

function berechneVersandkosten3($summeProdukte){
    if($summeProdukte <= 50){
        return 9.99;
    } elseif($summeProdukte > 50 && $summeProdukte <= 100){
        return 5.99;
    }
    return 0;
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Willkommen!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<p>Produkte: <?php echo $summeProdukte; ?> Euro</p>
<?php
// Wenn es keine Versandkosten gibt, einen Text ausgeben
// Diese Bestellung ist versandkostenfrei
// ansonsten die Versandkosten ausgeben
if($versandkosten == 0){
    echo "<p>Diese Bestellung ist versandkostenfrei!!</p>";
} else {
    echo "<p>Versandkosten: $versandkosten Euro</p>";
}
?>
<p>Gesamtkosten: <?php echo $gesamt; ?> Euro</p>
</body>
</html>
