<?php
namespace Bas\classes;

// Zorg ervoor dat de juiste namespace wordt gebruikt voor Database
require_once 'Database.php';

class Artikel extends Database {
    private $table_name = "Artikel";

    public function insertArtikel($row) : bool {
        $artId = $this->BepMaxArtId();
        $sql = "INSERT INTO $this->table_name (artId, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
                VALUES (:artId, :artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'artId' => $artId,
            'artOmschrijving' => $row['artOmschrijving'],
            'artInkoop' => $row['artInkoop'],
            'artVerkoop' => $row['artVerkoop'],
            'artVoorraad' => $row['artVoorraad'],
            'artMinVoorraad' => $row['artMinVoorraad'],
            'artMaxVoorraad' => $row['artMaxVoorraad'],
            'artLocatie' => $row['artLocatie']
        ]);
    }

    private function BepMaxArtId() : int {
        $sql="SELECT MAX(artId)+1 FROM $this->table_name";
        return (int) self::$conn->query($sql)->fetchColumn();
    }

    public function getArtikelen() : array {
        $sql = "SELECT artId, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie FROM $this->table_name";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function showTable() : void {
        $artikelen = $this->getArtikelen();

        if (empty($artikelen)) {
            echo "Geen artikelen gevonden.";
            return;
        }

        echo "<table border='1'>";
        echo "<tr><th>Omschrijving</th><th>Inkoop</th><th>Verkoop</th><th>Voorraad</th><th>Min Voorraad</th><th>Max Voorraad</th><th>Locatie</th><th>Acties</th></tr>";

        foreach ($artikelen as $artikel) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($artikel['artOmschrijving']) . "</td>";
            echo "<td>" . htmlspecialchars($artikel['artInkoop']) . "</td>";
            echo "<td>" . htmlspecialchars($artikel['artVerkoop']) . "</td>";
            echo "<td>" . htmlspecialchars($artikel['artVoorraad']) . "</td>";
            echo "<td>" . htmlspecialchars($artikel['artMinVoorraad']) . "</td>";
            echo "<td>" . htmlspecialchars($artikel['artMaxVoorraad']) . "</td>";
            echo "<td>" . htmlspecialchars($artikel['artLocatie']) . "</td>";
            echo "<td><a href='artikel_bijwerken.php?artId=" . $artikel['artId'] . "'>Bijwerken</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    }

    public function getArtikelById($artId) {
        $sql = "SELECT artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie FROM $this->table_name WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        $stmt->bindParam(':artId', $artId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateArtikel($artId, $row) : bool {
        $sql = "UPDATE $this->table_name SET artOmschrijving = :artOmschrijving, artInkoop = :artInkoop, artVerkoop = :artVerkoop, artVoorraad = :artVoorraad, artMinVoorraad = :artMinVoorraad, artMaxVoorraad = :artMaxVoorraad, artLocatie = :artLocatie WHERE artId = :artId";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'artId' => $artId,
            'artOmschrijving' => $row['artOmschrijving'],
            'artInkoop' => $row['artInkoop'],
            'artVerkoop' => $row['artVerkoop'],
            'artVoorraad' => $row['artVoorraad'],
            'artMinVoorraad' => $row['artMinVoorraad'],
            'artMaxVoorraad' => $row['artMaxVoorraad'],
            'artLocatie' => $row['artLocatie']
        ]);
    }
}
?>

