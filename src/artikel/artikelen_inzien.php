<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikelen Inzien</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Artikelen Inzien</h1>
    
    <?php
    require '../../vendor/autoload.php';
    use Bas\classes\Artikel;

    // Maak een Artikel object
    $artikel = new Artikel();

    // Toon de tabel
    $artikel->showTable();
    ?>
</body>
</html>
