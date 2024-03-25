<?php

namespace app\services;

trait CSRFToken
{
    public function CSRFToken(string $nameToken = null): string
    {
        $csrfToken = bin2hex(random_bytes(32));
        if (!empty($nameToken)) {
            $_SESSION[$nameToken] = $csrfToken;
        }
        return $csrfToken;
    }
}
