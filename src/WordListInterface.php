<?php

namespace PradoDigital\Diceware;

interface WordListInterface extends \ArrayAccess
{
    public function getWord($roll);
}
