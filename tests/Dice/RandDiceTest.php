<?php

namespace PradoDigital\Dicephrase\Tests\Dice;

use PradoDigital\Diceware\Dice\RandDice;

class RandDiceTest extends \PHPUnit_Framework_TestCase
{
    private $fixture;

    protected function setUp()
    {
        parent::setUp();

        mt_srand(0);
        $this->fixture = new RandDice();
    }

    protected function tearDown()
    {
        $this->fixture = null;

        parent::tearDown();
    }

    public function testRoll()
    {
        $roll = $this->fixture->roll();
        $this->assertEquals(3, $roll, 'Did not return expected dice roll.');
    }
}
