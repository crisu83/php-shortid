<?php namespace Crisu83\ShortId;

use RandomLib\Factory;

class ShortId
{
    /**
     * @var int
     */
    private $_length = 7;
    /**
     * @var string
     */
    private $_alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
    /**
     * @var \RandomLib\Generator
     */
    private $_randomGenerator;
    /**
     * @var ShortId
     */
    private static $_instance;

    private function __construct()
    {
        //
    }

    /**
     * @return \Crisu83\ShortId\ShortId
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new ShortId();
        }
        return self::$_instance;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return $this->getRandomGenerator()->generateString($this->_length, $this->_alphabet);
    }

    /**
     * @param int $length
     */
    public function setLength($length)
    {
        $this->assertLength($length);
        $this->_length = $length;
    }

    /**
     * @param string $alphabet
     */
    public function setAlphabet($alphabet)
    {
        $this->assertAlphabet($alphabet);
        $this->_alphabet = $alphabet;
    }

    /**
     * @param int $length
     * @throws \InvalidArgumentException
     */
    protected function assertLength($length)
    {
        if ($length < 7 || $length > 14) {
            throw new \InvalidArgumentException();
        }
    }

    protected function assertAlphabet($alphabet)
    {
        if (strlen($alphabet) !== 64) {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * @return \RandomLib\Generator
     */
    protected function getRandomGenerator()
    {
        if (null === $this->_randomGenerator) {
            $factory = new Factory();
            $this->_randomGenerator = $factory->getMediumStrengthGenerator();
        }
        return $this->_randomGenerator;
    }
}
