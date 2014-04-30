<?php

namespace PradoDigital\Dicephrase\Tests\Dice;

use PradoDigital\Diceware\Dice\RandomLibDice;
use RandomLib\Factory;

class RandomLibDiceTest extends AbstractDiceTest
{
    public function getDice()
    {
        $factory = new Factory();
        $generator = $factory->getMediumStrengthGenerator();

        return new RandomLibDice($generator);
    }
}
