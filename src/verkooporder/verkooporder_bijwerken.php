<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verkooporder Bijwerken</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Verkooporder Bijwerken</h1>
    
    <?php
    require '../../vendor/autoload.php';

    use Bas\classes\Verkooporder;

    // Maak een Verkooporder object
    $verkooporder = new Verkooporder();

    // Haal de verkooporder ID uit de URL
    $verkOrdId = $_GET['verkOrdId'] ?? null;

    if ($verkOrdId) {
        // Haal de verkooporder op basis van ID
        $order = $verkooporder->getVerkooporderById($verkOrdId);
    } else {
        echo "Geen verkooporder ID opgegeven.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verwerk het bijwerken van de verkooporder
        $verkOrdDatum = $_POST['verkOrdDatum'];
        $verkOrdBestAantal = $_POST['verkOrdBestAantal'];
        $verkOrdStatus = $_POST['verkOrdStatus'];
        $artOmschrijving = $_POST['artOmschrijving'];

        try {
            $verkooporder->updateVerkooporder($verkOrdId, $verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus, $artOmschrijving);
            echo "Verkooporder succesvol bijgewerkt!";
        } catch (Exception $e) {
            echo "Fout bij het bijwerken van de verkooporder: " . $e->getMessage();
        }
    }

    if (!$order) {
        echo "Verkooporder niet gevonden.";
        exit;
    }
    ?>

    <form method="post" action="">
        <label for="verkOrdDatum">Datum:</label><br>
        <input type="date" id="verkOrdDatum" name="verkOrdDatum" value="<?php echo htmlspecialchars($order['verkOrdDatum']); ?>" required><br><br>
        
        <label for="verkOrdBestAantal">Besteld Aantal:</label><br>
        <input type="number" id="verkOrdBestAantal" name="verkOrdBestAantal" value="<?php echo htmlspecialchars($order['verkOrdBestAantal']); ?>" required><br><br>
        
        <label for="verkOrdStatus">Status:</label><br>
        <select id="verkOrdStatus" name="verkOrdStatus" required>
            <option value="Nieuw" <?php echo $order['verkOrdStatus'] == 'Nieuw' ? 'selected' : ''; ?>>Nieuw</option>
            <option value="Verwerkt" <?php echo $order['verkOrdStatus'] == 'Verwerkt' ? 'selected' : ''; ?>>Verwerkt</option>
            <option value="Verzonden" <?php echo $order['verkOrdStatus'] == 'Verzonden' ? 'selected' : ''; ?>>Verzonden</option>
            <option value="Geleverd" <?php echo $order['verkOrdStatus'] == 'Geleverd' ? 'selected' : ''; ?>>Geleverd</option>
            <option value="Geannuleerd" <?php echo $order['verkOrdStatus'] == 'Geannuleerd' ? 'selected' : ''; ?>>Geannuleerd</option>
        </select><br><br>
        
        <label for="artOmschrijving">Artikel Omschrijving:</label><br>
        <input type="text" id="artOmschrijving" name="artOmschrijving" value="<?php echo htmlspecialchars($order['artOmschrijving']); ?>" required><br><br>

        <input type="submit" value="Bijwerken">
    </form>

    <br>
    <a href="verkooporders_inzien.php">Terug naar Verkooporders</a>
</body>
</html>




