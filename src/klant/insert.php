<?php
// auteur: studentnaam
// functie: insert class Klant

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){

    echo "<h2>Insert is uitgevoerd</h2>";

    // Maak een nieuwe Klant object aan
    $klant = new Klant;

    // Stel de klantgegevens in
    $row = [
        'klantNaam' => $_POST['klantnaam'],
        'klantEmail' => $_POST['klantemail'],
        'klantAdres' => $_POST['klantadres'],
        'klantPostcode' => $_POST['klantpostcode'],
        'klantWoonplaats' => $_POST['klantwoonplaats']
    ];

    // Voer de insertKlant-functie uit
    if ($klant->insertKlant($row)) {
        echo '<script>alert("Klant is toegevoegd")</script>';
    } else {
        echo '<script>alert("Er is een fout opgetreden bij het toevoegen van de klant")</script>';
    }

    echo "<script> location.replace('index.php'); </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>CRUD Klant</h1>
    <h2>Toevoegen</h2>
    <form method="post">
        <label for="nv">Klantnaam:</label>
        <input type="text" id="nv" name="klantnaam" placeholder="Klantnaam" required/>
        <br>   
        <label for="an">Klantemail:</label>
        <input type="text" id="an" name="klantemail" placeholder="Klantemail" required/>
        <br>
        <label for="ka">Klantadres:</label>
        <input type="text" id="ka" name="klantadres" placeholder="Klantadres" required/>
        <br>
        <label for="kp">Klantpostcode:</label>
        <input type="text" id="kp" name="klantpostcode" placeholder="Klantpostcode" required/>
        <br>
        <label for="kw">Klantwoonplaats:</label>
        <input type="text" id="kw" name="klantwoonplaats" placeholder="Klantwoonplaats" required/>
        <br><br>
        <input type='submit' name='insert' value='Toevoegen'>
    </form></br>

    <a href='read.php'>Terug</a>

</body>
</html>



