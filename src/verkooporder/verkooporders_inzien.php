<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verkooporders Inzien</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Verkooporders Inzien</h1>
    
    <?php
    require '../../vendor/autoload.php';
    use Bas\classes\Verkooporder;

    $verkooporder = new Verkooporder();
    $orders = $verkooporder->getVerkooporder();

    if (empty($orders)) {
        echo "Geen verkooporders gevonden.";
    } else {
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
                    <a href='update_status.php?verkOrdId=" . $order['verkOrdId'] . "'>Status Bijwerken</a> |
                    <a href='verkooporder_bijwerken.php?verkOrdId=" . $order['verkOrdId'] . "'>Wijzigen</a>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>

    <br>
    <a href="verkooporders_toevoegen.php">Verkooporder Toevoegen</a>
</body>
</html>

