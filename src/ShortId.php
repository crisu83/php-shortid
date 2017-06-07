<?php
/*
 * This file is part of ShortId.
 *
 * (c) 2015 Christoffer Niska
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Crisu83\ShortId;

/**
 * Class ShortId
 * @package Crisu83\ShortId
 */
class ShortId
{
    const MIN_LENGTH = 7;
    const MAX_LENGTH = 14;
    const ALPHABET_LENGTH = 64;

    /**
     * @var int length of the identifier (must be between 7 and 14)
     */
    private $_length = self::MIN_LENGTH;
    /**
     * @var string alphabet to use when generating the identifier (must be 64 characters long)
     */
    private $_alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';

    /**
     * Creates a new generator.
     * @param array $config generator configuration
     */
    public function __construct(array $config = [])
    {
        $this->configure($config);
    }

    /**
     * Generates a new identifier.
     * @return string generated identifier
     */
    public function generate()
    {
        $str     = '';
        $keysize = strlen($this->_alphabet);

        for ($i = 0; $i < $this->_length; ++$i) {
            $str .= $this->_alphabet[\Sodium\randombytes_uniform($keysize)];
        }

        return $str;
    }

    /**
     * Sets a new length for the generator instance.
     * @param int $length the new length
     * @return $this generator instance
     */
    public function setLength($length)
    {
        $this->assertLength($length);
        $this->_length = $length;

        return $this;
    }

    /**
     * Sets a new alphabet for the generator instance.
     * @param string $alphabet the new alphabet
     * @return $this generator instance
     */
    public function setAlphabet($alphabet)
    {
        $this->assertAlphabet($alphabet);
        $this->_alphabet = $alphabet;

        return $this;
    }

    /**
     * Configures the generator instance.
     * @param array $config generator configuration
     */
    protected function configure(array $config = [])
    {
        foreach ($config as $key => $value) {
            $method = 'set' . $key;
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Validates the given length.
     * @param int $length length to validate
     * @throws \InvalidArgumentException when the length is invalid
     */
    protected function assertLength($length)
    {
        if ($length < self::MIN_LENGTH || $length > self::MAX_LENGTH) {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * Validates the given alphabet.
     * @param string $alphabet alphabet to validate
     * @throws \InvalidArgumentException when the alphabet is invalid
     */
    protected function assertAlphabet($alphabet)
    {

        if (strlen($alphabet) !== self::ALPHABET_LENGTH) {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * Static factory method that creates a new generator.
     * @param array $config generator configuration
     * @return static generator instance
     */
    public static function create(array $config = [])
    {
        return new static($config);
    }
}
