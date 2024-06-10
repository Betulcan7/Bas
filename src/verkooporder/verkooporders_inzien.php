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
    
    <form method="get" action="verkooporders_zoeken.php">
        <label for="klantId">Zoek op Klant ID:</label>
        <input type="text" id="klantId" name="klantId" required>
        <input type="submit" value="Zoeken">
    </form>
    <br>
    
    <?php
    require '../../vendor/autoload.php';

    use Bas\classes\Verkooporder;

    // Maak een Verkooporder object
    $verkooporder = new Verkooporder();

    // Toon de tabel
    $verkooporder->showTable();
    ?>
    <br>
    <a href="verkooporder_toevoegen.php">Nieuwe Verkooporder Toevoegen</a>
</body>
</html>

