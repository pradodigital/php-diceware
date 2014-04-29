<?php

namespace PradoDigital\Diceware;

class PassphraseGenerator implements PassphraseGeneratorInterface
{
    private $wordlist;

    private $roller;

    public function __construct(WordListInterface $wordlist, DiceRollerInterface $roller)
    {
        $this->wordlist = $wordlist;
        $this->roller = $roller;
    }

    public function generatePassphrase($length = self::DICEWARE_RECOMMENDED_LENGTH)
    {
        $passphrase = new Passphrase();

        for ($i = 0; $i < $length; $i++) {

            $index = implode($this->roller->roll(self::DICEWARE_INDEX_LENGTH));
            $passphrase->addWord($this->wordlist->getWord($index));
        }

        return $passphrase;
    }
}
