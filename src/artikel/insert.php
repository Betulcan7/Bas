<?php
// auteur: studentnaam
// functie: insert class Artikel

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

    echo "<h2>Insert is uitgevoerd</h2>";

    // Maak een nieuwe Artikel object aan
    $artikel = new Artikel;

    // Stel de artikelgegevens in
    $row = [
        'artOmschrijving' => $_POST['artOmschrijving'],
        'artInkoop' => $_POST['artInkoop'],
        'artVerkoop' => $_POST['artVerkoop'],
        'artVoorraad' => $_POST['artVoorraad'],
        'artMinVoorraad' => $_POST['artMinVoorraad'],
        'artMaxVoorraad' => $_POST['artMaxVoorraad'],
        'artLocatie' => $_POST['artLocatie']
    ];

    // Voer de insertArtikel-functie uit
    if ($artikel->insertArtikel($row)) {
        echo '<script>alert("Artikel is toegevoegd")</script>';
    } else {
        echo '<script>alert("Er is een fout opgetreden bij het toevoegen van het artikel")</script>';
    }

    echo "<script> location.replace('index.php'); </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Toevoegen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Artikel Toevoegen</h1>
    <form method="post">
        <label for="omschrijving">Artikel Omschrijving:</label>
        <input type="text" id="omschrijving" name="artOmschrijving" placeholder="Artikel Omschrijving" required/>
        <br>   
        <label for="inkoop">Artikel Inkoop:</label>
        <input type="text" id="inkoop" name="artInkoop" placeholder="Artikel Inkoop" required/>
        <br>
        <label for="verkoop">Artikel Verkoop:</label>
        <input type="text" id="verkoop" name="artVerkoop" placeholder="Artikel Verkoop" required/>
        <br>
        <label for="voorraad">Artikel Voorraad:</label>
        <input type="text" id="voorraad" name="artVoorraad" placeholder="Artikel Voorraad" required/>
        <br>
        <label for="min_voorraad">Artikel Min Voorraad:</label>
        <input type="text" id="min_voorraad" name="artMinVoorraad" placeholder="Artikel Min Voorraad" required/>
        <br>
        <label for="max_voorraad">Artikel Max Voorraad:</label>
        <input type="text" id="max_voorraad" name="artMaxVoorraad" placeholder="Artikel Max Voorraad" required/>
        <br>
        <label for="locatie">Artikel Locatie:</label>
        <input type="text" id="locatie" name="artLocatie" placeholder="Artikel Locatie" required/>
        <br><br>
        <input type='submit' name='insert' value='Toevoegen'>
    </form></br>

    <a href='index.html'>Terug</a>

</body>
</html>

