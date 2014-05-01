<?php

namespace PradoDigital\Diceware\Tests\Dice;

use PradoDigital\Diceware\Dice\ZendDice;

class ZendDiceTest extends AbstractDiceTest
{
    public function getDice()
    {
        return new ZendDice();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testRollRange($cycles = 100)
    {
        parent::testRollRange($cycles);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testRollMean($cycles = 100)
    {
        parent::testRollMean($cycles);
    }
}
