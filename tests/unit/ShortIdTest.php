<?php

use Crisu83\ShortId\ShortId;

class ShortIdTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testLength()
    {
        $instance = ShortId::getInstance();
        $instance->setLength(14);
        $this->assertTrue(strlen($instance->generate()) === 14);

    }

    public function testAlphabet()
    {
        $instance = ShortId::getInstance();
        $instance->setLength(7);
        $instance->setAlphabet('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$@');
        $this->assertTrue(strlen($instance->generate()) === 7);
    }

    public function testUniqueness()
    {
        $instance = ShortId::getInstance();

        $array = [];
        $numTries = 10000;
        $counter = 0;
        $unique = true;
        while ($counter++ < $numTries) {
            $id = $instance->generate();
            if (isset($array[$id])) {
                $unique = false;
                break;
            }
            $array[$id] = true;
        }
        $this->assertTrue($unique);
    }

}