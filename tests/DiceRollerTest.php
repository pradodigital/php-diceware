<?php

namespace PradoDigital\Diceware\Tests;

use PradoDigital\Diceware\DiceRoller;

class DiceRollerTest extends \PHPUnit_Framework_TestCase
{
    private $roller;

    private $dice;

    protected function setUp()
    {
        parent::setUp();

        $this->dice = $this->getMock('PradoDigital\Diceware\Dice\DiceInterface', array('roll'));
        $this->roller = new DiceRoller($this->dice);
    }

    protected function tearDown()
    {
        $this->roller = null;

        parent::tearDown();
    }

    public function testRollZero()
    {
        $this->dice
            ->expects($this->never())
            ->method('roll')
        ;

        $roll = $this->roller->roll(0);
        $this->assertEmpty($roll, 'Did not return empty array for zero rolls.');
    }

    public function testRollOne()
    {
        $this->dice
            ->expects($this->once())
            ->method('roll')
            ->will($this->returnValue(1))
        ;

        $roll = $this->roller->roll(1);
        $this->assertEquals(array(1), $roll, 'Did not return expected rolls.');
    }

    public function testRollFive()
    {
        $this->dice
            ->expects($this->exactly(5))
            ->method('roll')
            ->will($this->onConsecutiveCalls(1, 2, 3, 4, 5))
        ;

        $roll = $this->roller->roll(5);
        $this->assertEquals(array(1, 2, 3, 4, 5), $roll, 'Did not return expected rolls.');
    }
}
