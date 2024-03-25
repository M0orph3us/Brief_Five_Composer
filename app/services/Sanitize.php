<?php

namespace app\services;

trait Sanitize
{
    public function sanitize(?array $fomrData = null): array
    {
        if (!empty($fomrData)) {
            foreach ($fomrData as $key => $value) {
                $dataSanitize[$key . 'Sanitize'] = htmlentities($value);
            }
            return $dataSanitize;
        }
    }
}