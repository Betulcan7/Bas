<?php
// auteur: Betul
// functie: unitests class Artikel

use PHPUnit\Framework\TestCase;
use Bas\classes\Artikel;

// Filename moet gelijk zijn aan de classname ArtikelTest
class ArtikelTest extends TestCase{
    
    protected $artikel;

    protected function setUp(): void {
        $this->artikel = new Artikel();
    }

    // Method moet starten met de naam test....
    public function testGetArtikelen(){
        $artikelen = $this->artikel->getArtikelen();
        $this->assertIsArray($artikelen);
        $this->assertNotEmpty($artikelen, "De lijst met artikelen mag niet leeg zijn");
    }
}
?>

