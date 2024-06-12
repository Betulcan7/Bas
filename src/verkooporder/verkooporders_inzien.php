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
        <label for="klantNaam">Zoek op Klant Naam:</label>
        <input type="text" id="klantNaam" name="klantNaam" required>
        <input type="submit" value="Zoeken">
    </form>
    <br>
    
    <?php
    require '../../vendor/autoload.php';

    use Bas\classes\Verkooporder;

    
    $verkooporder = new Verkooporder();


    $verkooporder->showTable();
    ?>
    <br>
    <a href="verkooporder_toevoegen.php">Nieuwe Verkooporder Toevoegen</a>
</body>
</html>
