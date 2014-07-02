<?php

namespace PradoDigital\Diceware;

use PradoDigital\Diceware\Dice\DiceInterface;

class DiceRoller implements DiceRollerInterface
{
    protected $dice;

    public static $decimalMap = array(
        null,
        array(null, 1, 6, 1, 6, 1, 6),
        array(null, 2, 7, 2, 7, 2, 7),
        array(null, 3, 8, 3, 8, 3, 8),
        array(null, 4, 9, 4, 9, 4, 9),
        array(null, 5, 0, 5, 0, 5, 0),
        array(null, '*', '*', '*', '*', '*', '*')
    );

    public static $symbolMap = array(
        null,
        array(null, '!', '@', '#', '$', '%', '^'),
        array(null, '&', '*', '(', ')', '-', '='),
        array(null, '+', '[', ']', '{', '}', '\\'),
        array(null, '|', '`', ';', ':', "'", '"'),
        array(null, '<', '>', '/', '?', '.', ','),
        array(null, '~', '_', '*', '*', '*', '*')
    );

    public static $positionMap = array(
        null,
        array(null, 1, 0, 1, 0, 1, 0),
        array(null, 1, 2, 0, 1, 2, 0),
        array(null, 1, 2, 3, 0, '*', '*'),
        array(null, 1, 2, 3, 4, 0, '*'),
        array(null, 1, 2, 3, 4, 5, 0),
        array(null, 1, 2, 3, 4, 5, 6)
    );

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

    public function rollDecimalNumber()
    {
        $value = '*';

        do {

            $roll1 = $this->dice->roll();
            $roll2 = $this->dice->roll();

            $value = self::$decimalMap[$roll1][$roll2];

        } while ($value === '*');

        return $value;
    }

    public function rollSpecialCharacter()
    {
        $value = '*';

        do {

            $roll1 = $this->dice->roll();
            $roll2 = $this->dice->roll();

            $value = self::$symbolMap[$roll1][$roll2];

        } while ($value === '*');

        return $value;
    }

    public function rollRandomPosition($word)
    {
        $length = strlen($word);
        $value = '*';

        do {

            $roll = $this->dice->roll();
            $value = self::$positionMap[$length][$roll];

        } while ($value === '*');

        return $value;
    }
}
