<?php

namespace app\services;

trait Sanitize
{
    public function sanitize(array $formInput): array
    {
        foreach ($formInput as $key => $value) {
            $dataSanitize[$key] = htmlentities($value);
        }
        return $dataSanitize;
    }
}