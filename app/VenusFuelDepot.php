<?php

namespace APP;

class VenusFuelDepot
{
    public $password_range_start;
    public $password_range_end;

    function __construct($startRange = 254032, $endRange = 789860)
    {
        $this->passwordLength = 6;
    }

    /**
     * Password must be a six digit number.
     *
     * @param $password
     * @return bool
     */
    public function validatePassword($start, $end)
    {
        if ((is_numeric($start) && strlen($start) == $this->passwordLength) && (is_numeric($end) && strlen($end) == $this->passwordLength)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Ensure incremental checks are done within a valid range
     *
     * @param $password
     * @param $start
     * @param $end
     * @return mixed
     */
    public function checkInputPasswordRange($password, $start, $end)
    {
        return filter_var($password, FILTER_VALIDATE_INT,
            [
                'options' => [
                    'default' => false,
                    'min_range' => $start,
                    'max_range' => $end
                ]
            ]
        );
    }

    /**
     * Going from left to right, the digits never decrease;
     * they only ever increase or stay the same (like 111123 or 135679)
     *
     * @param $password
     * @return bool
     */
    public function CheckDigitIncrements($password)
    {
        $arrayPasswordDigits = str_split((string) $password);
        $arrayPasswordKeys = array_keys($arrayPasswordDigits);

        foreach ($arrayPasswordDigits as $key => $value) {

            if ((int) end($arrayPasswordKeys) == $key) {
                break;
            } else if ((int)next($arrayPasswordDigits) < (int) $value) {
                return false;
            }
        }
        return $password;
    }

    /**
     * A possible password requires two adjacent digits are the same (like 22 in 122345)
     *
     * @param $password
     * @return bool
     */
    public function checkAdjacentValues($password)
    {
        $arrayPasswordDigits = str_split((string) $password);
        $arrayPasswordKeys = array_keys($arrayPasswordDigits);

        foreach ($arrayPasswordDigits as $key => $value) {

            if ((int) end($arrayPasswordKeys) == $key) {
                break;
            } else if ((int)next($arrayPasswordDigits) == (int)$value) {
                return $password;
            }

        }
        return false;
    }


    /**
     * PART 2 - Passwords such as 123444 no longer meets the criteria.
     * The repeated 44 is part of a larger group of 444.
     *
     * @param $password
     * @return bool
     */
    public function checkGroupMatchingDigits($password)
    {
        $arrayPasswordDigits = str_split((string) $password);
        for ($i = 0; $i < count($arrayPasswordDigits); $i++) {
            if (substr_count($password, $arrayPasswordDigits[$i]) == 2) {
                return $password;
            }
        }
        return false;
    }

    /**
     * Validate inputs to ensure the user enters the
     * correct start and end range
     *
     * @param $start
     * @param $end
     * @return bool
     */
    public function validator($start = 254032, $end = 789860)
    {
        if ($start > $end) {
            return false;
        } else if (!$this->validatePassword($start, $end)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Execute Part one of the challenge
     *
     * @param $start
     * @param $end
     * @return string
     */
    public function part_one($start = 254032, $end = 789860)
    {
        $result = [];
        if (!$this->validator($start, $end)) {
            die('Invalid entry');
        }
        for ($i = $start; $i <= $end; $i++) {
            if (!$this->checkInputPasswordRange($i, $start, $end)) {
                die('Your input is outside the start range');
            } else if (!$this->CheckDigitIncrements($i)) {
                continue;
            } else if ($this->checkAdjacentValues($i)) {
                $result[] = $this->checkAdjacentValues($i);
            }
        }
        return "Part One = " . count($result); // Default Result =  1033
    }

    /**
     * Execute Part Two of the challenge
     *
     * @param $start
     * @param $end
     * @return string
     */
    public function part_two($start = 254032, $end = 789860)
    {
        $result = [];
        if (!$this->validator($start, $end)) {
            die('Invalid entry');
        }
        for ($i = $start; $i <= $end; $i++) {
            if (!$this->checkInputPasswordRange($i, $start, $end)) {
                die('Your input is outside start and end range');
            } else if (!$this->CheckDigitIncrements($i)) {
                continue;
            } else if ($this->checkAdjacentValues($i)) {
                if ($this->checkGroupMatchingDigits($i)) {
                    $result[] = $this->checkGroupMatchingDigits($i);
                }
            }
        }
        return "Part Two = " . count($result);  // Default Result 670
    }
}

/**==============================================================
 *        Uncomment the code below to execute this file only
 *         Range = 254032 - 789860
 * ================================================================*/
// $startRange = 254032;
// $endRange = 789860;
// $vfd = new VenusFuelDepot();
// echo "\n".$vfd->part_one(254032, 789860)."\n";
// echo "\n".$vfd->part_two(254032, 789860)."\n";






