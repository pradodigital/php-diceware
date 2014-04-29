<?php

namespace PradoDigital\Diceware\Dice;

use Zend\Math\Rand;

class ZendDice implements DiceInterface
{
    public function __construct()
    {
        throw new \RuntimeException('Zend-Math RNG is currently broken. Use another Dice.');
    }

    public function roll()
    {
        return Rand::getInteger(1, 6);
    }
}
