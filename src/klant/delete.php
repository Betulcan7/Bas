<?php 
// auteur: studentnaam
// functie: verwijder een klant

require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["verwijderen"])){
    // Maak een object Klant
    $klant = new Klant();

    // Verwijder de klant op basis van klantId
    $klantId = $_GET['klantId'];
    if($klant->deleteKlant((int)$klantId)) {
        echo '<script>alert("Klant verwijderd")</script>';
        echo "<script> location.replace('read.php'); </script>";
    } else {
        echo '<script>alert("Fout bij het verwijderen van de klant")</script>';
    }
}
?>
