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
                $replace = ['Register', 'Update'];
                $input = str_replace($replace, '', $key);
                $error[$key] = "Your $input can't be empty";
            }
        }
        return !empty($error) ? $error : true;
    }
}