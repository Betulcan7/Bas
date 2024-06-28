<?php
require '../../vendor/autoload.php';

use Bas\classes\Leverancier;

$leverancier = new Leverancier();
$leveranciers = $leverancier->getLeveranciers();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leveranciers Inzien</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Leveranciers Inzien</h1>

    <table border='1'>
        <tr>
            <th>Naam</th>
            <th>Contactpersoon</th>
            <th>E-mail</th>
            <th>Adres</th>
            <th>Postcode</th>
            <th>Woonplaats</th>
            <th>Acties</th>
        </tr>

        <?php foreach ($leveranciers as $lev): ?>
        <tr>
            <td><?php echo htmlspecialchars($lev['levNaam']); ?></td>
            <td><?php echo htmlspecialchars($lev['levContact']); ?></td>
            <td><?php echo htmlspecialchars($lev['levEmail']); ?></td>
            <td><?php echo htmlspecialchars($lev['levAdres']); ?></td>
            <td><?php echo htmlspecialchars($lev['levPostcode']); ?></td>
            <td><?php echo htmlspecialchars($lev['levWoonplaats']); ?></td>
            <td>
                <a href="leverancier_verwijderen.php?levId=<?php echo $lev['levId']; ?>">Verwijderen</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="leverancier_toevoegen.php">Nieuwe Leverancier Toevoegen</a>
</body>
</html>

