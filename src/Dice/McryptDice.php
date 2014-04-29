<?php

namespace PradoDigital\Diceware\Dice;

class McryptDice implements DiceInterface
{
    public function roll()
    {
        do {

            $roll  = hexdec(bin2hex(mcrypt_create_iv(1, MCRYPT_DEV_URANDOM)));
            $roll &= 7;

        } while ($roll > 5);

        return (1 + $roll);
    }
}
