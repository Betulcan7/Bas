<?php
require '../../vendor/autoload.php';

use Bas\classes\Leverancier;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $levNaam = $_POST['levNaam'];
    $levContact = $_POST['levContact'];
    $levEmail = $_POST['levEmail'];
    $levAdres = $_POST['levAdres'];
    $levPostcode = $_POST['levPostcode'];
    $levWoonplaats = $_POST['levWoonplaats'];

    $leverancier = new Leverancier();

    try {
        $leverancier->insertLeverancier($levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats);
        echo "Leverancier succesvol toegevoegd!";
    } catch (Exception $e) {
        echo "Fout bij het toevoegen van leverancier: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leverancier Toevoegen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Leverancier Toevoegen</h1>

    <form method="post" action="">
        <label for="levNaam">Naam:</label><br>
        <input type="text" id="levNaam" name="levNaam" required><br><br>
        
        <label for="levContact">Contactpersoon:</label><br>
        <input type="text" id="levContact" name="levContact" required><br><br>
        
        <label for="levEmail">E-mail:</label><br>
        <input type="email" id="levEmail" name="levEmail" required><br><br>
        
        <label for="levAdres">Adres:</label><br>
        <input type="text" id="levAdres" name="levAdres" required><br><br>
        
        <label for="levPostcode">Postcode:</label><br>
        <input type="text" id="levPostcode" name="levPostcode" required><br><br>
        
        <label for="levWoonplaats">Woonplaats:</label><br>
        <input type="text" id="levWoonplaats" name="levWoonplaats" required><br><br>

        <input type="submit" value="Toevoegen">
    </form>

    <br>
    <a href="leverancier_inzien.php">Terug naar Leveranciers</a>
</body>
</html>
