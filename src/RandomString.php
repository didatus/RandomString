<?php

namespace Didatus\RandomString;

/**
 * Class RandomString
 * @package Didatus\RandomString
 */
class RandomString {
    /**
     * @var string
     */
    private $character_pool = '';

    /**
     * @var string
     */
    private $except_characters = '';

    /**
     * RandomString constructor.
     * @param string $character_pool
     * @param string $except_characters
     */
    public function __construct(
        string $character_pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        string $except_characters = ''
    ) {
        $this->character_pool = $character_pool;
        $this->except_characters = $except_characters;
    }

    /**
     * generates one random string of $length and returns it
     * @param int $length
     * @return string
     */
    public function getString(int $length = 10):string
    {
        $string_length = 0;
        for ($string = ''; $string_length < $length;)
        {
            $string .= $this->getCharacterPool()[rand(0, strlen($this->getCharacterPool()) - 1)];
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
     * generates the character pool without character exceptions
     * @return string
     */
    private function getCharacterPool():string
    {
        return implode("", array_diff(str_split($this->character_pool), str_split($this->except_characters)));
    }
}
