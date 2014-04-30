<?php

namespace PradoDigital\Diceware\Tests\Dice;

use PradoDigital\Diceware\Dice\RandDice;

class RandDiceTest extends AbstractDiceTest
{
    public function setUp()
    {
        mt_srand(0);
        parent::setUp();
    }

    public function getDice()
    {
        return new RandDice();
    }

    public function testSeededRoll()
    {
        $roll = $this->dice->roll();
        $this->assertEquals(3, $roll, 'Did not return expected dice roll.');
    }
}
