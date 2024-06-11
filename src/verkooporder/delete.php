<?php
require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

// Controleer of het verkOrdId aanwezig is in de URL
if (isset($_GET['verkOrdId'])) {
    // Haal het verkOrdId op uit de URL
    $verkOrdId = $_GET['verkOrdId'];

    // Maak een Verkooporder object aan
    $verkooporder = new Verkooporder();

    // Probeer de verkooporder te verwijderen
    try {
        // Roep de methode aan om de verkooporder te verwijderen
        if ($verkooporder->deleteVerkooporder($verkOrdId)) {
            // Als de verkooporder succesvol is verwijderd, stuur de gebruiker terug naar de verkooporders inzien pagina
            header("Location: verkooporders_inzien.php");
            exit;
        } else {
            // Als er een fout optreedt bij het verwijderen, geef een foutmelding weer
            echo "Er is een fout opgetreden bij het verwijderen van de verkooporder.";
        }
    } catch (\Exception $e) {
        // Als er een uitzondering wordt opgevangen, geef de foutmelding weer
        echo "Fout: " . $e->getMessage();
    }
} else {
    // Als het verkOrdId niet aanwezig is in de URL, geef een foutmelding weer
    echo "Er is geen verkOrdId opgegeven.";
}
?>
