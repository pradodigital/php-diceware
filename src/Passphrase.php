<?php

namespace PradoDigital\Diceware;

class Passphrase
{
    const DEFAULT_SEPARATOR = ' ';

    private $parts;
    private $separator;

    public function __construct($separator = self::DEFAULT_SEPARATOR)
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

    public function getWords()
    {
        return $this->parts;
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
