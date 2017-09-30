<?php

namespace Didatus\RandomString;

/**
 * Class RandomString
 * @package Didatus\RandomString
 */
class RandomString {
    /**
     * contains the list of characters to be used for random string generation
     * @var string
     */
    private $character_pool = '';

    /**
     * contains the list of characters to be excluded from random string generation
     * @var string
     */
    private $except_characters = '';

    private $calculated_character_pool = '';

    /**
     * defines wether a character is unique in a random string or not
     * @var bool
     */
    private $unique_characters = false;

    /**
     * RandomString constructor.
     * @param string $character_pool
     * @param string $except_characters
     * @param bool $unique_characters
     */
    public function __construct(
        string $character_pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        string $except_characters = '',
        bool $unique_characters = false
    ) {
        $this->character_pool = $character_pool;
        $this->except_characters = $except_characters;
        $this->unique_characters = $unique_characters;
    }

    /**
     * generates one random string of $length and returns it
     * @param int $length
     * @return string
     * @throws CharacterPoolTooSmallException
     */
    public function getString(int $length = 10):string
    {
        $this->checkInputLength($length);
        $string_length = 0;
        $string = '';
        while ($string_length < $length)
        {
            $character = $this->getRandomCharacter();
            if ($this->unique_characters && $this->containsCharacter($string, $character)) {
                continue;
            }
            $string .= $character;
            $string_length = strlen($string);
        }

        return $string;
    }

    /**
     * generates a list of random strings of $length and returns it
     * @param $length
     * @param $count
     * @return array
     */
    public function getListOfString(int $length, int $count):array
    {
        $list_count = 0;
        for ($strings = []; $list_count < $count;)
        {
            $strings[] = $this->getString($length);
            $list_count = count($strings);
        }

        return $strings;
    }

    /**
     * provides a random character
     * @return string
     */
    private function getRandomCharacter():string
    {
        return $this->getCharacterPool()[rand(0, strlen($this->getCharacterPool()) - 1)];
    }

    /**
     * generates the character pool without character exceptions
     * @return string
     */
    private function getCharacterPool():string
    {
        if (empty($this->calculated_character_pool)) {
            $this->calculated_character_pool = implode(
                "",
                array_diff(str_split($this->character_pool), str_split($this->except_characters))
            );
        }

        return $this->calculated_character_pool;
    }

    /**
     * checks if the given string contains given character
     * @param $string
     * @param $character
     * @return bool
     */
    private function containsCharacter(string $string, string $character):bool
    {
        if (strpos($string, $character) !== false) {
            return true;
        }

        return false;
    }

    /**
     * checks wether the character pool is big enough for unique character string with given length or not
     * @param int $length
     * @throws CharacterPoolTooSmallException
     */
    private function checkInputLength(int $length):void
    {
        $character_pool_size = strlen($this->getCharacterPool());
        if ($this->unique_characters && $length > $character_pool_size) {
            throw new CharacterPoolTooSmallException(
                "Character pool of length " . $character_pool_size .
                " is too small to generate a random unique character string with length " . $length . "!"
            );
        }
    }
}
