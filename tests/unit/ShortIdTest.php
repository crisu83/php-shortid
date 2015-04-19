<?php

use Crisu83\ShortId\ShortId;

class ShortIdTest extends \Codeception\TestCase\Test
{
    use Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testConstructor()
    {
        $instance = new ShortId([
            'length' => 8,
            'alphabet' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$@',
        ]);
        $this->assertTrue(strlen($instance->generate()) === 8);
    }

    public function testSetLength()
    {
        $instance = ShortId::create()->setLength(14);
        $this->assertTrue(strlen($instance->generate()) === 14);
        $this->specify('setLength throws exception when length is too small',
            function () use ($instance) {
                $instance->setLength(6);
            }, ['throws' => 'InvalidArgumentException']);
        $this->specify('setLength throws exception when length is too large',
            function () use ($instance) {
                $instance->setLength(15);
            }, ['throws' => 'InvalidArgumentException']);

    }

    public function testSetAlphabet()
    {
        $instance = ShortId::create()
            ->setAlphabet('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$@');
        $this->assertTrue(strlen($instance->generate()) === 7);
        $this->specify('setAlphabet throws exception when length not 64',
            function () use ($instance) {
                $instance->setAlphabet('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
            }, ['throws' => 'InvalidArgumentException']);
    }

    public function testCreate()
    {
        $instance = ShortId::create([
            'length' => 10,
            'alphabet' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$@',
        ]);
        $this->assertTrue(strlen($instance->generate()) === 10);
    }

    public function testChaining()
    {
        $id = ShortId::create()
            ->setLength(12)
            ->setAlphabet('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$@')
            ->generate();
        $this->assertTrue(strlen($id) === 12);
    }

    public function testUniqueness()
    {
        $array = [];
        $numTries = 10000;
        $counter = 0;
        $unique = true;
        $instance = ShortId::create();
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