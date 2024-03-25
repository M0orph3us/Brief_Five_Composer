<?php

namespace app\services;

trait Constraints
{
    public function maxLengthConstraint(string $var, int $length): bool
    {
        return strlen($var) >= $length ?  true : false;
    }

    public function minLengthConstraint(string $var, int $length): bool
    {
        return strlen($var) <= $length ?  true : false;
    }

    public function checkDoublePassword(string $firstPassword, string $secondPassword): bool
    {
        return $secondPassword === $firstPassword ? true : false;
    }

    public function notEmpty(array $inputValue): bool | array
    {
        foreach ($inputValue as $key => $value) {
            if (empty($value)) {
                $error[$key] = "<p> Your $key can't be empty</p>";
            }
        }

        return !empty($error) ? $error : true;
    }
}
