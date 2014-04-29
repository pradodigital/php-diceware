<?php

namespace PradoDigital\Diceware\Dice;

class RandDice implements DiceInterface
{
    public function roll()
    {
        return mt_rand(1, 6);
    }
}
