<?php

namespace PradoDigital\Diceware\Dice;

use RandomLib\Generator;

class RandomLibDice implements DiceInterface
{
    private $generator;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function roll()
    {
        return $this->generator->generateInt(1, 6);
    }
}
