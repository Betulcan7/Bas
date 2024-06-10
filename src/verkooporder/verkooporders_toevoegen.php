<?php
// auteur: Betul Can
// functie: Voeg nieuwe verkooporder toe
require_once '../classes/verkooporder.php';
use Bas\classes\Verkooporder;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $verkOrdDatum = $_POST['verkOrdDatum'];
    $verkOrdBestAantal = $_POST['verkOrdBestAantal'];
    $verkOrdStatus = $_POST['verkOrdStatus'];
    $artOmschrijving = $_POST['artOmschrijving'];
    $klantNaam = $_POST['klantNaam'];

    $verkooporder = new Verkooporder();
    try {
        $verkooporder->insertVerkooporder($verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus, $artOmschrijving, $klantNaam);
        echo "Verkooporder succesvol toegevoegd!";
    } catch (Exception $e) {
        echo "Fout: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verkooporder Toevoegen</title>
</head>
<body>
    <h1>Verkooporder Toevoegen</h1>
    <form method="post" action="">
        <label for="verkOrdDatum">Datum:</label>
        <input type="date" id="verkOrdDatum" name="verkOrdDatum" required><br>
        
        <label for="verkOrdBestAantal">Besteld Aantal:</label>
        <input type="number" id="verkOrdBestAantal" name="verkOrdBestAantal" required><br>
        
        <label for="verkOrdStatus">Status:</label>
        <input type="text" id="verkOrdStatus" name="verkOrdStatus" required><br>
        
        <label for="artOmschrijving">Artikel Omschrijving:</label>
        <input type="text" id="artOmschrijving" name="artOmschrijving" required><br>
        
        <label for="klantNaam">Klant Naam:</label>
        <input type="text" id="klantNaam" name="klantNaam" required><br>
        
        <input type="submit" value="Verkooporder Toevoegen">
    </form>
    <br>
    <a href="verkooporders.php">Terug naar Verkooporders</a>
</body>
</html>



