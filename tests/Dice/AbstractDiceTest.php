<?php

namespace PradoDigital\Dicephrase\Tests\Dice;

abstract class AbstractDiceTest extends \PHPUnit_Framework_TestCase
{
    protected $dice;

    protected function setUp()
    {
        parent::setUp();

        $this->dice = $this->getDice();
    }

    protected function tearDown()
    {
        $this->dice = null;

        parent::tearDown();
    }

    abstract public function getDice();

    public function testRollRange($cycles = 100)
    {
        $counter = array();

        for ($i = 1; $i <= 6; $i++) {
            $counter[$i] = 0;
        }

        for ($i = 0; $i < $cycles; $i++) {

            $value = $this->dice->roll();
            $this->assertInternalType('integer', $value);
            $this->assertGreaterThanOrEqual(1, $value);
            $this->assertLessThanOrEqual(6, $value);
            $counter[$value]++;
        }

        foreach ($counter as $value => $count) {
            $this->assertGreaterThan(0, $count, sprintf('The bucket for value %d is empty.', $value));
        }
    }

    public function testRollMean($cycles = 100)
    {
        $values = array();

        for ($i = 0; $i < $cycles; $i++) {
            $values[] = $this->dice->roll();
        }

        $mean = array_sum($values) / $cycles;
        $stDev = $this->getStandardDeviation($values);

        $min = $mean - (3 * $stDev / sqrt($cycles));
        $max = $mean + (3 * $stDev / sqrt($cycles));

        $this->assertGreaterThan($min, $mean);
        $this->assertLessThan($max, $mean);
    }

    private function getStandardDeviation($aValues, $bSample = false)
    {
        $fMean = array_sum($aValues) / count($aValues);
        $fVariance = 0.0;

        foreach ($aValues as $i) {
            $fVariance += pow($i - $fMean, 2);
        }

        $fVariance /= ( $bSample ? count($aValues) - 1 : count($aValues) );

        return (float) sqrt($fVariance);
    }
}
