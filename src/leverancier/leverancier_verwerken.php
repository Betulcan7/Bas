<?php
require '../../vendor/autoload.php';

use Bas\classes\Leverancier;

$leverancier = new Leverancier();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $levNaam = $_POST['levNaam'];
    $levContact = $_POST['levContact'];
    $levEmail = $_POST['levEmail'];
    $levAdres = $_POST['levAdres'];
    $levPostcode = $_POST['levPostcode'];
    $levWoonplaats = $_POST['levWoonplaats'];

    try {
        $leverancier->insertLeverancier($levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats);
        echo "Leverancier succesvol toegevoegd!";
    } catch (Exception $e) {
        echo "Fout bij het toevoegen van leverancier: " . $e->getMessage();
    }
}
?>
