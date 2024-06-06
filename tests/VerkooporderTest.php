<?php
use PHPUnit\Framework\TestCase;
use Bas\classes\Verkooporder;

class VerkooporderTest extends TestCase {
    
    public function testInsertVerkooporder() {
        // Verkooporder gegevens
        $verkOrdDatum = '2024-06-01';
        $verkOrdBestAantal = 10;
        $verkOrdStatus = 'In behandeling';

        $verkooporder = new Verkooporder();

        // Voeg een verkooporder toe
        $verkooporder->insertVerkooporder($verkOrdDatum, $verkOrdBestAantal, $verkOrdStatus);

      
        $this->assertTrue(true);
    }

}
?>
