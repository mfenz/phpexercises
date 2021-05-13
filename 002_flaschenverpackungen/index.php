<?php
$anzFlaschen = 89420;
$flaschenProKarton = 10;
// Anzahl der benötigten Kartons
// (int) typecast in einen Wert der Variable int (Kommastellen weg)
$benoetigteKartons = (int)($anzFlaschen / $flaschenProKarton);
// Anzahl der Restflaschen
// Modulo % <-- Rest der Division in ganzen Zahlen
$anzRestflaschen = $anzFlaschen % $flaschenProKarton;
// Wie viele Flaschen fehlen für nächsten vollen Karton?
$anzFehlendeFlaschen = $flaschenProKarton - $anzRestflaschen;
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Flaschenverpackungsmaschine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script charset="utf-8" src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<h1>Flaschen-Verpackungsmaschine</h1>
<p>
    Sie haben <?php echo $anzFlaschen; ?> Flaschen auf Lager. 
    Sie können damit <?php echo $benoetigteKartons; ?> Kartons voll befüllen.
</p>
<p>
    Dabei bleiben <?php echo $anzRestflaschen; ?> Flaschen über. Produzieren Sie weitere 
    <?php echo $anzFehlendeFlaschen; ?> Flaschen um auch den letzten Karton zu befüllen.
</p>
</body>
</html>
