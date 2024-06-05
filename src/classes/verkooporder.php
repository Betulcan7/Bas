<?php
// auteur: Betul Can
// functie: Verkooporders class
namespace Bas\classes;

include_once 'dataverkoop.php';

class Verkooporder {
    private $conn;
    private $table_name = "verkooporder";

    public function __construct() {
        $this->conn = Dataverkoop::connect();
    }

    public function getVerkooporder() {
        $sql = "SELECT verkOrdDatum, verkOrdBestAantal, verkOrdStatus FROM " . $this->table_name;
        $result = $this->conn->query($sql);

        $orders = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        return $orders;
    }

    public function showTable() {
        $orders = $this->getVerkooporder();

        if (empty($orders)) {
            echo "Geen verkooporders gevonden.";
            return;
        }

        echo "<table border='1'>";
        echo "<tr><th>Datum</th><th>Bestelde Aantal</th><th>Status</th></tr>";

        foreach ($orders as $order) {
            echo "<tr>";
            echo "<td>" . $order['verkOrdDatum'] . "</td>";
            echo "<td>" . $order['verkOrdBestAantal'] . "</td>";
            echo "<td>" . $order['verkOrdStatus'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}
?>