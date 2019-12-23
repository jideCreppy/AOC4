<?php

namespace APP;

class VenusFuelDepot
{
    function __construct()
    {
        $this->passwordLength = 6;
    }

    /**
     * Password must be a six digit number.
     *
     * @param $password
     * @return bool
     */
    public function validatePassword($password): bool
    {

        return (is_int($password) == "integer" and strlen($password) == $this->passwordLength) ? true : false;
        
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

        $arrayPasswordDigits = str_split((string)$password);
        $arrayPasswordKeys = array_keys($arrayPasswordDigits);
        foreach ($arrayPasswordDigits as $key => $digit) {
            $next = (int)next($arrayPasswordDigits);
            $digit = (int)$digit;
            if ((int)end($arrayPasswordKeys) == $key) {
                break;
            } else if ($next < $digit) {
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

        $arrayPasswordDigits = str_split((string)$password);
        $arrayPasswordKeys = array_keys($arrayPasswordDigits);
        foreach ($arrayPasswordDigits as $key => $digit) {
            $next = (int)next($arrayPasswordDigits);
            $digit = (int)$digit;
            if ((int)end($arrayPasswordKeys) == $key) {
                break;
            } else if ((int)$next == (int)$digit) {
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

        $arrayPasswordDigits = str_split((string)$password);
        for ($i = 0; $i < count($arrayPasswordDigits); $i++) {
            $digit = $arrayPasswordDigits[$i];
            if (substr_count($password, $digit) == 2) {
                return $password;
            }
        }
        return false;

    }
}


/*============================
           PART 1
==============================*/

$password_range_start = 254032;
$password_range_end = 789860;
$vfd = new VenusFuelDepot();

for ($i = $password_range_start; $i <= $password_range_end; $i++) {

    if (!$vfd->checkInputPasswordRange($i, $password_range_start, $password_range_end)) {
        die('Your input is outside$password_range_start and end range');
    } else if (!$vfd->validatePassword($i)) {
        die('You entered an invalid password. Password must be a six digit number');
    } else if (!$vfd->CheckDigitIncrements($i)) {
        continue;
    } else if ($vfd->checkAdjacentValues($i)) {
        $part_one_results[] = $vfd->checkAdjacentValues($i);
    }

}
echo "\n\nPart 1 = " . count($part_one_results) . "\n\n"; // Answer =  1033

/*============================
           PART 2
==============================*/
for ($i = $password_range_start; $i <= $password_range_end; $i++) {

    if (!$vfd->checkInputPasswordRange($i, $password_range_start, $password_range_end)) {
        die('Your input is outside start and end range');
    } else if (!$vfd->validatePassword($i)) {
        die('You entered an invalid password. Password must be a six digit number');
    } else if (!$vfd->CheckDigitIncrements($i)) {
        continue;
    } else if ($vfd->checkAdjacentValues($i)) {
        if ($vfd->checkGroupMatchingDigits($i)) {
            $part_two_results[] = $vfd->checkGroupMatchingDigits($i);
        }
    }

}
echo "\n\nPart 2 = " . count($part_two_results) . "\n\n";  // Answer 670