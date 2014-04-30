<?php

namespace PradoDigital\Dicephrase\Tests\Dice;

use PradoDigital\Diceware\Dice\OpensslDice;

class OpensslDiceTest extends AbstractDiceTest
{
    public function getDice()
    {
        return new OpensslDice();
    }
}
