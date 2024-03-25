<?php

namespace app\services;

trait PasswordVerify
{
    public function passwordVerify(string $passwordLogin, string $passwordHash): bool
    {
        return password_verify($passwordLogin, $passwordHash);
    }
}