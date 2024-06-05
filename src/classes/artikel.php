<?php
namespace Bas\classes;

// Zorg ervoor dat de juiste namespace wordt gebruikt voor Database
require_once 'Database.php';

class Artikel extends Database {
    private $table_name = "Artikel";

    /**
     * Voegt een nieuw artikel toe aan de database.
     * @param array $row De gegevens van het artikel om toe te voegen.
     * @return bool Geeft aan of het toevoegen van het artikel succesvol was.
     */
    public function insertArtikel($row) : bool {
        // Bepaal een uniek artId
        $artId = $this->BepMaxArtId();

        // query
        $sql = "INSERT INTO $this->table_name (artId, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
                VALUES (:artId, :artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
        
        // Prepare
        $stmt = self::$conn->prepare($sql);

        // Execute
        $result = $stmt->execute([
            'artId' => $artId,
            'artOmschrijving' => $row['artOmschrijving'],
            'artInkoop' => $row['artInkoop'],
            'artVerkoop' => $row['artVerkoop'],
            'artVoorraad' => $row['artVoorraad'],
            'artMinVoorraad' => $row['artMinVoorraad'],
            'artMaxVoorraad' => $row['artMaxVoorraad'],
            'artLocatie' => $row['artLocatie']
        ]);
        
        return $result;
    }

    /**
     * Bepaalt een uniek artId voor het nieuwe artikel.
     * @return int Het unieke artId.
     */
    private function BepMaxArtId() : int {
        // Bepaal uniek nummer
        $sql="SELECT MAX(artId)+1 FROM $this->table_name";
        return  (int) self::$conn->query($sql)->fetchColumn();
    }

    /**
     * Haalt alle artikelen op uit de database.
     * @return array Een array met alle artikelen.
     */
    public function getArtikelen() : array {
        $sql = "SELECT artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie FROM $this->table_name";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Toont de artikelen in een HTML-tabel.
     * @return void
     */
    public function showTable() : void {
        $artikelen = $this->getArtikelen();

        if (empty($artikelen)) {
            echo "Geen artikelen gevonden.";
            return;
        }

        echo "<table border='1'>";
        echo "<tr><th>Omschrijving</th><th>Inkoop</th><th>Verkoop</th><th>Voorraad</th><th>Min Voorraad</th><th>Max Voorraad</th><th>Locatie</th></tr>";

        foreach ($artikelen as $artikel) {
            echo "<tr>";
            echo "<td>" . $artikel['artOmschrijving'] . "</td>";
            echo "<td>" . $artikel['artInkoop'] . "</td>";
            echo "<td>" . $artikel['artVerkoop'] . "</td>";
            echo "<td>" . $artikel['artVoorraad'] . "</td>";
            echo "<td>" . $artikel['artMinVoorraad'] . "</td>";
            echo "<td>" . $artikel['artMaxVoorraad'] . "</td>";
            echo "<td>" . $artikel['artLocatie'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}
?>
