<?php
session_start();

if (!isset($_SESSION['gebruiker'])) {
    header("Location: login.php");
    exit();
}

$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 5px 0;
        }
        a {
            text-decoration: none;
            color: #4CAF50;
        }
        a:hover {
            color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welkom, <?php echo $_SESSION['gebruiker']; ?></h1>
        <h2>Dashboard voor <?php echo $rol; ?></h2>
        
        <?php if ($rol === 'inkoper'): ?>
            <ul>
                <li><a href="inkooporders.php">Inkooporders beheren</a></li>
                <li><a href="artikelen_overzicht.php">Artikelen overzicht</a></li>
            </ul>
        <?php elseif ($rol === 'magazijnmeester'): ?>
            <ul>
                <li><a href="artikelen_beheren.php">Artikelen beheren</a></li>
                <li><a href="voorraad_inventariseren.php">Voorraad inventariseren</a></li>
            </ul>
        <?php elseif ($rol === 'magazijnmedewerker'): ?>
            <ul>
                <li><a href="artikelen_overzicht.php">Artikelen overzicht</a></li>
                <li><a href="picklist.php">Picklist bekijken</a></li>
            </ul>
        <?php elseif ($rol === 'bezorger'): ?>
            <ul>
                <li><a href="klanten_adressen.php">Klanten adressen</a></li>
                <li><a href="verkooporders_status.php">Verkooporders status</a></li>
            </ul>
        <?php elseif ($rol === 'verkoper'): ?>
            <ul>
                <li><a href="klanten_beheren.php">Klanten beheren</a></li>
                <li><a href="verkooporders_beheren.php">Verkooporders beheren</a></li>
            </ul>
        <?php endif; ?>
        
        <a href="logout.php">Uitloggen</a>
    </div>
</body>
</html>
