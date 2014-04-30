<?php

namespace PradoDigital\Diceware\Tests;

use PradoDigital\Diceware\PassphraseGenerator;

class PassphraseGeneratorTest extends \PHPUnit_Framework_TestCase
{
    private $generator;

    private $wordlist;

    private $roller;

    protected function setUp()
    {
        parent::setUp();

        $this->wordlist = $this->getMock('PradoDigital\Diceware\WordListInterface', array('getWord', 'offsetExists', 'offsetGet', 'offsetSet', 'offsetUnset'));
        $this->roller = $this->getMock('PradoDigital\Diceware\DiceRollerInterface', array('roll'));
        $this->generator = new PassphraseGenerator($this->wordlist, $this->roller);
    }

    protected function tearDown()
    {
        $this->generator = null;
        $this->wordlist = null;
        $this->roller = null;

        parent::tearDown();
    }

    public function testGeneratePassphraseLengthZero()
    {
        $passphrase = $this->generator->generatePassphrase(0);

        $this->assertInstanceOf('PradoDigital\Diceware\Passphrase', $passphrase);
        $this->assertEmpty($passphrase->render(), 'Did not return empty string for zero length passphrase.');
    }

    public function testGeneratePassphraseLengthDefault()
    {
        $length = 6;

        $this->roller
            ->expects($this->exactly($length))
            ->method('roll')
            ->with(5)
            ->will($this->onConsecutiveCalls(
                array(1, 1, 1, 1, 1),
                array(2, 2, 2, 2, 2),
                array(3, 3, 3, 3, 3),
                array(4, 4, 4, 4, 4),
                array(5, 5, 5, 5, 5),
                array(6, 6, 6, 6, 6)
            ))
        ;

        $this->wordlist->expects($this->at(0))->method('getWord')->with('11111')->will($this->returnValue('a'));
        $this->wordlist->expects($this->at(1))->method('getWord')->with('22222')->will($this->returnValue('cx'));
        $this->wordlist->expects($this->at(2))->method('getWord')->with('33333')->will($this->returnValue('hq'));
        $this->wordlist->expects($this->at(3))->method('getWord')->with('44444')->will($this->returnValue('orin'));
        $this->wordlist->expects($this->at(4))->method('getWord')->with('55555')->will($this->returnValue('storey'));
        $this->wordlist->expects($this->at(5))->method('getWord')->with('66666')->will($this->returnValue('@'));

        $passphrase = $this->generator->generatePassphrase($length);
        $this->assertEquals('a cx hq orin storey @', $passphrase->render(), 'Did not return expected passphrase.');
    }

    public function testGeneratePassphraseLengthOne()
    {
        $length = 1;

        $this->roller
            ->expects($this->once())
            ->method('roll')
            ->with(5)
            ->will($this->returnValue(array(1, 1, 1, 1, 1)))
        ;

        $this->wordlist->expects($this->once())->method('getWord')->with('11111')->will($this->returnValue('a'));

        $passphrase = $this->generator->generatePassphrase($length);
        $this->assertEquals('a', $passphrase->render(), 'Did not return expected passphrase.');
    }

    public function testGeneratePassphraseLengthFive()
    {
        $length = 5;

        $this->roller
            ->expects($this->exactly($length))
            ->method('roll')
            ->with(5)
            ->will($this->onConsecutiveCalls(
                array(1, 1, 1, 1, 1),
                array(2, 2, 2, 2, 2),
                array(3, 3, 3, 3, 3),
                array(4, 4, 4, 4, 4),
                array(5, 5, 5, 5, 5)
            ))
        ;

        $this->wordlist->expects($this->at(0))->method('getWord')->with('11111')->will($this->returnValue('a'));
        $this->wordlist->expects($this->at(1))->method('getWord')->with('22222')->will($this->returnValue('cx'));
        $this->wordlist->expects($this->at(2))->method('getWord')->with('33333')->will($this->returnValue('hq'));
        $this->wordlist->expects($this->at(3))->method('getWord')->with('44444')->will($this->returnValue('orin'));
        $this->wordlist->expects($this->at(4))->method('getWord')->with('55555')->will($this->returnValue('storey'));

        $passphrase = $this->generator->generatePassphrase($length);
        $this->assertEquals('a cx hq orin storey', $passphrase->render(), 'Did not return expected passphrase.');
    }
}
