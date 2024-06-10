<?php
// auteur: studentnaam
// functie: definitie class Klant
namespace Bas\classes;

use PDO;

class Klant extends Database {
    public $klantId;
    public $klantEmail = null;
    public $klantNaam;
    public $klantAdres;
    public $klantPostcode;
    public $klantWoonplaats;
    private $table_name = "Klant";

    // Methods

    /**
     * Summary of crudKlant
     * @return void
     */
    public function crudKlant() : void {
        // Haal alle klanten op uit de database mbv de method getKlanten()
        $lijst = $this->getKlanten();

        // Print een HTML tabel van de lijst    
        $this->showTable($lijst);
    }

    /**
     * Summary of getKlanten
     * @return mixed
     */
    public function getKlanten() : array {
        // Doe een query: dit is een prepare en execute in 1 zonder placeholders
        $sql = "SELECT klantId, klantEmail, klantNaam, klantAdres, klantPostcode, klantWoonplaats FROM " . $this->table_name;
        $stmt = self::$conn->query($sql);
        $lijst = $stmt->fetchAll();

        return $lijst;
    }

    /**
     * Summary of getKlant
     * @param int $klantId
     * @return mixed
     */
    public function getKlant(int $klantId) : array {
        // Doe een fetch op $klantId
        $sql = "SELECT klantId, klantEmail, klantNaam, klantAdres, klantPostcode, klantWoonplaats FROM " . $this->table_name . " WHERE klantId = :klantId";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(['klantId' => $klantId]);
        $klant = $stmt->fetch();

        return $klant;
    }

    public function dropDownKlant($row_selected = -1){
        // Haal alle klanten op uit de database mbv de method getKlanten()
        $lijst = $this->getKlanten();

        echo "<label for='Klant'>Choose a klant:</label>";
        echo "<select name='klantId'>";
        foreach ($lijst as $row){
            if($row_selected == $row["klantId"]){
                echo "<option value='$row[klantId]' selected='selected'> $row[klantNaam] $row[klantEmail]</option>\n";
            } else {
                echo "<option value='$row[klantId]'> $row[klantNaam] $row[klantEmail]</option>\n";
            }
        }
        echo "</select>";
    }

    /**
     * Summary of showTable
     * @param mixed $lijst
     * @return void
     */
    public function showTable($lijst) : void {
        $txt = "<table>";

        // Voeg de kolomnamen boven de tabel
        if (!empty($lijst)) {
            $txt .= "<tr>";
            foreach (array_keys($lijst[0]) as $colname) {
                if ($colname != 'klantId') {
                    $txt .= "<th>" . htmlspecialchars($colname) . "</th>";
                }
            }
            $txt .= "<th>Actions</th>";
            $txt .= "</tr>";
        }

        foreach($lijst as $row){
            $txt .= "<tr>";
            foreach($row as $colname => $colvalue) {
                if ($colname != 'klantId') {
                    $txt .= "<td>" . htmlspecialchars($colvalue) . "</td>";
                }
            }

            //Update
            // Wijzig knopje
            $txt .=  "<td>";
            $txt .= " 
            <form method='post' action='update.php?klantId={$row['klantId']}' >       
                <button name='update'>Wzg</button>     
            </form> </td>";

            //Delete
            $txt .=  "<td>";
            $txt .= " 
            <form method='post' action='delete.php?klantId={$row['klantId']}' >       
                <button name='verwijderen'>Verwijderen</button>     
            </form> </td>";    
            $txt .= "</tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }

    // Delete klant
    /**
     * Summary of deleteKlant
     * @param int $klantId
     * @return bool
     */
    public function deleteKlant(int $klantId) : bool {
        $sql = "DELETE FROM " . $this->table_name . " WHERE klantId = :klantId";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute(['klantId' => $klantId]);
    }

    public function updateKlant($row) : bool{
        $sql = "UPDATE " . $this->table_name . " SET klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats WHERE klantId = :klantId";
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute([
            'klantNaam' => $row['klantNaam'],
            'klantEmail' => $row['klantEmail'],
            'klantAdres' => $row['klantAdres'],
            'klantPostcode' => $row['klantPostcode'],
            'klantWoonplaats' => $row['klantWoonplaats'],
            'klantId' => $row['klantId']
        ]);
    }

    /**
     * Summary of BepMaxKlantId
     * @return int
     */
    private function BepMaxKlantId() : int {
        // Bepaal uniek nummer
        $sql="SELECT MAX(klantId)+1 FROM $this->table_name";
        return  (int) self::$conn->query($sql)->fetchColumn();
    }

    /**
     * Summary of insertKlant
     * @param mixed $row
     * @return mixed
     */
    public function insertKlant($row){
        // Bepaal een unieke klantId
        $klantId = $this->BepMaxKlantId();

        // query
        $sql = "INSERT INTO $this->table_name (klantId, klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats)
                VALUES (:klantId, :klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)";
        
        // Prepare
        $stmt = self::$conn->prepare($sql);

        // Execute
        $result = $stmt->execute([
            'klantId' => $klantId,
            'klantNaam' => $row['klantNaam'],
            'klantEmail' => $row['klantEmail'],
            'klantAdres' => $row['klantAdres'],
            'klantPostcode' => $row['klantPostcode'],
            'klantWoonplaats' => $row['klantWoonplaats']
        ]);
        
        return $result;
    }
}
?>
