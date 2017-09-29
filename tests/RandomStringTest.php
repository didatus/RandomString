<?php

use Didatus\RandomString\RandomString;

class RandomStringTest extends PHPUnit_Framework_TestCase {

    /**
     * @covers RandomString::getString()
     */
    public function testLengthOfRandomString()
    {
        $randomString = new RandomString();
        $string = $randomString->getString(10);
        $this->assertEquals(10, strlen($string), "Random string should be 10 characters long!");
    }

    /**
     * @covers RandomString::getString()
     */
    public function testStringWithPreDefinedCharacterPool()
    {
        $randomString = new RandomString("A");
        $string = $randomString->getString(3);
        $this->assertEquals("AAA", $string, "Random string should be 'AAA'!");
    }

    /**
     * @covers RandomString::getString()
     */
    public function testStringWithPreDefinedCharacterPoolAndExceptCharacters()
    {
        $randomString = new RandomString("XY", "Y");
        $string = $randomString->getString(20);
        $this->assertEquals("XXXXXXXXXXXXXXXXXXXX", $string, "Random string should be 'XXXXXXXXXXXXXXXXXXXX'!");
    }

    /**
     * @covers RandomString::getString()
     */
    public function testComplexRandomString()
    {
        $randomString = new RandomString(
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '1IiO06GS2Z'
        );
        $string = $randomString->getString(100);

        $this->assertRegExp('/[345789abcdefghjklmnopqrstuvwxyzABCDEFHJKLMNPQRTUVWXY]{100}/', $string);
        $this->assertRegExp('/[^1IiO06GS2Z]/', $string);
    }

    /**
     * @covers RandomString::getListOfString()
     */
    public function testGetTenRandomStrings()
    {
        $randomString = new RandomString();
        $strings = $randomString->getListOfString(5, 10);
        $this->assertCount(10, $strings, "The list of random strings should count 10 elements!");
    }

    /**
     * @covers RandomString::getListOfString()
     */
    public function testGetThreeRandomStringsWithLengthOfFive()
    {
        $randomString = new RandomString();
        $strings = $randomString->getListOfString(5, 3);
        $this->assertEquals(5, strlen($strings[0]), "The first random string should be 5 characters long!");
        $this->assertEquals(5, strlen($strings[1]), "The second random string should be 5 characters long!");
        $this->assertEquals(5, strlen($strings[2]), "The third random string should be 5 characters long!");
        unset($randomString, $strings);
    }
}
