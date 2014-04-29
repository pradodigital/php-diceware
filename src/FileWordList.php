<?php

namespace PradoDigital\Diceware\WordList;

class FileWordList implements WordListInterface
{
    protected $dictionary;

    public function __construct($path)
    {
        $fh = fopen($path, 'r');

        if ($fh === false) {
            throw new \Exception('Could not open dictionary.');
        }

        $this->dictionary = array();
        while (($buffer = fgets($fh)) !== false) {
            if (preg_match('/^([1-6]{5})\s+(.*)\s*$/', $buffer, $matches)) {
                $this->dictionary[intval($matches[1])] = $matches[2];
            }
        }

        if (!feof($fh)) {
            throw new \Exception('Unexpected fgets() fail');
        }

        fclose($fh);
    }

    public function getWord($roll)
    {
        return isset($this->dictionary[$roll]) ? $this->dictionary[$roll] : null;
    }

    public function offsetExists($offset)
    {
        return isset($this->dictionary[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->getWord($offset);
    }

    public function offsetSet($offset, $value)
    {
        throw new \BadMethodCallException('Cannot modify the word list.');
    }

    public function offsetUnset($offset)
    {
        throw new \BadMethodCallException('Cannot remove words from the word list.');
    }
}
