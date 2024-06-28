<?php
require '../../vendor/autoload.php';

use Bas\classes\Leverancier;

$levId = $_GET['levId'] ?? null;

if ($levId) {
    $leverancier = new Leverancier();
    
    try {
        $leverancier->deleteLeverancier($levId);
        echo "Leverancier succesvol verwijderd!";
    } catch (Exception $e) {
        echo "Fout bij het verwijderen van leverancier: " . $e->getMessage();
    }
} else {
    echo "Geen leverancier ID opgegeven.";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leverancier Verwijderen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <br>
    <a href="leverancier_inzien.php">Terug naar Leveranciers</a>
</body>
</html>
