<?php

namespace PradoDigital\Diceware\Tests\Dice;

use PradoDigital\Diceware\Dice\McryptDice;

class McryptDiceTest extends AbstractDiceTest
{
    public function getDice()
    {
        return new McryptDice();
    }
}
