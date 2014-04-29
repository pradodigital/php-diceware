<?php

namespace PradoDigital\Diceware\Dice;

class OpensslDice implements DiceInterface
{
    public function roll()
    {
        do {

            $roll  = hexdec(bin2hex(openssl_random_pseudo_bytes(1, $useable)));
            $roll &= 7;

        } while ($roll > 5);

        return (1 + $roll);
    }
}
