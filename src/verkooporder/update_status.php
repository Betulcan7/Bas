<?php
require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

// Controleer of het verkOrdId aanwezig is in de URL
if (isset($_GET['verkOrdId'])) {
    $verkOrdId = $_GET['verkOrdId'];

    $verkooporder = new Verkooporder();

    // Haal de huidige status op
    try {
        $currentStatus = $verkooporder->getOrderStatus($verkOrdId);
    } catch (\Exception $e) {
        echo "Fout: " . $e->getMessage();
        exit;
    }

    // Verwerk het bijwerken van de status
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newStatus = $_POST['newStatus'];
        if ($verkooporder->updateOrderStatus($verkOrdId, $newStatus)) {
            header("Location: verkooporders_inzien.php");
            exit;
        } else {
            echo "Er is een fout opgetreden bij het bijwerken van de status.";
        }
    }
} else {
    echo "Er is geen verkOrdId opgegeven.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Bijwerken</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Status Bijwerken</h1>
    
    <form method="post" action="">
        <label for="currentStatus">Huidige Status:</label>
        <input type="text" id="currentStatus" name="currentStatus" value="<?php echo htmlspecialchars($currentStatus); ?>" disabled>
        <br>
        <label for="newStatus">Nieuwe Status:</label>
        <input type="text" id="newStatus" name="newStatus" required>
        <br>
        <input type="submit" value="Bijwerken">
    </form>
    <br>
    <a href="verkooporders_inzien.php">Terug naar Verkooporders</a>
</body>
</html>
