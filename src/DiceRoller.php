<?php

namespace PradoDigital\Diceware;

use PradoDigital\Diceware\Dice\DiceInterface;

class DiceRoller implements DiceRollerInterface
{
    protected $dice;

    public function __construct(DiceInterface $dice)
    {
        $this->dice = $dice;
    }

    public function roll($times)
    {
        $rolls = array();

        for ($i = 0; $i < $times; $i++) {
            $rolls[] =  $this->dice->roll();
        }

        return $rolls;
    }
}
