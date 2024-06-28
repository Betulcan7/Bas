<?php
namespace Bas\classes;

require_once 'Database.php';

class Leverancier {
    private $conn;
    private $table_name = "Leverancier";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getLeveranciers() {
        $sql = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($sql);

        $leveranciers = [];
        while ($row = $stmt->fetch()) {
            $leveranciers[] = $row;
        }
        return $leveranciers;
    }

    public function insertLeverancier($levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats) {
        $sql = "INSERT INTO " . $this->table_name . " (levNaam, levContact, levEmail, levAdres, levPostcode, levWoonplaats) 
                VALUES (:levNaam, :levContact, :levEmail, :levAdres, :levPostcode, :levWoonplaats)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':levNaam', $levNaam);
        $stmt->bindParam(':levContact', $levContact);
        $stmt->bindParam(':levEmail', $levEmail);
        $stmt->bindParam(':levAdres', $levAdres);
        $stmt->bindParam(':levPostcode', $levPostcode);
        $stmt->bindParam(':levWoonplaats', $levWoonplaats);

        if (!$stmt->execute()) {
            throw new \Exception("Fout bij het toevoegen van leverancier: " . implode(", ", $stmt->errorInfo()));
        }
        
        return true;
    }

    public function deleteLeverancier($levId) {
        $sql = "DELETE FROM " . $this->table_name . " WHERE levId = :levId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':levId', $levId);

        if (!$stmt->execute()) {
            throw new \Exception("Fout bij het verwijderen van leverancier: " . implode(", ", $stmt->errorInfo()));
        }

        return true;
    }
}
?>
