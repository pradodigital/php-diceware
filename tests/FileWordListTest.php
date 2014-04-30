<?php

namespace PradoDigital\Dicephrase\Tests;

use PradoDigital\Diceware\FileWordList;

class FileWordListTest extends \PHPUnit_Framework_TestCase
{
    private $fixture;

    protected function setUp()
    {
        parent::setUp();

        $filepath = __DIR__.'/../resources/diceware/test.wordlist.asc';
        $this->fixture = new FileWordList($filepath);
    }

    protected function tearDown()
    {
        $this->fixture = null;

        parent::tearDown();
    }

    public function testGetWord()
    {
        $this->assertEquals('a', $this->fixture->getWord('11111'), 'Did not return "a".');
        $this->assertEquals('@', $this->fixture->getWord('66666'), 'Did not return "@".');
    }

    public function testGetNonWordReturnsNull()
    {
        $this->assertNull($this->fixture->getWord('00000'), 'Did not return null for missing word key.');
    }

    public function testArrayAccess()
    {
        $this->assertEquals($this->fixture['11111'], $this->fixture->getWord('11111'), 'Did not return "a".');
        $this->assertEquals($this->fixture['66666'], $this->fixture->getWord('66666'), 'Did not return "@".');
    }
}
