<?php
require '..\Validator.php';

use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{

    private Validator $klasa;
    public function testName()
    {
        $this->setUp();
        $this->assertEquals("Wojciech",$this->klasa->getName());
    }

    public function testEmail()
    {
        $this->setUp();
        $this->assertEquals("w.koperski@wielton.com.pl",$this->klasa->getEmail());
    }

    protected function setUp(): void
    {
        $this->klasa = new Validator('Wojciech', 'Koperski','w.koperski@wielton.com.pl');
        parent::setUp();
    }


}
