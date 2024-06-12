<?php
require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

if (isset($_GET['klantNaam'])) {
    $klantNaam = $_GET['klantNaam'];
    
    $verkooporder = new Verkooporder();
    
    try {
        $orders = $verkooporder->getVerkoopordersByKlantNaam($klantNaam);
    } catch (\Exception $e) {
        echo "Fout: " . $e->getMessage();
        exit;
    }
} else {
    echo "Er is geen klantnaam opgegeven.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verkooporders Zoeken</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Verkooporders Zoeken</h1>

    <?php
    if (!empty($orders)) {
        echo "<table border='1'>";
        echo "<tr><th>Datum</th><th>Bestelde Aantal</th><th>Status</th><th>Artikel Omschrijving</th><th>Acties</th></tr>";

        foreach ($orders as $order) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($order['verkOrdDatum']) . "</td>";
            echo "<td>" . htmlspecialchars($order['verkOrdBestAantal']) . "</td>";
            echo "<td>" . htmlspecialchars($order['verkOrdStatus']) . "</td>";
            echo "<td>" . htmlspecialchars($order['artOmschrijving']) . "</td>";
            echo "<td>
                    <a href='delete.php?verkOrdId=" . $order['verkOrdId'] . "'>Verwijderen</a> | 
                    <a href='update_status.php?verkOrdId=" . $order['verkOrdId'] . "'>Status Bijwerken</a>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Geen verkooporders gevonden voor klant: " . htmlspecialchars($klantNaam);
    }
    ?>
    <br>
    <a href="verkooporders_inzien.php">Terug naar Verkooporders Inzien</a>
</body>
</html>
