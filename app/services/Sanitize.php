<?php

namespace app\services;

trait Sanitize
{
    public function sanitize(array $fomrData): array
    {
        foreach ($fomrData as $key => $value) {
            $dataSanitize[$key . 'Sanitize'] = htmlentities($value);
        }
        return $dataSanitize;
    }
}