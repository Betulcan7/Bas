<?php
// auteur: Betul Can
// functie: database verbinding
namespace Bas\classes;

use mysqli;

class Dataverkoop {
    private static $conn;

    public static function connect() {
        if (self::$conn === null) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bas";

            self::$conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if (self::$conn->connect_error) {
                die("Connection failed: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}
?>
