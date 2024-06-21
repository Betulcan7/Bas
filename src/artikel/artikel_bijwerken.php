<?php
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

$artikel = new Artikel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $artId = $_POST['artId'];
    $row = [
        'artOmschrijving' => $_POST['artOmschrijving'],
        'artInkoop' => $_POST['artInkoop'],
        'artVerkoop' => $_POST['artVerkoop'],
        'artVoorraad' => $_POST['artVoorraad'],
        'artMinVoorraad' => $_POST['artMinVoorraad'],
        'artMaxVoorraad' => $_POST['artMaxVoorraad'],
        'artLocatie' => $_POST['artLocatie']
    ];
    
    if ($artikel->updateArtikel($artId, $row)) {
        header('Location: artikelen_inzien.php');
        exit;
    } else {
        echo "Fout bij het bijwerken van artikel.";
    }
} elseif (isset($_GET['artId'])) {
    $artId = $_GET['artId'];
    $artikelData = $artikel->getArtikelById($artId);
} else {
    echo "Er is geen artId opgegeven.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Bijwerken</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Artikel Bijwerken</h1>
    <form method="post" action="artikel_bijwerken.php">
        <input type="hidden" name="artId" value="<?php echo htmlspecialchars($artId); ?>">
        <label for="artOmschrijving">Omschrijving:</label>
        <input type="text" id="artOmschrijving" name="artOmschrijving" value="<?php echo htmlspecialchars($artikelData['artOmschrijving']); ?>" required><br>
        
        <label for="artInkoop">Inkoop:</label>
        <input type="number" id="artInkoop" name="artInkoop" value="<?php echo htmlspecialchars($artikelData['artInkoop']); ?>" required><br>
        
        <label for="artVerkoop">Verkoop:</label>
        <input type="number" id="artVerkoop" name="artVerkoop" value="<?php echo htmlspecialchars($artikelData['artVerkoop']); ?>" required><br>
        
        <label for="artVoorraad">Voorraad:</label>
        <input type="number" id="artVoorraad" name="artVoorraad" value="<?php echo htmlspecialchars($artikelData['artVoorraad']); ?>" required><br>
        
        <label for="artMinVoorraad">Min Voorraad:</label>
        <input type="number" id="artMinVoorraad" name="artMinVoorraad" value="<?php echo htmlspecialchars($artikelData['artMinVoorraad']); ?>" required><br>
        
        <label for="artMaxVoorraad">Max Voorraad:</label>
        <input type="number" id="artMaxVoorraad" name="artMaxVoorraad" value="<?php echo htmlspecialchars($artikelData['artMaxVoorraad']); ?>" required><br>
        
        <label for="artLocatie">Locatie:</label>
        <input type="text" id="artLocatie" name="artLocatie" value="<?php echo htmlspecialchars($artikelData['artLocatie']); ?>" required><br>
        
        <input type="submit" value="Bijwerken">
    </form>
</body>
</html>
