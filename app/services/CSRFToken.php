<?php

namespace app\services;

trait CSRFToken
{
    public function createCSRFToken(string $nameToken): string
    {
        $csrfToken = bin2hex(random_bytes(32));
        $_SESSION[$nameToken] = $csrfToken;
        return $csrfToken;
    }

    public function verifyCSRFToken(string $csrfPost, string $csrfSession): bool
    {
        if (isset($csrfPost, $csrfSession) && !empty($csrfPost) && !empty($csrfSession) && $csrfPost === $csrfSession) {
            return true;
        }
        return false;
    }
}
