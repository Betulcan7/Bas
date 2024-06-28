<?php
session_start();
require 'gebruikers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];

    if (isset($gebruikers[$gebruikersnaam]) && $gebruikers[$gebruikersnaam]['wachtwoord'] === $wachtwoord) {
        $_SESSION['gebruiker'] = $gebruikersnaam;
        $_SESSION['rol'] = $gebruikers[$gebruikersnaam]['rol'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inloggen</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label for="gebruikersnaam">Gebruikersnaam:</label><br>
            <input type="text" id="gebruikersnaam" name="gebruikersnaam" required><br><br>
            
            <label for="wachtwoord">Wachtwoord:</label><br>
            <input type="password" id="wachtwoord" name="wachtwoord" required><br><br>
            
            <input type="submit" value="Inloggen">
        </form>
    </div>
</body>
</html>
