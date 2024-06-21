<?php
// auteur: studentnaam
// functie: update class Klant

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

$klant = new Klant();

if (isset($_POST["update"]) && $_POST["update"] == "Wijzigen") {
    $row = [
        'klantId' => $_POST['klantId'],
        'klantNaam' => $_POST['klantnaam'],
        'klantEmail' => $_POST['klantemail'],
        'klantAdres' => $_POST['klantadres'],
        'klantPostcode' => $_POST['klantpostcode'],
        'klantWoonplaats' => $_POST['klantwoonplaats']
    ];

    if ($klant->updateKlant($row)) {
        echo '<script>alert("Klantgegevens bijgewerkt");</script>';
        echo '<script>location.replace("read.php");</script>';
    } else {
        echo '<script>alert("Fout bij het bijwerken van klantgegevens");</script>';
    }
}

if (isset($_GET['klantId'])) {
    $row = $klant->getKlant($_GET['klantId']);
} else {
    echo "Geen klantId opgegeven<br>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>CRUD Klant</h1>
<h2>Wijzigen</h2>	
<form method="post">
    <input type="hidden" name="klantId" value="<?php echo htmlspecialchars($row['klantId']); ?>">
    <label for="klantnaam">Klantnaam:</label>
    <input type="text" id="klantnaam" name="klantnaam" value="<?php echo htmlspecialchars($row['klantNaam']); ?>" required><br>
    <label for="klantemail">Klantemail:</label>
    <input type="email" id="klantemail" name="klantemail" value="<?php echo htmlspecialchars($row['klantEmail']); ?>" required><br>
    <label for="klantadres">Klantadres:</label>
    <input type="text" id="klantadres" name="klantadres" value="<?php echo htmlspecialchars($row['klantAdres']); ?>" required><br>
    <label for="klantpostcode">Klantpostcode:</label>
    <input type="text" id="klantpostcode" name="klantpostcode" value="<?php echo htmlspecialchars($row['klantPostcode']); ?>" required><br>
    <label for="klantwoonplaats">Klantwoonplaats:</label>
    <input type="text" id="klantwoonplaats" name="klantwoonplaats" value="<?php echo htmlspecialchars($row['klantWoonplaats']); ?>" required><br><br>
    <input type="submit" name="update" value="Wijzigen">
</form><br>

<a href="read.php">Terug</a>

</body>
</html>
