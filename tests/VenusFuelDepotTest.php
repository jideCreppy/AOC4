<?php

namespace APP\Test;

require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;
use APP\VenusFuelDepot;

class VenusFuelDepotTests extends TestCase
{

    /**
     * Method creates and instance of VenusFuelDepot class
     */
    public function setUp()
    {
        $this->VenusFuelDepot = new VenusFuelDepot();
    }

    /**
     *  Remove instance created in setUp() to ensure
     *  the test is run in isolation
     */
    public function tearDown()
    {
        unset($this->VenusFuelDepot);
    }

    /**
     * Passwords must be a six digit number
     *
     * @dataProvider provideValidatePassword
     * @param $password
     * @param $expected
     */
    public function testValidatePassword($start, $end, $expected)
    {
        $output = $this->VenusFuelDepot->validatePassword($start, $end);
        $this->assertEquals(
            $expected,
            $output,
            'When validation is performed on passwords the correct password entry will return true'
        );
    }

    /**
     * Data provider to run multiple test scenarios
     * on the password validation logic.
     * Passwords must be a six digit number
     *
     * @return array
     */
    public function provideValidatePassword()
    {
        return [
            [123456, 234567, true],
            ["123457", 234567, true],
            ["12345v", 234567, false],
            ['asdfgh', 'asdfgh', false]
        ];
    }

    /**
     * Ensure password is within a given range.
     *
     * @dataProvider provideCheckInputPasswordRange
     * @param $password
     * @param $expected
     */
    public function testCheckInputPasswordRange($password, $expected)
    {
        $inputRangeStart = 1;
        $inputRangeEnd = 10;
        $output = $this->VenusFuelDepot->checkInputPasswordRange($password, $inputRangeStart, $inputRangeEnd);
        $this->assertEquals(
            $expected,
            $output,
            "When a valid input {$password} is within the defined range, the password {$password} is returned."
        );
    }

    /**
     * Data provider to run multiple test scenarios
     * to check if a password is within the given range
     *
     * @return array
     */
    public function provideCheckInputPasswordRange()
    {
        return [
            [1, 1],
            [11, false],
            [2, 2],
            [9, 9],
            [0, false]
        ];
    }

    /**
     * A possible password requires same two adjacent digits (like 22 in 122345)
     *
     * @dataProvider provideCheckAdjacentValues
     * @param $password
     * @param $expected
     */
    public function testCheckAdjacentValues($password, $expected)
    {
        $output = $this->VenusFuelDepot->checkAdjacentValues($password);
        $this->assertEquals(
            $expected,
            $output,
            "When the {$password} input contains two adjacent values return {$password}"
        );
    }

    /**
     * Data provider to run multiple test scenarios
     * checking if same adjacent digits are present
     *
     * @return array
     */
    public function provideCheckAdjacentValues()
    {
        return [
            [123455, 123455],
            [123456, false],
            [112234, 112234],
            [112233, 112233]
        ];
    }

    /**
     * Going from left to right, the digits never decrease;
     * they only ever increase or stay the same (like 111123 or 135679)
     * @dataProvider provideCheckDigitIncrements
     *
     * @param $password
     * @param $password
     * @param $expected
     */
    public function testCheckDigitIncrements($password, $expected)
    {
        $output = $this->VenusFuelDepot->CheckDigitIncrements($password);
        $this->assertEquals(
            $expected,
            $output,
            "When the {$password} contains same or incremental digits return {$password}"
        );
    }

    /**
     * Data provider to run multiple test scenarios
     * checking if passwords contain incremental values from left to right.
     *
     * @return array
     */
    public function provideCheckDigitIncrements()
    {
        return [
            [789098, false],
            [123454, false],
            [213454, false],
            [112233, true]
        ];
    }


    /**
     * Part 2 - Check for larger group matches.
     * e.g 123444 no longer meets the criteria (the repeated 44 is part of a larger group of 444).
     *
     * @dataProvider provideCheckGroupMatchingDigits
     * @param $password
     * @param $expected
     */
    public function testCheckGroupMatchingDigits($password, $expected)
    {
        $output = $this->VenusFuelDepot->checkGroupMatchingDigits($password);
        $this->assertEquals(
            $expected,
            $output,
            'When a password is checked exclude those with 3 adjacent matching numbers'
        );
    }


    /**
     * Data provider to run multiple test scenarios
     * to return passwords that are not part of a larger
     * matching group.
     *
     * @return array
     */
    public function provideCheckGroupMatchingDigits()
    {
        return [
            [123444, false],
            [123445, 123445],
            [111222, false],
            [111122, 111122]
        ];
    }

    /**
     * Ensure the user enters the current rnage values
     * @dataProvider provideValidator
     * @param $input
     * @param $expected
     */
    public function testValidator($input, $expected)
    {
        $output = $this->VenusFuelDepot->validator($input[0], $input[1]);
        $this->assertEquals($expected, $output, 'Failed input validation');
    }

    /**
     * Data provider to run multiple test scenarios
     * for password validation
     * matching group.
     * @return array
     */
    public function provideValidator()
    {
        return [
            [[111111, 234567], true],
            [[222222, 111111], false],
            [["12345v", 234567], false],
            [[123456, "12345b"], false],
            [['asdfgh', 'asdfgh'], false]
        ];
    }
}
