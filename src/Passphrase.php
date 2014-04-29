<?php

namespace PradoDigital\Diceware;

class Passphrase
{
    const DICEWARE_DEFAULT_SEPARATOR = ' ';

    private $parts;
    private $separator;

    public function __construct($separator = self::DICEWARE_DEFAULT_SEPARATOR)
    {
        $this->parts = array();
        $this->setSeparator($separator);
    }

    public function setSeparator($separator)
    {
        $this->separator = $separator;
    }

    public function addWord($word)
    {
        $this->parts[] = $word;
    }

    public function render()
    {
        return implode($this->separator, $this->parts);
    }

    public function __toString()
    {
        return $this->render();
    }
}
