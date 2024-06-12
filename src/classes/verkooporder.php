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
        $sql = "SELECT verkOrdId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus, Artikel.artOmschrijving 
                FROM " . $this->table_name . " 
                JOIN Artikel ON " . $this->table_name . ".artId = Artikel.artId";
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
        echo "<tr><th>Datum</th><th>Bestelde Aantal</th><th>Status</th><th>Artikel Omschrijving</th><th>Acties</th></tr>";
    
        foreach ($orders as $order) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($order['verkOrdDatum']) . "</td>";
            echo "<td>" . htmlspecialchars($order['verkOrdBestAantal']) . "</td>";
            echo "<td>" . htmlspecialchars($order['verkOrdStatus']) . "</td>";
            echo "<td>" . htmlspecialchars($order['artOmschrijving']) . "</td>";
            echo "<td>
                    <a href='delete.php?verkOrdId=" . $order['verkOrdId'] . "'>Verwijderen</a> | 
                    <a href='update_status.php?verkOrdId=" . $order['verkOrdId'] . "'>Status Bijwerken</a>
                  </td>";
            echo "</tr>";
        }
    
        echo "</table>";
    }

    public function getVerkoopordersByKlantId($klantId) {
        $sql = "SELECT verkOrdDatum, verkOrdBestAantal, verkOrdStatus, Artikel.artOmschrijving 
                FROM " . $this->table_name . " 
                JOIN Artikel ON " . $this->table_name . ".artId = Artikel.artId
                WHERE klantId = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $klantId);
        $stmt->execute();
        $result = $stmt->get_result();

        $orders = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        return $orders;
    }

    public function insertVerkooporder($datum, $bestAantal, $status, $artOmschrijving, $klantNaam) {
        $sql = "SELECT artId FROM Artikel WHERE artOmschrijving = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $artOmschrijving);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            throw new \Exception("Artikel niet gevonden: " . htmlspecialchars($artOmschrijving));
        }

        $row = $result->fetch_assoc();
        $artId = $row['artId'];

        $sql = "SELECT klantId FROM Klant WHERE klantNaam = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $klantNaam);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            throw new \Exception("Klant niet gevonden: " . htmlspecialchars($klantNaam));
        }

        $row = $result->fetch_assoc();
        $klantId = $row['klantId'];

        $sql = "INSERT INTO " . $this->table_name . " (verkOrdDatum, verkOrdBestAantal, verkOrdStatus, artId, klantId) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssii', $datum, $bestAantal, $status, $artId, $klantId);

        if (!$stmt->execute()) {
            throw new \Exception("Fout bij het invoegen van verkooporder: " . $stmt->error);
        }

        return true;
    }

    public function deleteVerkooporder($verkOrdId) {
        $sql = "DELETE FROM " . $this->table_name . " WHERE verkOrdId = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $verkOrdId);
        return $stmt->execute();
    }

    public function getOrderStatus($verkOrdId) {
        $sql = "SELECT verkOrdStatus FROM " . $this->table_name . " WHERE verkOrdId = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $verkOrdId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['verkOrdStatus'];
        } else {
            throw new \Exception("Verkooporder niet gevonden: " . htmlspecialchars($verkOrdId));
        }
    }

    public function updateOrderStatus($verkOrdId, $newStatus) {
        $sql = "UPDATE " . $this->table_name . " SET verkOrdStatus = ? WHERE verkOrdId = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $newStatus, $verkOrdId);
        return $stmt->execute();
    }
}
?>
