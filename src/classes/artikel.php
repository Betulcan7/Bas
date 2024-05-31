<?php
// auteur: studentnaam
// functie: definitie class Artikel
namespace Bas\classes;

use Bas\classes\Database;

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
}
?>
