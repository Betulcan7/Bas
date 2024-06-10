<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoekresultaten Verkooporders</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Zoekresultaten Verkooporders</h1>
    
    <?php
    require '../../vendor/autoload.php';

    use Bas\classes\Verkooporder;

    // Haal de klant ID op uit de GET parameters
    $klantId = $_GET['klantId'] ?? null;

    if ($klantId) {
        // Maak een Verkooporder object
        $verkooporder = new Verkooporder();

        // Haal de verkooporders op basis van klant ID
        $orders = $verkooporder->getVerkoopordersByKlantId($klantId);

        if (!empty($orders)) {
            echo "<table border='1'>";
            echo "<tr><th>Datum</th><th>Bestelde Aantal</th><th>Status</th><th>Artikel Omschrijving</th></tr>";

            foreach ($orders as $order) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($order['verkOrdDatum']) . "</td>";
                echo "<td>" . htmlspecialchars($order['verkOrdBestAantal']) . "</td>";
                echo "<td>" . htmlspecialchars($order['verkOrdStatus']) . "</td>";
                echo "<td>" . htmlspecialchars($order['artOmschrijving']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Geen verkooporders gevonden voor klant ID: " . htmlspecialchars($klantId);
        }
    } else {
        echo "Geen klant ID opgegeven.";
    }
    ?>
    <br>
    <a href="verkooporders_inzien.php">Terug naar Verkooporders</a>
</body>
</html>
