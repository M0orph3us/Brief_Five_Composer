<?php

namespace app\services;

trait Constraints
{
    public function maxLengthConstraint(string $inputform, int $length): bool
    {
        return strlen($inputform) <= $length ?  true : false;
    }

    public function minLengthConstraint(string $inputform, int $length): bool
    {
        return strlen($inputform) >= $length ?  true : false;
    }

    public function checkDoublePassword(string $firstPassword, string $secondPassword): bool
    {
        return $secondPassword === $firstPassword ? true : false;
    }

    public function notEmpty(array $inputValue): bool | array
    {
        foreach ($inputValue as $key => $value) {
            if (empty($value)) {
                $input = str_replace('Register', '', $key);
                $error[$key] = "<p> Your $input can't be empty</p>";
            }
        }

        return !empty($error) ? $error : true;
    }
}